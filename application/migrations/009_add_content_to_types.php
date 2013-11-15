<?php
class Migration_Add_Content_To_Types extends CI_Migration {
    public function up() {
      $this->db->query("INSERT INTO `type` (`id`, `name`) VALUES (1, 'page'), (2, 'post');");
    }

    public function down() {
      $this->db->query("DELETE FROM `type`");
    }
}
