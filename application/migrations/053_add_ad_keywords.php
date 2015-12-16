<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Ad_Keywords extends Basic_migration {
    
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query("ALTER TABLE `page` ADD `ad_keywords` VARCHAR( 1024 ) NULL;");
    }

    public function mig_down() {
    	$this->db->query("ALTER TABLE `page` DROP `ad_keywords`;");
	}

}