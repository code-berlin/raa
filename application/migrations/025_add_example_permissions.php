<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_add_example_permissions extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("INSERT INTO `permission` (`id`, `name`) VALUES
                            (1, 'CREATE_USER'),
                            (2, 'DELETE_USER'),
                            (3, 'UPDATE_USER'),
                            (4, 'CREATE_POST'),
                            (5, 'DELETE_POST'),
                            (6, 'UPDATE_POST'),
                            (7, 'VIEW_PAGE'),
                            (8, 'CREATE_PAGE'),
                            (9, 'DELETE_PAGE'),
                            (10, 'UPDATE_PAGE');");
    }

    public function mig_down() {
        $this->db->query("TRUNCATE permission");
    }
}