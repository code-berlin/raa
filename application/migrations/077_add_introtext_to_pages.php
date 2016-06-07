<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Introtext_To_Pages extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query('ALTER TABLE `page` ADD `introtext` VARCHAR(300) NULL DEFAULT NULL AFTER `headline`;');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `page` DROP `introtext`;');
    }

}