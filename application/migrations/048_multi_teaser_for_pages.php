<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Multi_Teaser_For_Pages extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {

        $this->db->query('CREATE TABLE IF NOT EXISTS `teaser_types` (
                          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                          `name` VARCHAR(45) NOT NULL,
                          `field_amount` INT(1) NOT NULL,
                          PRIMARY KEY (`id`))
                        ENGINE = InnoDB');

        $this->db->query('CREATE TABLE IF NOT EXISTS `teaser_instance` (
                          `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                          `position` INT(2) NOT NULL,
                          `page_id` INT(11) NOT NULL,
                          `title` VARCHAR(120) NULL,
                          `text` VARCHAR(720) NULL,
                          `published` tinyint(1) UNSIGNED NOT NULL DEFAULT \'1\',
                          `teaser_types_id` INT UNSIGNED NOT NULL,
                          PRIMARY KEY (`id`),
                          INDEX `fk_teaser_instance_page1_idx` (`page_id` ASC),
                          INDEX `fk_teaser_instance_teaser_types1_idx` (`teaser_types_id` ASC),
                          CONSTRAINT `fk_teaser_instance_page1`
                            FOREIGN KEY (`page_id`)
                            REFERENCES `page` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                          CONSTRAINT `fk_teaser_instance_teaser_types1`
                            FOREIGN KEY (`teaser_types_id`)
                            REFERENCES `teaser_types` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION)
                        ENGINE = InnoDB');

        $this->db->query('CREATE TABLE IF NOT EXISTS `teaser_item` (
                          `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                          `title` VARCHAR(120) NULL,
                          `text` VARCHAR(720) NULL,
                          `content_type` VARCHAR(45) NOT NULL,
                          `contentId` INT(11) UNSIGNED NOT NULL,
                          `position` INT(2) UNSIGNED NOT NULL,
                          `teaser_instanceId` INT(11) UNSIGNED NOT NULL,
                          `published` tinyint(1) UNSIGNED NOT NULL DEFAULT \'1\',
                          PRIMARY KEY (`id`, `teaser_instanceId`),
                          INDEX `fk_teaser_item_teaser_instance_idx` (`teaser_instanceId` ASC),
                          CONSTRAINT `fk_teaser_item_teaser_instance`
                            FOREIGN KEY (`teaser_instanceId`)
                            REFERENCES `teaser_instance` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION)
                        ENGINE = InnoDB');

        $this->db->query("INSERT INTO `teaser_types` (`name`, `field_amount`) VALUES
                            ('main', 1), 
                            ('1bigLeft_4smallRight', 5), 
                            ('1bigTop_6smallBottom', 7), 
                            ('default', 0);");

        $this->db->query("INSERT INTO `permission` (`id`, `name`) VALUES
                            (74, 'EDIT_TEASER');");

        $this->db->query("INSERT INTO `rolepermission` (`role_id`, `permission_id`) VALUES
                            (1, 74);");

    }

    public function mig_down() {

        $this->dbforge->drop_table('teaser_item');
        
        $this->dbforge->drop_table('teaser_instance');

        $this->dbforge->drop_table('teaser_types');

        $this->db->query("DELETE FROM `rolepermission` WHERE `role_id` = 1 AND `permission_id` = 74;");

        $this->db->query("DELETE FROM `permission` WHERE `id` = 74 AND `name` = 'EDIT_TEASER';");

    }
}