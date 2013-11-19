<?php
class Migration_Add_Content_To_Types_Table extends CI_Migration {
    public function up() {
    	$this->db->query("DELETE FROM `type` WHERE `type`.`id` = 1;");
        $this->db->query("DELETE FROM `type` WHERE `type`.`id` = 2;");
        $this->db->query("DELETE FROM `type` WHERE `type`.`id` = 3;");

      	$this->db->query("INSERT INTO `type` (`id`, `name`) VALUES
			(1, 'page'),
			(2, 'menu'),
			(3, 'widget');");
    }

    public function down() {
        $this->db->query("DELETE FROM `type` WHERE `type`.`id` = 1;");
        $this->db->query("DELETE FROM `type` WHERE `type`.`id` = 2;");
        $this->db->query("DELETE FROM `type` WHERE `type`.`id` = 3;");

        $this->db->query("INSERT INTO `type` (`id`, `name`) VALUES
			(1, 'page'),
			(2, 'post');");
    }
}
