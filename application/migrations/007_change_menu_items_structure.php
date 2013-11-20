<?php
class Migration_Change_Menu_Items_Structure extends CI_Migration {
    public function up() {
      $this->db->query("ALTER TABLE  `menu_item` CHANGE  `slug`  `url_id` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");

      $this->db->query("ALTER TABLE  `menu_item` CHANGE  `url_id`  `url_id` INT( 11 ) NULL");

      $this->db->query("ALTER TABLE  `menu_item` ADD INDEX (  `url_id` )");

      $this->db->query("ALTER TABLE  `menu_item` ADD FOREIGN KEY (  `url_id` ) REFERENCES `url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");

      $this->db->query("ALTER TABLE  `menu_item` DROP  `url`");

      $this->db->query("ALTER TABLE  `menu_item` ADD  `absolute_url` VARCHAR( 255 ) NOT NULL AFTER  `url_id`");

      $this->db->query("INSERT INTO `template` (`name`) VALUES ('template1'), ('template2');");
    }

    public function down() {
      $this->db->query("ALTER TABLE `menu_item` DROP FOREIGN KEY  `menu_item_ibfk_1` ");

      $this->db->query("ALTER TABLE  `menu_item` DROP INDEX  `url_id`");

      $this->db->query("ALTER TABLE  `menu_item` CHANGE  `url_id` `slug` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");

      $this->db->query("ALTER TABLE  `menu_item` DROP  `absolute_url`");

      $this->db->query("ALTER TABLE  `menu_item` ADD  `url` VARCHAR( 255 ) NOT NULL AFTER  `slug`");

      $this->db->query("DELETE FROM `template` WHERE `template`.`name` = 'template1';");
      $this->db->query("DELETE FROM `template` WHERE `template`.`name` = 'template2';");
    }
}
