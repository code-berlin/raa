<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Sidebarteasertype extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `sidebarteasertypes` (
                          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                          `name` VARCHAR(45) NOT NULL,
                          PRIMARY KEY (`id`))
                        ENGINE = InnoDB");

        $this->db->query("ALTER TABLE `sidebarteaser` ADD  `sidebarteasertypes_id` INT UNSIGNED NOT NULL DEFAULT '1', ADD  `html` text AFTER `image`;");

        $this->db->query("INSERT INTO `sidebarteasertypes` (`name`) VALUES
                            ('image_title_text_button'),
                            ('image_title_text'),
                            ('image_title_text_bright'),
                            ('image_title_text_optional'),
                            ('image'),
                            ('html');");
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `sidebarteaser` DROP `sidebarteasertypes_id`, DROP `html`;');
        $this->dbforge->drop_table('sidebarteasertypes');
    }

}