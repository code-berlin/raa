<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Page_Template_Price_Comparison extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query("INSERT INTO `template` (`name`) VALUES ('price_comparison');");
    }

    public function mig_down() {
    	$this->db->query("DELETE FROM `template` WHERE (`name`) = ('price_comparison');");
    }

}
