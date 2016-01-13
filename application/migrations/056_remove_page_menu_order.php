<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Remove_Page_Menu_Order extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query('ALTER TABLE `page` DROP COLUMN `menu_order`;');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `page` ADD COLUMN `menu_order` int(11) AFTER `template_id`;');
    }
}