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

    public function test() {
        $ip='asdfasdf';
        $network =  Network::parse($ip);
        echo $network->valid();
    }   

    public function test_layout() {
        $this->setBaseLayout('bootswatch');
        $data = array();
        $data['content'] = $this->load->view('test_layout', [], TRUE);
        $this->render($data);
    }

}
