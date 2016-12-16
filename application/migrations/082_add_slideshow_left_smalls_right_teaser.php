<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Slideshow_Left_Smalls_Right_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("INSERT INTO `teasertypes` (`name`, `field_amount`) VALUES ('1slideshowLeft_3smallRight', 0);");
    }

    public function mig_down() {
        $this->db->query("DELETE FROM `teasertypes` WHERE `name` = '1slideshowLeft_3smallRight';");
    }

}
