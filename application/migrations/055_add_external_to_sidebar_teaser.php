<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_External_To_Sidebar_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query('ALTER TABLE `sidebar_teaser` ADD  `external` TINYINT(1) NOT NULL;');
    }

    public function mig_down() {

    }
}