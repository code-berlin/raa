<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Duty_Text_To_Product_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query('ALTER TABLE  `productteaser` ADD  `duty_text` VARCHAR(500) DEFAULT NULL AFTER  `teaser_text`;');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `productteaser` DROP `duty_text`;');
    }

}
