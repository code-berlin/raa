<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Position_To_Sidebarteaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query('ALTER TABLE `sidebarteaser` ADD  `position` TINYINT NULL DEFAULT NULL;');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `sidebarteaser` DROP `position`;');
    }

}