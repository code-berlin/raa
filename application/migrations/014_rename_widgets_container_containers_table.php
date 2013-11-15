<?php
class Migration_Rename_Widgets_Container_Containers_Table extends CI_Migration {
    public function up() {
      $this->db->query("RENAME TABLE  `widgets_container` TO  `widgetscontainer` ;");
      $this->db->query("RENAME TABLE  `widgets_containers_relation` TO  `widgetscontainersrelation` ;");
    }

    public function down() {
      $this->db->query("RENAME TABLE  `widgetscontainer` TO  `widgets_container` ;");
      $this->db->query("RENAME TABLE  `widgetscontainersrelation` TO  `widgets_containers_relation` ;");
    }
}


