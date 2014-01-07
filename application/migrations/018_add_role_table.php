<?php
require_once(APPPATH . 'migrations/basic_migration.php');
class Migration_Add_Role_Table extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `role` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `title` varchar(255) DEFAULT NULL,
                        `description` text,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;');

        $this->db->query("INSERT INTO `role` (`id`, `title`, `description`) VALUES (1, 'superadmin', 'A superadmin is a user who has full control of the system, including creating admins');");
        $this->db->query("INSERT INTO `role` (`id`, `title`, `description`) VALUES (2, 'admin', 'An admin is the general administrator of the system');");
        $this->db->query("INSERT INTO `role` (`id`, `title`, `description`) VALUES (3, 'editor', 'An editor can CRUD contents');");

        $this->db->query("ALTER TABLE `user` ADD `id_role` int(11) NOT NULL;");

        $this->db->query("INSERT INTO `user` (`id`, `username`, `password`, `id_role`) VALUES (NULL, 'superadmin@code-b.com', 'b5edbafd026b773a7eb36d9b42b1bd6a952ddfdd', 1);");

        $this->db->query("UPDATE `user` SET `id_role` = '2' WHERE `user`.`id` = 1;");
        $this->db->query("UPDATE `user` SET `id_role` = '1' WHERE `user`.`id` = 2;");
        

    }

    public function mig_down() {
        $this->dbforge->drop_table('role');
        $this->db->query("delete from `user` where `id` = 2;");
    }
}