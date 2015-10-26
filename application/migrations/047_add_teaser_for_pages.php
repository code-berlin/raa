<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Teaser_For_Pages extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {

        $this->db->query("ALTER TABLE `page` ADD `teaser_text` TEXT NULL");
        
    }

    public function mig_down() {
            
        $this->db->query("ALTER TABLE `page` DROP `teaser_text` ");
        
    }
}