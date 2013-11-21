<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Load_Predefined_Container extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
      $this->db->query("INSERT INTO  `widgetscontainer` (`name`, `status`) VALUES ('Container',  '1');");
    }

    public function mig_down() {
      $this->db->query("DELETE FROM  `widgetscontainer` WHERE  `name` =  'Container';");
    }
}