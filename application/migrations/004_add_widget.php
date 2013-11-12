<?php
class Migration_Add_Widget extends CI_Migration {
    public function up() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `widget` (
                       `id` int(11) NOT NULL AUTO_INCREMENT,
                       `widgetname` varchar(255) NOT NULL,
                       `activated` tinyint(1) NOT NULL,
                       `created` datetime DEFAULT NULL,
                       PRIMARY KEY (`id`)
                       ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

    }

    public function down() {
        $this->dbforge->drop_table('widget');
    }
}