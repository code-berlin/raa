<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Multi_Type_Teaser_Items extends Basic_migration {
    
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query('ALTER TABLE `teaser_item` CHANGE `content_type` `content_type` ENUM(\'page\', \'external\') NOT NULL;');
    	$this->db->query('ALTER TABLE `teaser_item` CHANGE `contentId` `contentId` INT(11) UNSIGNED NULL;');
    	$this->db->query('ALTER TABLE `teaser_item` ADD `external_link` VARCHAR( 1024 ) NULL DEFAULT NULL;');
        $this->db->query('ALTER TABLE `teaser_item` ADD `external_image` varchar(255) DEFAULT NULL;');
    }

    public function mig_down() {

    }
}