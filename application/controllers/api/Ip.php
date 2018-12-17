<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class IP extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->load->helper('iplists');
        $this->load->model('ip_lists_model');
    }

    function check_get() {
        $result['status'] = 'ok';

        $ip = $this->get('ip');

        if (check_ip($ip)) {
            if ($ip_data = $this->ip_lists_model->exists($ip)) {
                $result = array(
                    'isListed' => TRUE,
                    'isProxy' => $ip_data[0]['isProxy'],
                    'isDatacenter' => $ip_data[0]['isDatacenter']
                );
            } else {
                $result = array(
                    'isListed' => FALSE
                );
            }
        } else {
            $result = array(
                'status' => FALSE,
                'error' => 'Bad IP format'
            );
        }

        $this->response($result);
    }

}
