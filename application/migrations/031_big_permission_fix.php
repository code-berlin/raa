<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_big_permission_fix extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query("TRUNCATE permission");
        $this->db->query("INSERT INTO `permission` (`id`, `name`, `permissiongroup_id`) VALUES
                        (1, 'CREATE_USER', 0),
                        (2, 'DELETE_USER', 0),
                        (3, 'UPDATE_USER', 0),
                        (4, 'CREATE_POST', 0),
                        (5, 'DELETE_POST', 0),
                        (6, 'UPDATE_POST', 0),
                        (7, 'VIEW_PAGE', 0),
                        (8, 'CREATE_PAGE', 0),
                        (9, 'DELETE_PAGE', 0),
                        (10, 'UPDATE_PAGE', 0),
                        (16, 'VIEW_MENU', 0),
                        (17, 'VIEW_PAGES', 0),
                        (18, 'VIEW_PRODUCT', 0),
                        (19, 'VIEW_USER', 0),
                        (20, 'VIEW_ROLE', 0),
                        (21, 'VIEW_SECTION', 0),
                        (22, 'VIEW_PERMISSION', 0),
                        (23, 'VIEW_GENERAL_SETTINGS', 0),
                        (26, 'VIEW_WIDGETS', 0),
                        (28, 'UPDATE_ROLE', 0),
                        (29, 'CREATE_ROLE', 0),
                        (30, 'DELETE_ROLE', 0),
                        (31, 'CREATE_PERMISSION', 0),
                        (32, 'EDIT_PERMISSION', 0),
                        (34, 'CREATE_MENU', 0),
                        (35, 'EDIT_MENU', 0);");
    }

    public function mig_down() {
        $this->db->query("TRUNCATE permission");
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
                            (10, 'UPDATE_PAGE'),
                            (16, 'VIEW_MENU', 0),
                            (17, 'VIEW_PAGES', 0),
                            (18, 'VIEW_PRODUCTS', 0),
                            (19, 'VIEW_USERS', 0),
                            (20, 'VIEW_ROLES', 0),
                            (21, 'VIEW_SECTIONS', 0),
                            (22, 'VIEW_PERMISSIONS', 0),
                            (23, 'VIEW_SETTINGS', 0),
                            (26, 'VIEW_WIDGETS', 0);");
    }
}