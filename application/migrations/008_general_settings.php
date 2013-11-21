<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_General_Settings extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
      $this->db->query("INSERT INTO `settings` (`id`, `blog_title`, `email`)
        VALUES (35, 'Default blog title', 'default@email-address.de');");
    }

    public function mig_down() {
      $this->db->query("TRUNCATE `settings`");
    }
}
