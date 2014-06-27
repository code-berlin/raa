<?php
class Role_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('dao/role_dao');
        $this->load->model('role_permission_m');
        $this->load->model('permission_m');
    }

    public function create() {
        return $this->role_dao->create();
    }

    public function get_by_id($id) {
        return $this->role_dao->get_by('id', $id);
    }

    /**
    * Gets the permissions of the role from the role_permission table
    *
    * @param $id id of the role
    * @param $array if it's set to true, just the permissions will be returned
    */
    public function get_permissions($id, $array = false) {
        $role_permission = $this->role_permission_m->get_permissions($id);

        if ($array) {
            $ordered = array();

            foreach ($role_permission as $element) {
                array_push($ordered, $element->permission_id);
            }

            $role_permission = $ordered;
        }

        return $role_permission;
    }

    public function get_admin_and_superadmin_role_id() {
        return $this->get_admin_and_superadmin_role_id();
    }

    /**
    * Checks if a role has a poster role.
    *
    * @param $role_id
    * @return boolean
    */
    public function can_post($role_id) {
        $can_post_permission = $this->permission_m->get_by_name('CAN_POST');
        $role_permissions = $this->get_permissions($role_id, true);

        return in_array($can_post_permission->id, $role_permissions);
    }

    public function can_edit_profile ($role_id = 0) {
        $edit_profile_permission = $this->permission_m->get_by('name', 'EDIT_USER_PROFILE');
        $role_permissions = $this->get_permissions($role_id, true);

        return in_array($edit_profile_permission->id, $role_permissions);
    }

    public function get_all_roles_that_can_post() {
        $can_post_permission = $this->permission_m->get_by_name('CAN_POST');
        $roles_that_can_post = $this->role_permission_m->get_all_by('permission_id', $can_post_permission->id);

        $ordered = array();

        foreach ($roles_that_can_post as $element) {
            // Remove superadmin from the list.
            $casted_role_id = (int) $element->role_id;

            if ($casted_role_id !== 1) {
                array_push($ordered, $casted_role_id);
            }
        }

        return $ordered;
    }

    public function save($object) {
        return $this->role_dao->save($object);
    }

    public function remove($object) {
        return $this->role_dao->remove($object);
    }
}