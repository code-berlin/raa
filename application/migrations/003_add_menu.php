<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Menu extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `menu` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `published` tinyint(1) DEFAULT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

      $this->db->query('CREATE TABLE IF NOT EXISTS `menu_item` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `id_menu` int(11) NOT NULL,
                        `title` varchar(255) NOT NULL,
                        `slug` varchar(255) NOT NULL,
                        `url` varchar(255) NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');
    }

    public function mig_down() {
        $this->dbforge->drop_table('menu');
        $this->dbforge->drop_table('menu_item');
    }
}
