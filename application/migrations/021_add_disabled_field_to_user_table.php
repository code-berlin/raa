<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Disabled_Field_To_User_Table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
      $this->db->query("ALTER TABLE `user`  ADD `disabled` TINYINT(1) NOT NULL DEFAULT '0'");
    }

    public function mig_down() {
      $this->db->query("ALTER TABLE `user` DROP `disabled`");
    }
}
