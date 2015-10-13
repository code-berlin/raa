<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Import_Wp_Data extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
      

    }

    public function mig_down() {

    }
}