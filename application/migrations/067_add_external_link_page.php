<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_External_Link_Page extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query("INSERT INTO `template` (`name`) VALUES ('external_link_page');");

        // new 
    }

    public function mig_down() {
    	$this->db->query("DELETE FROM `template` WHERE (`name`) = ('external_link_page');");
    }

}