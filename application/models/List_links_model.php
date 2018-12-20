<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class List_links_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->loadTable('list_links');
    }

}