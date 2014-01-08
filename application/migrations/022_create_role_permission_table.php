<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_create_role_permission_table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("CREATE TABLE `rolepermission` (
                          `id` int(10) NOT NULL AUTO_INCREMENT,
                          `role_id` int(10) NOT NULL,
                          `permission_id` int(10) NOT NULL,
                          PRIMARY KEY (`id`),
                          KEY `role_id` (`role_id`,`permission_id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    }

    public function mig_down() {
        $this->db->query("DROP TABLE rolepermission");
    }
}