<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Create_Super_Admin extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        //gives role permissions to create superadmin
        $this->auth_l->create_super_admin();
    }

    public function mig_down() {
    }
}

