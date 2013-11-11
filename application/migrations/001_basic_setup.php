<?php
class Migration_Basic_Setup extends CI_Migration {
    public function up() {
        $this->db->query('CREATE TABLE IF NOT EXISTS `page` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `id_template` int(11) DEFAULT NULL,
          `title` varchar(255) DEFAULT NULL,
          `text` text,
          `image` varchar(255) DEFAULT NULL,
          `slug` varchar(510) DEFAULT NULL,
          `date` datetime DEFAULT NULL,
          `published` tinyint(1) DEFAULT NULL,
          PRIMARY KEY (`id`),
          KEY `id_template` (`id_template`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

        $this->db->query('CREATE TABLE IF NOT EXISTS `template` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

        $this->db->query('CREATE TABLE IF NOT EXISTS `type` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

        $this->db->query('CREATE TABLE IF NOT EXISTS `url` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `slug` varchar(510) NOT NULL,
          `type_id` int(11) NOT NULL,
          PRIMARY KEY (`id`),
          KEY `id_type` (`type_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

        /*
        $this->db->query('ALTER TABLE `page`
          ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`id_template`) REFERENCES `template` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;');

        $this->db->query('ALTER TABLE `url`
          ADD CONSTRAINT `url_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);');
        //*/

    }

    public function down() {
        $this->dbforge->drop_table('page');
        $this->dbforge->drop_table('template');
        $this->dbforge->drop_table('type');
        $this->dbforge->drop_table('url');
    }
}