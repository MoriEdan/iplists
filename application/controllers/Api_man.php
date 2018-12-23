<?php

class Api_man extends MY_Controller {

    public $publicAccess = false;

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect();
        }
        $this->load->model('keys_model');
    }

    public function index() {
        $data = array();
        $data['keys'] = $this->keys_model->findAll();
        $data['content'] = $this->load->view('api_man/index', $data, TRUE);
        $this->render($data);
    }

}
