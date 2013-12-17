<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Product_Table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
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

    public function mig_down() {
        $this->dbforge->drop_table('product');
        $this->db->query("delete from `type` where `id` = 4;");
        $this->db->query("delete from `template` where `id` = 3;");
    }
}