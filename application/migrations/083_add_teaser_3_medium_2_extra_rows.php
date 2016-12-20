<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Teaser_3_Medium_2_Extra_Rows extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("INSERT INTO `teasertypes` (`name`, `field_amount`) VALUES ('3medium_2extrasRows', 9);");
    }

    public function mig_down() {
        $this->db->query("DELETE FROM `teasertypes` WHERE `name` = '3medium_2extrasRows';");
    }

}
