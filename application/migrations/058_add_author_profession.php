<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Author_Profession extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {


        $this->db->query('ALTER TABLE `author` CHANGE  `position` `profession` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');

        $this->db->query('ALTER TABLE `author` ADD `position` INT(11) NOT NULL;');


    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `author` DROP `position`');
        $this->db->query('ALTER TABLE `author` CHANGE `profession` `position` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');        
    }
}