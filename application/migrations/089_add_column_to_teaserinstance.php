<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Column_To_Teaserinstance extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("ALTER TABLE `teaserinstance` ADD `column` TINYINT( 1 ) DEFAULT 0;");
    }

    public function mig_down() {
       $this->db->query("ALTER TABLE `teaserinstance` DROP `column`;");
    }

}