<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Title_To_Sidebar_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("ALTER TABLE `sidebarteaser` ADD `title` VARCHAR( 120 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `id`;");
    }

    public function mig_down() {

        $this->db->query("ALTER TABLE `sidebarteaser` DROP `title`;");
    }

}