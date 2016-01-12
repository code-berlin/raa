<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Sidebar_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query('CREATE TABLE IF NOT EXISTS `sidebar_teaser` (
                            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                            `text` VARCHAR(255) NOT NULL,
                            `image` VARCHAR(255) NOT NULL,
                            `url` VARCHAR(255) NOT NULL,
                            `published` tinyint(1) NOT NULL,
                            `external` TINYINT(1) NOT NULL,
                            PRIMARY KEY (`id`))
                          ENGINE = InnoDB;');

        $this->db->query("INSERT INTO `permission` (`name`) VALUES
                            ('EDIT_SIDEBAR_TEASER');");

        $id = $this->db->insert_id();

        $this->db->query("INSERT INTO `rolepermission` (`role_id`, `permission_id`) VALUES
                            (1, " . $id . ");");

    }

    public function mig_down() {
        $this->db->query("DROP TABLE sidebar_teaser");

        $sql = $this->db->query("SELECT id FROM permission WHERE `name` = 'EDIT_SIDEBAR_TEASER';");
        
        if (isset($sql->row()->id) && $sql->row()->id > 0) {
            $this->db->query("DELETE FROM `rolepermission` WHERE `permission_id` = " . $sql->row()->id . ";");
        }        
        

        $this->db->query("DELETE FROM `permission` WHERE `name` = 'EDIT_SIDEBAR_TEASER';");
    }
}