<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Addition_Field_To_Article_Group_Item extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query('ALTER TABLE  `articlegroupitem` ADD  `addition` TINYINT( 1 ) NOT NULL;');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `articlegroupitem` DROP `addition`');
    }
}