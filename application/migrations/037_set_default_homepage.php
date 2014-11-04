<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Set_Default_Homepage extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query("UPDATE `settings` SET `page_id` = '1' WHERE `email`= 'default@email-address.de';");
    }

    public function mig_down() {
        $this->db->query("UPDATE `settings` SET `page_id` = NULL WHERE `email`= 'default@email-address.de';");
    }
}