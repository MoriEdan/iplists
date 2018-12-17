<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_lists_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->loadTable('import_lists');
    }

}
