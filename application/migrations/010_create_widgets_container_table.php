<?php
class Migration_Create_Widgets_Container_Table extends CI_Migration {
    public function up() {
      $this->db->query("CREATE TABLE IF NOT EXISTS `widgets_container` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `status` tinyint(1) NOT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
    }

    public function down() {
      $this->db->query("DROP TABLE widgets_container");
    }
}
