<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Change_With_Sidebar_Template_Name_To_Article_Page extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query("UPDATE `template` SET `name` = 'article_page' WHERE `template`.`id`=4");
    }

    public function mig_down() {
        $this->db->query("UPDATE `template` SET `name` = 'with_sidebar' WHERE `template`.`id`=4");
    }
}