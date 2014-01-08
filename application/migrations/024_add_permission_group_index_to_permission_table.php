<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_add_permission_group_index_to_permission_table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("ALTER TABLE  `permission` ADD  `permissiongroup_id` INT( 10 ) NOT NULL AFTER  `name`, ADD INDEX (  `permissiongroup_id` )");
    }

    public function mig_down() {
        $this->db->query("ALTER TABLE `permission` DROP `permissiongroup_id`");
    }
}