<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Jumpmark extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {

        $this->db->query("ALTER TABLE `menuitem` ADD `jumpmark` varchar(255) NULL DEFAULT NULL;");
        $this->db->query('ALTER TABLE `teaserinstance` ADD `jumpmark` varchar(255) NULL DEFAULT NULL;');
    }

    public function mig_down() {

        $this->db->query("ALTER TABLE `menuitem` DROP `jumpmark`;");
        $this->db->query("ALTER TABLE `teaserinstance` DROP `jumpmark`;");
    }

}