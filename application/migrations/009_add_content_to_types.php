<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Content_To_Types extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
      $this->db->query("INSERT INTO `type` (`id`, `name`) VALUES (1, 'page'), (2, 'post');");
    }

    public function mig_down() {
		$this->db->query("DELETE FROM `type`");
		$this->db->query("ALTER TABLE `type` AUTO_INCREMENT = 1;");
    }
}
