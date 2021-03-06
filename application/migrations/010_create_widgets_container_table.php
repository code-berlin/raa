<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Create_Widgets_Container_Table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
      $this->db->query("CREATE TABLE IF NOT EXISTS `widgets_container` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `status` tinyint(1) NOT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    }

    public function mig_down() {
      $this->db->query("DROP TABLE widgets_container");
    }
}
