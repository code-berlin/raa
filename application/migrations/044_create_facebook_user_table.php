<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Create_Facebook_User_Table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query(
            "CREATE TABLE IF NOT EXISTS `facebook_user` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `facebook_id` bigint(30) NOT NULL,
              `first_name` varchar(255) NOT NULL,
              `last_name` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65;"
        );        
    }

    public function mig_down() {
        $this->db->query('DROP TABLE `facebook_user`;');
    }
}