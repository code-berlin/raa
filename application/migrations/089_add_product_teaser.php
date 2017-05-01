<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Product_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query("CREATE TABLE IF NOT EXISTS `productteaser` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) NOT NULL,
                            `link` varchar(1024) NOT NULL,
                            `image` varchar(255) NOT NULL,
                            `teaser_title` varchar(255) NOT NULL,
                            `teaser_text` varchar(255) NOT NULL,
                            `published` tinyint(1) DEFAULT 0,
                            PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
            ;");

        $this->db->query("INSERT INTO `permission` (`name`) VALUES
                            ('EDIT_PRODUCT_TEASER');");

        $id = $this->db->insert_id();

        $this->db->query("INSERT INTO `rolepermission` (`role_id`, `permission_id`) VALUES
                            (1, " . $id . ");");

        $this->db->query("ALTER TABLE `page` ADD `productteaser_order` varchar(255) NULL AFTER `commercial`;");

    }

    public function mig_down() {
    	$this->db->query("DROP TABLE `productteaser`;");

        $sql = $this->db->query("SELECT id FROM permission WHERE `name` = 'EDIT_PRODUCT_TEASER';");
        
        if (isset($sql->row()->id) && $sql->row()->id > 0) {
            $this->db->query("DELETE FROM `rolepermission` WHERE `permission_id` = " . $sql->row()->id . ";");
        }        
        

        $this->db->query("DELETE FROM `permission` WHERE `name` = 'EDIT_PRODUCT_TEASER';");

        $this->db->query("ALTER TABLE `page`
                            DROP `productteaser_order`;");
    }

}
