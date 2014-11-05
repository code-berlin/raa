<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Modify_Title_Field_Name extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query('ALTER TABLE `page` CHANGE COLUMN `title` `menu_title` varchar(255);');        
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `page` CHANGE COLUMN `menu_title` `title` varchar(255);');
    }
}