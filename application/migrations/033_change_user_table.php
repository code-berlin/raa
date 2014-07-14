<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Change_User_Table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("ALTER TABLE  `user` ADD  `surname` VARCHAR( 255 ) NOT NULL AFTER  `name` ,
                          ADD  `nickname` VARCHAR( 255 ) NULL AFTER  `surname` ,
                          ADD  `language_id` INT( 11 ) NOT NULL DEFAULT  '1' AFTER  `nickname`");
    }

    public function mig_down() {
        $this->db->query("ALTER TABLE `user` DROP COLUMN `surname`;");
        $this->db->query("ALTER TABLE `user` DROP COLUMN `nickname`;");
        $this->db->query("ALTER TABLE `user` DROP COLUMN `language_id`;");
    }
}

