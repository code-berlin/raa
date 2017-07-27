<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Additional_Text extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("ALTER TABLE `page`
                          ADD `additional_text` VARCHAR(255)
                          CHARACTER SET utf8
                          COLLATE utf8_general_ci NULL
                          DEFAULT NULL
                          AFTER `ad_keywords`;");
    }

    public function mig_down() {
        $this->db->query("ALTER TABLE `page`
                          DROP `additional_text`;");
    }

}
