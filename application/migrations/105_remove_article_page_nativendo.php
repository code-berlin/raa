<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Remove_Article_Page_Nativendo extends Basic_migration
{

    function __construct()
    {
        parent::__construct();
        $this->filename = __FILE__;
    }

    public function mig_up()
    {
        $this->db->query("DELETE FROM `template` WHERE (`name`) = ('article_page_nativendo');");
    }

    public function mig_down()
    {
        $this->db->query("INSERT INTO `template` (`name`) VALUES ('article_page_nativendo');");
    }

}