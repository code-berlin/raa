<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Widget extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `widget` (
                       `id` int(11) NOT NULL AUTO_INCREMENT,
                       `widgetname` varchar(255) NOT NULL,
                       `activated` tinyint(1) NOT NULL,
                       `created` datetime DEFAULT NULL,
                       PRIMARY KEY (`id`)
                       ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

    }

    public function mig_down() {
        $this->dbforge->drop_table('widget');
    }
}