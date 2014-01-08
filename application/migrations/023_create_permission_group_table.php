<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_create_permission_group_table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("CREATE TABLE `permissiongroup` (
                          `id` int(10) NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) NOT NULL,
                          PRIMARY KEY (`id`),
                          KEY `name` (`name`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    }

    public function mig_down() {
        $this->db->query("DROP TABLE permissiongroup");
    }
}