<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Page_Creation_Date extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {

        $this->db->query("ALTER TABLE `page` ADD `date_created` DATETIME NULL AFTER `date`;");
        $this->db->query("UPDATE `page` SET `date_created` = '2016-01-01 00:00:01';");
    }

    public function mig_down() {
        $this->db->query("ALTER TABLE `page`
                          DROP `date_created`;");
    }

}
