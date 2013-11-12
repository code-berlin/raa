<?php
class Migration_Change_Template_Reference extends CI_Migration {
    public function up() {
      $this->db->query("ALTER TABLE `page` DROP FOREIGN KEY  `page_ibfk_1` ");

      $this->db->query("ALTER TABLE `page` CHANGE  `id_template` `template_id` INT( 11 ) NULL DEFAULT NULL");

      $this->db->query("ALTER TABLE `page` ADD FOREIGN KEY (`template_id` ) REFERENCES `template` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
    }

    public function down() {
      $this->db->query("ALTER TABLE `page` DROP FOREIGN KEY  `page_ibfk_1` ");

      $this->db->query("ALTER TABLE `page` CHANGE `template_id` `id_template` INT( 11 ) NULL DEFAULT NULL");

      $this->db->query("ALTER TABLE `page` ADD FOREIGN KEY (`id_template` ) REFERENCES `template` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION ;");
    }
}
