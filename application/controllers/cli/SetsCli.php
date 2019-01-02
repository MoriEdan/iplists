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

            $ipsets = read_ipset($file['filename']);
            echo 'Processing - ' . $file['filename'] . "\n";
            $isDatacenter = $file['isDatacenter'] == 1 ? TRUE : FALSE;
            $isProxy = $file['isProxy'] == 1 ? TRUE : FALSE;
            $counter = 1;
            foreach ($ipsets as $ip) {
                $ip_data = array();
                $ip = clean_ip($ip);
                echo 'line - ' . $counter . " {$ip}\n";
                if (check_ip($ip)) {                    
                    if (!$this->ip_lists_model->is_unique($ip)) {
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
                   
                }
                $counter++;
            }
            echo $file['filename'] . ' - done'."\n";
            $this->import_lists_model->remove($file['id']);
            unlink("{$file['filename']}");
        }
        echo 'Import Done';
    }

}
