<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Author_For_Pages extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {


        $this->db->query("CREATE TABLE IF NOT EXISTS `author` (
                            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) NOT NULL,
                            `position` varchar(100) DEFAULT NULL,
                            `image` varchar(255) DEFAULT NULL,
                            `text` text,
                            `published` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = blocked, 1 = active',
                            `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = male, 1 = female',
                          PRIMARY KEY (`id`),
                          KEY `name` (`name`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query('ALTER TABLE `page` ADD `author_id` INT(10) UNSIGNED DEFAULT NULL;');

        $this->db->query('ALTER TABLE `page`
                            ADD CONSTRAINT `fk_page_author1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);');


    }

    public function mig_down() {
        $this->db->query("ALTER TABLE `page` DROP FOREIGN KEY `fk_page_author1`;");

        $this->db->query("ALTER TABLE `page` DROP `author_id`;");

        $this->db->query("DROP TABLE `author`;");
    }
}