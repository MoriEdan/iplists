<?php

use IPTools\Range;
use IPTools\Network;

defined('BASEPATH') OR exit('No direct script access allowed');

if (PHP_SAPI !== 'cli')
    exit('No web access allowed');

class SetsCli extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->helper('iplists');
        $this->load->model('ip_lists_model');
        $this->load->model('import_lists_model');
    }

    public function index() {
        //read the folder uploads
        $files = $this->import_lists_model->findAll();

        foreach ($files as $file) {
            echo 'Processing - ' . $file['link'] . "\n";
            if ($file['status'] == 'waiting') {

                $link = file_get_contents($file['link']);
                $ipsets = explode("\n", $link);
                //$ipsets = read_ipset($file['filename']);
                if ($file['task'] == 'import') {
                    $this->import_lists_model->save(array('status' => 'importing'), $file['id']);
                    $isDatacenter = $file['isDatacenter'] == 1 ? TRUE : FALSE;
                    $isProxy = $file['isProxy'] == 1 ? TRUE : FALSE;
                    $counter = 1;
                    foreach ($ipsets as $ip) {
                        $ip_data = array();
                        $ip = clean_ip($ip);

                        if (check_ip($ip)) {
                            if (!$this->ip_lists_model->is_unique($ip)) {
                                echo 'line ' . $counter . " {$ip} - already exists.\n";
                                $counter++;
                                continue;
                            }
                            //insert the IP                    
                            $range = Range::parse($ip);
                            $first_ip = $range->getFirstIP();
                            $last_ip = $range->getLastIP();
                            $ip_data = array(
                                'ip' => $ip,
                                'first_ip' => (string) $first_ip,
                                'last_ip' => (string) $last_ip,
                                'isDatacenter' => $isDatacenter,
                                'isProxy' => $isProxy
                            );

                            $this->ip_lists_model->insert($ip_data);
                            echo 'line ' . $counter . " {$ip} - added.\n";
                        }
                        $counter++;
                    }
                }

                if ($file['task'] == 'remove') {
                    $this->import_lists_model->save(array('status' => 'removing'), $file['id']);
                    $link = file_get_contents($file['link']);
                    $ipsets = explode("\n", $link);
                    foreach ($ipsets as $ipset) {
                        //valid ip
                        if (check_ip($ipset)) {
                            $ipset = clean_ip($ipset);
                            $this->ip_lists_model->query("DELETE FROM ip_lists WHERE ip='" . $ipset . "'");
                        }
                    }
                }
            }
            echo $file['link'] . ' - done' . "\n";
            $this->import_lists_model->save(array('status' => 'done'), $file['id']);
            //$this->import_lists_model->remove($file['id']);
            //unlink("{$file['filename']}");
        }
    }

    public function remove() {
        
    }

}
