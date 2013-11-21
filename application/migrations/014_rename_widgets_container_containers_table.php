<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Rename_Widgets_Container_Containers_Table extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
      $this->db->query("RENAME TABLE  `widgets_container` TO  `widgetscontainer` ;");
      $this->db->query("RENAME TABLE  `widgets_containers_relation` TO  `widgetscontainersrelation` ;");
    }

    public function mig_down() {
      $this->db->query("RENAME TABLE  `widgetscontainer` TO  `widgets_container` ;");
      $this->db->query("RENAME TABLE  `widgetscontainersrelation` TO  `widgets_containers_relation` ;");
    }
}


