<?php
class Migration_Load_Predefined_Container extends CI_Migration {
    public function up() {
      $this->db->query("INSERT INTO  `widgetscontainer` (`name`, `status`) VALUES ('Container',  '1');");
    }

    public function down() {
      $this->db->query("DELETE FROM  `widgetscontainer` WHERE  `name` =  'Container';");
    }
}