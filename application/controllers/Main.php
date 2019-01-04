<?php

use IPTools\Network;
use IPTools\Range;

defined('BASEPATH') OR exit('No direct script access allowed');

/** this is a public page * */
class Main extends MY_Controller {

    public $publicAccess = true;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->ion_auth->logged_in()) {
            redirect('iplists');
        }

        $data = array();
        $data['content'] = $this->load->view('main', [], TRUE);
        $this->render($data);
    }

    public function documentation() {
        $data = array();
        $data['content'] = $this->load->view('documentation', [], TRUE);
        $this->render($data);
    }

    public function downloads() {
        $data = array();
        $data['content'] = $this->load->view('downloads', [], TRUE);
        $this->render($data);
    }

    public function parse_json() {
        $file = file_get_contents('./uploads/ip-ranges.json');
        
        $json_data = json_decode($file, TRUE);
        
        foreach($json_data['prefixes'] as $key=>$value){
            if(!empty($value['ip_prefix'])){
                echo $value['ip_prefix'].'<br />';
            }            
        }
        
    }
    
    public function parse_xml(){
        $file = file_get_contents('./uploads/PublicIPs_20181231.xml');
        $xml_data = new SimpleXMLElement($file);
        print_r($xml_data);
        
    }

    public function test_layout() {
        $this->setBaseLayout('bootswatch');
        $data = array();
        $data['content'] = $this->load->view('test_layout', [], TRUE);
        $this->render($data);
    }

}
