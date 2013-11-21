<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Settings extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `settings` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `blog_title` varchar(255) NOT NULL,
                            `email` varchar(255) NOT NULL,
                            `seo` varchar(512) NULL,
                            `keywords` varchar(512) NULL,
                              PRIMARY KEY (`id`)
                           ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ");


    }

    public function mig_down() {
        $this->dbforge->drop_table('settings');
    }
}

