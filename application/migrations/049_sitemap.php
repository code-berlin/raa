<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Sitemap extends Basic_migration {
    
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query("ALTER TABLE `page` ADD `sitemap_prio` VARCHAR(3) NOT NULL DEFAULT '0.8' AFTER `seo_footer_text`");

    	$this->db->query("UPDATE `page` SET `sitemap_prio` = '0.8';");

    }

    public function mig_down() {
    	$this->db->query("ALTER TABLE `page` DROP `sitemap_prio`");
    }
}