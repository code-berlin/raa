<?php
class Migration_Add_Content_To_Types_Table extends CI_Migration {
    public function up() {
    	$this->db->query("ALTER TABLE `url` DROP FOREIGN KEY `url_ibfk_1`");
    	$this->db->query("ALTER TABLE `url` DROP INDEX `id_type`");
    	$this->db->query("DELETE FROM `type`");
      	$this->db->query("INSERT INTO `type` (`id`, `name`) VALUES
			(1, 'page'),
			(2, 'menu'),
			(3, 'widget');");
      	$this->db->query("ALTER TABLE `url` ADD INDEX `id_type` (`type_id`)");
		// $this->db->query("ALTER TABLE `url` ADD FOREIGN KEY (`url_ibfk_1`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");
		$this->db->query('ALTER TABLE `url` ADD CONSTRAINT `url_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);');
    }

    public function down() {
     	$this->db->query("ALTER TABLE `url` DROP FOREIGN KEY `url_ibfk_1`");
    	$this->db->query("ALTER TABLE `url` DROP INDEX `id_type`");
    	$this->db->query("DELETE FROM `type`");
      	$this->db->query("INSERT INTO `type` (`id`, `name`) VALUES
			(1, 'page'),
			(2, 'post');");
      $this->db->query("ALTER TABLE `url` ADD INDEX `id_type` (`type_id`)");
		$this->db->query('ALTER TABLE `url` ADD CONSTRAINT `url_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);');
    }
}
