<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Rename_role_link_field_on_user_table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("ALTER TABLE `user` CHANGE COLUMN `id_role` `role_id` INT(11) NOT NULL AFTER `password`;");
    }

    public function mig_down() {
        $this->db->query("ALTER TABLE `user` CHANGE COLUMN `role_id` `id_role` INT(11) NOT NULL AFTER `password`;");
    }
}