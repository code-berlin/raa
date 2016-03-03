<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Textonly_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("INSERT INTO `teasertypes` (`name`, `field_amount`) VALUES ('textonly', 0);");
        $this->db->query("ALTER TABLE `teaseritem` CHANGE `text` `text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL");
    }

    public function mig_down() {
        $this->db->query("DELETE FROM `teasertypes` WHERE `name` = 'textonly';");
        $this->db->query("ALTER TABLE `teaseritem` CHANGE `text` `text` VARCHAR(720) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL");
    }

}