<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Homepage_Field_On_General_Settings extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("ALTER TABLE `settings` ADD COLUMN `page_id` INT(11) NULL AFTER `seo_footer_text`;");
    }

    public function mig_down() {
        $this->db->query("ALTER TABLE `settings` DROP COLUMN `page_id`;");
    }
}
