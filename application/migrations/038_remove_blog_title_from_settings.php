<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Remove_Blog_Title_From_Settings extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query("ALTER TABLE `settings` DROP `blog_title`;");
    }

    public function mig_down() {
        $this->db->query("ALTER TABLE `settings` ADD `blog_title` VARCHAR(255) NOT NULL AFTER `id`;");
    }
}