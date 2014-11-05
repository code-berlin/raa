<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_User_Table extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `user` (
      `id` INT(2) NOT NULL AUTO_INCREMENT,
      `username` VARCHAR(128) NOT NULL,
      `password` VARCHAR(128) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE INDEX `username_UNIQUE` (`username` ASC))
        ENGINE = InnoDB;');
    }

    public function mig_down() {
        $this->dbforge->drop_table('user');
    }
}
