<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Create_Widgets_Containers_Relation_Table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
      $this->db->query("CREATE TABLE IF NOT EXISTS `widgets_containers_relation` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `widget_id` int(11) NOT NULL,
                        `widgets_container_id` int(11) NOT NULL,
                        `widget_position` int(11) NOT NULL,
                        PRIMARY KEY (`id`),
                        KEY `widget_id` (`widget_id`,`widgets_container_id`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

      $this->db->query("ALTER TABLE  `widgets_containers_relation` ADD FOREIGN KEY ( `widget_id` ) REFERENCES `widget` (`id`) ON DELETE CASCADE ON UPDATE CASCADE ;");

      $this->db->query("ALTER TABLE `widgets_containers_relation` ADD FOREIGN KEY ( `widgets_container_id` ) REFERENCES `widgets_container` (`id`) ON DELETE CASCADE ON UPDATE CASCADE ;");
    }

    public function mig_down() {
      $this->db->query("DROP TABLE widgets_containers_relation");
    }
}
