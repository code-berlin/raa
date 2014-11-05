<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Set_Main_Category_For_Homepage extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query("UPDATE `page` SET `main_category` = '0' WHERE `slug`= 'home';");
    }

    public function mig_down() {
        $this->db->query("UPDATE `page` SET `main_category` = NULL WHERE `slug`= 'home';");
    }
}