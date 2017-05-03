<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Teaser_Image_And_Dropdown_Switch extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("INSERT INTO `teasertypes` (`name`, `field_amount`) VALUES ('image_and_dropdown_switch', 0);");
    }

    public function mig_down() {
        $this->db->query("DELETE FROM `teasertypes` WHERE `name` = 'image_and_dropdown_switch';");
    }

}
