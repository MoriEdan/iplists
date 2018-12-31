<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ip_lists_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->loadTable('ip_lists');
    }

    function exists($ip) {
        if ($result = $this->findAll("inet_aton('{$ip}') >= inet_aton(first_ip) and inet_aton('{$ip}') <= inet_aton(last_ip)", '*', 'id DESC', 0, 1)) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function is_unique($ip) {
        if ($this->findCount("ip='" . $ip . "'")) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function insert_unique($ip_data) {
        if ($this->findCount("ip='" . $ip_data['ip'] . "'")) {
            return FALSE;
        } else {
            $this->insert($ip_data);
            return TRUE;
        }
    }

}
