<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Teaser_Flex_Only_Images extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("INSERT INTO `teasertypes` (`name`, `field_amount`) VALUES ('flex_only_images', 0);");
    }

    public function mig_down() {
        $this->db->query("DELETE FROM `teasertypes` WHERE `name` = 'flex_only_images';");
    }

}
