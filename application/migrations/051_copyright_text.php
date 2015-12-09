<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Copyright_Text extends Basic_migration {

	function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	
    	$this->db->query("ALTER TABLE `settings` ADD `default_copyright_text` TEXT NULL");
    	$this->db->query("ALTER TABLE `page` ADD `use_copyright_text` TINYINT( 1 ) NOT NULL DEFAULT '0'");
    	$this->db->query("ALTER TABLE `page` ADD  `copyright_text` TEXT NULL");

    }

    public function mig_down() {
    	$this->db->query("ALTER TABLE `settings` DROP `default_copyright_text`;");
    	$this->db->query("ALTER TABLE `page` DROP `use_copyright_text`;");
    	$this->db->query("ALTER TABLE `page` DROP `copyright_text`;");
    }

}