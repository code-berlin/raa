<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Seo_Metainformation_Fields_Page_And_Content_Types extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {

      /* pages */
      $this->db->query("ALTER TABLE `page` ADD `seo_meta_keywords` VARCHAR( 512 ) NULL");
      $this->db->query("ALTER TABLE `page` ADD `seo_meta_title` VARCHAR( 512 ) NULL");
      $this->db->query("ALTER TABLE `page` ADD `seo_meta_description` VARCHAR( 512 ) NULL");
      $this->db->query("ALTER TABLE `page` ADD `seo_footer_text` TEXT NULL");

      /* product */
      $this->db->query("ALTER TABLE `product` ADD `seo_meta_keywords` VARCHAR( 512 ) NULL");
      $this->db->query("ALTER TABLE `product` ADD `seo_meta_title` VARCHAR( 512 ) NULL");
      $this->db->query("ALTER TABLE `product` ADD `seo_meta_description` VARCHAR( 512 ) NULL");
      $this->db->query("ALTER TABLE `product` ADD `seo_footer_text` TEXT NULL");
       
        
    }

    public function mig_down() {
      
      /* pages */      
      $this->db->query("ALTER TABLE `page` DROP `seo_meta_keywords`");
      $this->db->query("ALTER TABLE `page` DROP `seo_meta_title`");
      $this->db->query("ALTER TABLE `page` DROP `seo_meta_description`");
      $this->db->query("ALTER TABLE `page` DROP `seo_footer_text`");

      /* product */
      $this->db->query("ALTER TABLE `product` DROP `seo_meta_keywords`");
      $this->db->query("ALTER TABLE `product` DROP `seo_meta_title`");
      $this->db->query("ALTER TABLE `product` DROP `seo_meta_description`");
      $this->db->query("ALTER TABLE `product` DROP `seo_footer_text`");
       
    }
}
