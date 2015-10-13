<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Basic_Templates extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query("INSERT INTO `template` (`name`) VALUES ('contact');");
        $this->db->query("INSERT INTO `template` (`name`) VALUES ('static');");
        $this->db->query("INSERT INTO `template` (`name`) VALUES ('width_sidebar');");
    }

    public function mig_down() {
        $this->db->query("DELETE FROM `template` WHERE (`name`) = ('contact');");
        $this->db->query("DELETE FROM `template` WHERE (`name`) = ('static');");
        $this->db->query("DELETE FROM `template` WHERE (`name`) = ('with_sidebar');");
    }
}