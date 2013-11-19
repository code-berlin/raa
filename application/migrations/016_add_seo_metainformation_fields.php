<?php
class Migration_Add_Seo_Metainformation_Fields extends CI_Migration {
    public function up() {
      $this->db->query("ALTER TABLE `settings` CHANGE `seo` `seo_meta_title` VARCHAR( 512 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
      $this->db->query("ALTER TABLE `settings` CHANGE `keywords` `seo_meta_keywords` VARCHAR( 512 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
      $this->db->query("ALTER TABLE `settings` ADD `seo_meta_description` VARCHAR( 512 ) NULL");
      $this->db->query("ALTER TABLE `settings` ADD `seo_footer_text` TEXT NULL");
        
    }

    public function down() {
      $this->db->query("ALTER TABLE `settings` DROP `seo_footer_text`");
      $this->db->query("ALTER TABLE `settings` DROP `seo_meta_description`");
      $this->db->query("ALTER TABLE `settings` CHANGE `seo_meta_title` `seo` VARCHAR( 512 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
      $this->db->query("ALTER TABLE `settings` CHANGE `seo_meta_keywords` `keywords` VARCHAR( 512 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");      
    }
}
