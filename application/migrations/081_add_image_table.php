<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Image_Table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `image` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `image` varchar(255) DEFAULT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

    }

    public function mig_down() {
        $this->dbforge->drop_table('image');
    }
}