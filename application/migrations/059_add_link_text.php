<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Link_Text extends Basic_migration {

	 function __construct() {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query('ALTER TABLE  `page` ADD  `headline` VARCHAR(255) DEFAULT NULL AFTER  `menu_title`;');
    	$this->db->query('UPDATE `page` SET `headline` = `menu_title`;');
    }

    public function mig_down() {
    	$this->db->query('ALTER TABLE `page` DROP `headline`;');
	}

}