<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_External_Link_Page_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("INSERT INTO `teasertypes` (`name`, `field_amount`) VALUES ('external_link_page', 0);");
    }

    public function mig_down() {

        $this->db->query("DELETE FROM `teaseritem` WHERE `teaser_instanceId` = (SELECT `id` FROM `teaserinstance` WHERE `teaser_types_id` = (SELECT `id` FROM `teaser_types` WHERE `name` = 'external_link_page'));");

        $this->db->query("DELETE FROM `teaserinstance` WHERE `teaser_types_id` = (SELECT `id` FROM `teasertypes` WHERE `name` = 'external_link_page');");

        $this->db->query("DELETE FROM `teasertypes` WHERE `name` = 'external_link_page'");

    }

}