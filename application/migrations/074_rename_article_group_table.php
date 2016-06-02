<?php

require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Rename_Article_Group_Table extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
      $this->db->query("RENAME TABLE  `article_group` TO  `articlegroup` ;");
    }

    public function mig_down() {
      $this->db->query("RENAME TABLE  `articlegroup` TO  `article_group` ;");
    }

}