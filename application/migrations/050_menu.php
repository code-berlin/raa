<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Menu extends Basic_migration {
    
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        
    	$this->db->query("ALTER TABLE `menu_item` DROP FOREIGN KEY `menu_item_ibfk_1`");

    	$this->db->query("ALTER TABLE `menu_item` DROP `url_id`;");

        $this->db->query("ALTER TABLE `menu_item` DROP `title`");

        $this->db->query("ALTER TABLE `menu_item` DROP `absolute_url`");

        $this->db->query("ALTER TABLE `menu_item` ADD `position` int(11) NOT NULL AFTER `id_menu`;");

    	$this->db->query("ALTER TABLE `menu_item` ADD `content_type` VARCHAR(45) NULL AFTER `id_menu`;");

    	$this->db->query("ALTER TABLE `menu_item` ADD `contentId` int(11) NULL AFTER `content_type`;");

    	$this->db->query("ALTER TABLE `menu_item` ADD `parent_id` int(11) DEFAULT NULL AFTER `contentId`;");

    	$this->db->query("ALTER TABLE `menu_item` ADD `published` tinyint(1) DEFAULT 1 AFTER `position`;");    	

        $this->db->query("INSERT INTO `menu` (`name`, `published`) VALUES ('main', 1), ('footer', 1), ('sidebar', 1);");
    }

    public function mig_down() {

        $this->db->query("ALTER TABLE `menu_item` DROP `position`;");

    	$this->db->query("ALTER TABLE `menu_item` DROP `contentId`;");

    	$this->db->query("ALTER TABLE `menu_item` DROP `content_type`;");

    	$this->db->query("ALTER TABLE `menu_item` DROP `parent_id`;");

    	$this->db->query("ALTER TABLE `menu_item` DROP `published`;");

    	$this->db->query("ALTER TABLE `menu_item` ADD `title` varchar(255) DEFAULT NULL AFTER `id_menu`;");

    	$this->db->query("ALTER TABLE `menu_item` ADD `url_id` int(11) DEFAULT NULL AFTER `title`;");

    	$this->db->query("ALTER TABLE `menu_item` ADD CONSTRAINT `menu_item_ibfk_1` FOREIGN KEY (`url_id`) REFERENCES `url` (`id`);");

    	$this->db->query("ALTER TABLE `menu_item` ADD `absolute_url` varchar(255) NOT NULL AFTER `url_id`;");

        $this->db->query("DELETE FROM `menu` WHERE `name` = 'main' OR `name` = 'footer' OR `name` = 'sidebar';");
    }

}