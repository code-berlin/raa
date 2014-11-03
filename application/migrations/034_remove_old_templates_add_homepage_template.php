<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Remove_Old_Templates_Add_Homepage_Template extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {

        $this->db->query("ALTER TABLE `page` DROP FOREIGN KEY `page_ibfk_1` ");

        $this->db->query("TRUNCATE template");
        $this->db->query("INSERT INTO `template` (`id`, `name`) VALUES (1, 'homepage');");

        $this->db->query("ALTER TABLE `page` ADD FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }

    public function mig_down() {
            
        $this->db->query("ALTER TABLE `page` DROP FOREIGN KEY  `page_ibfk_1` ");

        $this->db->query("TRUNCATE template");
        $this->db->query("INSERT INTO `template` (`id`, `name`) VALUES
                            (1, 'template1'),
                            (2, 'template1'),
                            (3, 'productlist'),
                            (4, 'template1');");

        $this->db->query("ALTER TABLE `page` ADD FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }
}