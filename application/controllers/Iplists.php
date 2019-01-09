<?php

use IPTools\Range;
use IPTools\Network;

defined('BASEPATH') OR exit('No direct script access allowed');

/** this is a public page * */
class Iplists extends MY_Controller {

    public $publicAccess = true;

    public function __construct() {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $this->load->model('ip_lists_model');
        $this->load->model('import_lists_model');
        $this->load->model('list_links_model');
        $this->load->helper('iplists');
    }

    public function index() {

        $data = array();
        //add a search function
        //$data['ip_lists'] = $this->ip_lists_model->findAll();
        $ip = $this->input->post('ip') ? trim($this->input->post('ip')) : null;
        if (!empty($ip)) {
            $data['ip_lists'] = $this->ip_lists_model->findAll("ip like '%{$ip}%'");
        }
        $data['ip_includes'] = $this->ip_lists_model->findCount();
        $data['list_links'] = $this->list_links_model->findAll();
        $data['import_list'] = $this->import_lists_model->findAll();




        $data['content'] = $this->load->view('iplists/index', $data, TRUE);

        $this->render($data);
    }

    public function add() {

        $data = array();

        $this->form_validation->set_rules('ip', 'IP', 'required');
        if ($this->form_validation->run() === TRUE) {
            $ip = clean_ip($this->input->post('ip'));
            $isProxy = $this->input->post('isProxy') == 1 ? 1 : 0;
            $isDatacenter = $this->input->post('isDatacenter') == 1 ? 1 : 0;
            if (check_ip($ip)) {
                $range = Range::parse($ip);
                $first_ip = $range->getFirstIP();
                $last_ip = $range->getLastIP();
                $ip_data = array(
                    'ip' => $ip,
                    'first_ip' => $first_ip,
                    'last_ip' => $last_ip,
                    'isProxy' => $isProxy,
                    'isDatacenter' => $isDatacenter
                );
                $result = $this->ip_lists_model->insert_unique($ip_data, TRUE);
            } else {
                $result = FALSE;
            }

            if ($result) {
                $this->session->set_flashdata('message', 'The information has been added. ');
            } else {
                $this->session->set_flashdata('message', 'Bad information IP has not been added. ');
            }
            redirect('iplists');
        }

        $data['content'] = $this->load->view('iplists/add', $data, TRUE);
        $this->render($data);
    }

    public function add_multiples() {
        $data = array();

        $this->form_validation->set_rules('multiples', 'IP lists', 'required');

        if ($this->form_validation->run() === TRUE) {
            $ip_lists_string = $this->input->post('multiples');
            $ip_lists = explode("\n", $ip_lists_string);

            $isProxy = $this->input->post('isProxy') == 1 ? 1 : 0;
            $isDatacenter = $this->input->post('isDatacenter') == 1 ? 1 : 0;

            foreach ($ip_lists as $ip) {
                $ip = clean_ip($ip);
                if (check_ip($ip)) {
                    $ip = clean_ip($ip);
                    $range = Range::parse($ip);
                    $first_ip = $range->getFirstIP();
                    $last_ip = $range->getLastIP();
                    $ip_data = array(
                        'ip' => $ip,
                        'first_ip' => $first_ip,
                        'last_ip' => $last_ip,
                        'isProxy' => $isProxy,
                        'isDatacenter' => $isDatacenter
                    );

                    $this->ip_lists_model->insert_unique($ip_data, TRUE);
                }
            }


            if ($ip_lists) {
                $this->session->set_flashdata('message', 'The information has been added. ');
                redirect('iplists');
            }
        }

        $data['content'] = $this->load->view('iplists/add_multiples', $data, TRUE);
        $this->render($data);
    }

    public function import_multiples() {
        $data = array();

        $upload_config['upload_path'] = './uploads/';
        $upload_config['allowed_types'] = 'txt|csv|ipset';
        $upload_config['max_size'] = '0';
        //load upload library and initialize defaults
        $this->load->library('upload', $upload_config);

        if (!empty($_FILES['ipsets']['name'])) {
            if (!$this->upload->do_upload('ipsets')) {
                $this->session->set_flashdata('error', $this->upload->display_errors()); //this returns an array                  
                redirect('iplists');
            }
            $upload_data = $this->upload->data();

            if ($upload_data) {
                $isProxy = $this->input->post('isProxy') == 1 ? 1 : 0;
                $isDatacenter = $this->input->post('isDatacenter') == 1 ? 1 : 0;
                $import_lists_data = array(
                    'filename' => './uploads/' . $upload_data['file_name'],
                    'isProxy' => $isProxy,
                    'isDatacenter' => $isDatacenter
                );
                $this->import_lists_model->insert($import_lists_data);

                $this->session->set_flashdata('message', 'The IP set is scheduled to be added ');
                redirect('iplists');
            }
        }

        $data['content'] = $this->load->view('iplists/import_multiples', $data, TRUE);
        $this->render($data);
    }

    public function add_link() {
        $data = array();

        $this->form_validation->set_rules('link', 'IP Link', array('required', 'valid_url'));

        if ($this->form_validation->run() === TRUE) {
            //check a valid link
            $file = file_get_contents($this->input->post('link'));
            //save this to uploads
            $filename = './uploads/ipsets-' . time();
            file_put_contents($filename, $file);
            $isProxy = $this->input->post('isProxy') == 1 ? 1 : 0;
            $isDatacenter = $this->input->post('isDatacenter') == 1 ? 1 : 0;

            /** Import List * */
            $import_lists_data = array(
                'filename' => $filename,
                'link' => $this->input->post('link'),
                'task' => 'import',
                'isProxy' => $isProxy,
                'isDatacenter' => $isDatacenter
            );
            $this->import_lists_model->insert($import_lists_data);

            /** List Links * */
            $list_links_data = array(
                'link' => $this->input->post('link'),
                'isProxy' => $isProxy,
                'isDatacenter' => $isDatacenter
            );

            $this->list_links_model->insert($list_links_data);




            $this->session->set_flashdata('message', 'The IP set is scheduled to be added ');
            redirect('iplists');
        }

        $data['content'] = $this->load->view('iplists/add_link', $data, TRUE);
        $this->render($data);
    }

    public function remove_link($id) {
        //read the link
        $link = $this->list_links_model->find('id=' . $id);

        $import_lists_data = array(
            'link' => $link['link'],
            'task' => 'remove'
        );
        $this->import_lists_model->insert($import_lists_data);
        $this->list_links_model->remove($id);

        json_encode(array('status' => 'done'));
    }

    public function edit($id) {
        $data = array();

        $this->form_validation->set_rules('ip', 'IP', 'required');

        if ($this->form_validation->run() === TRUE) {
            $ip = clean_ip($this->input->post('ip'));

            if (check_ip($ip)) {
                $range = Range::parse($ip);
                $first_ip = $range->getFirstIP();
                $last_ip = $range->getLastIP();
                $ip_data = array(
                    'ip' => $ip,
                    'first_ip' => $first_ip,
                    'last_ip' => $last_ip
                );
                $result = $this->ip_lists_model->save($ip_data, $id);
            } else {
                $result = FALSE;
            }

            if ($result) {
                $this->session->set_flashdata('message', 'The information has been updated. ');
            } else {
                $this->session->set_flashdata('message', 'Bad information IP has not been updated. ');
            }
            redirect('iplists');
        }


        $data['ip_lists'] = $this->ip_lists_model->find("id=$id");

        $data['content'] = $this->load->view('iplists/edit', $data, true);
        $this->render($data);
    }

    public function remove($id) {
        $this->ip_lists_model->remove($id);

        $this->session->set_flashdata('message', 'The record has been removed');
        redirect('iplists');
    }

}
