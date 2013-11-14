<?php
class Migration_Add_Settings extends CI_Migration {
    public function up() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `settings` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `blog_title` varchar(255) NOT NULL,
                            `email` varchar(255) NOT NULL,
                            `seo` varchar(512) NOT NULL,
                            `keywords` varchar(512) NOT NULL,
                              PRIMARY KEY (`id`)
                           ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ");


    }

    public function down() {
        $this->dbforge->drop_table('settings');
    }
}

