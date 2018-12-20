<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Migration_iplists_tables extends CI_Migration {

    public function up() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'first_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'last_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'isDatacenter' => array(
                'type' => 'BIT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'isProxy' => array(
                'type' => 'BIT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'notes' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            )
        ));
        $this->dbforge->create_table('ip_lists');

        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'filename' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => TRUE
            ),
            'isDatacenter' => array(
                'type' => 'BIT',
                'constraint' => 1,
                'null' => TRUE
            ),
            'isProxy' => array(
                'type' => 'BIT',
                'constraint' => 1,
                'null' => TRUE
            )
        ));
        $this->dbforge->create_table('import_lists');
    }

    public function down() {
        $this->dbforge->drop_table('ip_lists');
        $this->dbforge->drop_table('import_lists');
    }

}
