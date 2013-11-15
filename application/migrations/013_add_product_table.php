<?php
class Migration_Add_Product_Table extends CI_Migration {
    public function up() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `product` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `title` varchar(255) DEFAULT NULL,
                        `text` text,
                        `price` double(11,2),
                        `image` varchar(255) DEFAULT NULL,
                        `slug` varchar(510) DEFAULT NULL,
                        `date` datetime DEFAULT NULL,
                        `published` tinyint(1) DEFAULT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

      $this->db->query("INSERT INTO `type` (`id`, `name`) VALUES (4, 'product');");

      $this->db->query("INSERT INTO `template` (`id`, `name`) VALUES (3, 'productlist');");      



    }

    public function down() {
        $this->dbforge->drop_table('product');
        
        $this->db->query("ALTER TABLE `url` DROP FOREIGN KEY `url_ibfk_1`");
        $this->db->query("ALTER TABLE `url` DROP INDEX `id_type`");
        $this->db->query("delete from `type` where `id` = 4;");
        $this->db->query("ALTER TABLE `url` ADD INDEX `id_type` (`type_id`)");
        $this->db->query('ALTER TABLE `url` ADD CONSTRAINT `url_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);');
        
        $this->db->query("delete from `template` where `id` = 3;");
    }
}