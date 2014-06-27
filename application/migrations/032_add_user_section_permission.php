<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_User_Section_Permission extends Basic_migration {
    function __construct()
    {
        parent::__construct();

        $this->filename =  __FILE__;
    }

    public function mig_up() {
        // User overview
        $this->db->query("INSERT INTO `permission` (`id`, `name`) VALUES (72, 'VIEW_USER_PROFILE');");

        $this->db->query("INSERT INTO `section` (`id`, `name`, `url`, `status`) VALUES (23, 'User', '/admin/profile', 0);");
        $this->db->query("INSERT INTO `section` (`id`, `name`, `url`, `status`) VALUES (24, 'User', '/admin/profile/', 0);");

        $this->db->query("INSERT INTO `sectionpermission` (`section_id`, `permission_id`) VALUES (23, 72);");
        $this->db->query("INSERT INTO `sectionpermission` (`section_id`, `permission_id`) VALUES (24, 72);");

        // User edit
        $this->db->query("INSERT INTO `permission` (`id`, `name`) VALUES (73, 'EDIT_USER_PROFILE');");

        $this->db->query("INSERT INTO `section` (`id`, `name`, `url`, `status`) VALUES (25, 'User edit', '/admin/profile/edit', 0);");
        $this->db->query("INSERT INTO `section` (`id`, `name`, `url`, `status`) VALUES (26, 'User edit', '/admin/profile/edit/', 0);");

        $this->db->query("INSERT INTO `sectionpermission` (`section_id`, `permission_id`) VALUES (25, 73);");
        $this->db->query("INSERT INTO `sectionpermission` (`section_id`, `permission_id`) VALUES (26, 73);");
    }

    public function mig_down() {
        $this->db->query("DELETE FROM `section` WHERE `id`= 23;");
        $this->db->query("DELETE FROM `section` WHERE `id`= 24;");
        $this->db->query("DELETE FROM `section` WHERE `id`= 25;");
        $this->db->query("DELETE FROM `section` WHERE `id`= 26;");
    }
}