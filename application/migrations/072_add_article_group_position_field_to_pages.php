<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Article_Group_Position_Field_To_Pages extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
        $this->table = 'page';
    }
    public function mig_up() {
        $this->db->query('ALTER TABLE  `'.$this->table.'` ADD  `article_group_position` TINYINT NULL DEFAULT NULL AFTER  `article_group_id`;');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `'.$this->table.'` DROP `article_group_position`;');
    }

}