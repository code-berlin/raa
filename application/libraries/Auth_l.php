<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_l {

    public function user_logged_in_with_redirect()
    {
        $ci =&get_instance();
        $username = $ci->session->userdata('user_name');
        if (!$username)
        {
            redirect('/auth');
        }
    }

    public function user_logged_in()
    {
        $ci =&get_instance();
        $username = $ci->session->userdata('user_name');
        if (!$username)
        {
            return false;
        }
        return true;
    }

    public function user_disabled()
    {
        $ci =&get_instance();
        $ci->load->model('admin_m');
        $username = $ci->session->userdata('user_name');

        $is_disabled = $ci->admin_m->is_disabled($username);

        if ($is_disabled == true)
        {
            return true;
        }

        return false;
    }

    public function retrieve_user_role()
    {
        $ci =&get_instance();
        $ci->load->model('user_m');
        $ci->load->model('role_m');
        $username = $ci->session->userdata('user_name');

        $user = $ci->user_m->get_by_username($username);

        if(isset($user) && !empty($user)) {
            $role = $ci->role_m->get_by_id($user->role_id);
        } else {
            return false;
        }

        if(isset($role) && !empty($role)) {
            return $role->title;
        } else return false;
    }

    /*
    * Check whether user has permission for required actions
    *
    * @param int $role_id user's role id
    * @param array $permission_required array with required permissions
    *
    * @return boolean
    */
    public function check_user_is_allowed($role_id, $permissions_required)
    {
        $ci =&get_instance();
        $ci->load->model('role_permission_m');

        $permissions = count($permissions_required);

        $valid_permissions = 0;

        foreach ($permissions_required as $permission_required) {
            if ($this->check_user_has_permission($role_id, $permission_required)) {
                $valid_permissions++;
            }

            if ($valid_permissions > 0 && ($valid_permissions == $permissions)){
                return true;
            }
        }

        return false;
    }

    /*
    * Retrieves credentials for given section
    *
    * @param string $section_url url of the section
    *
    * @return array of permissions
    */
    public function retrieve_section_credentials($section_url)
    {
        $ci =&get_instance();
        $ci->load->model('section_m');
        $ci->load->model('permission_m');
        $ci->load->model('section_permission_m');

        $section = $ci->section_m->get_by('url', $section_url);

        if (!empty($section)) {
            $permissions_required = $ci->section_permission_m->get_by_type($section->id);
            $permissions = array();

            foreach ($permissions_required as $permission_required) {
                $permission = $ci->permission_m->get_by_id($permission_required->permission_id);
                array_push($permissions, $permission->name);
            }

            return $permissions;
        }

        return array();
    }

    /*
    * Checks for required permissions to access a section
    *
    * @param string $role_id user's role id
    * @param string $section_url url of the section
    *
    * @return array of permissions
    */
    public function check_section_access_required_permissions($role_id, $section_url)
    {
        $section_required_credentials = $this->retrieve_section_credentials($section_url);

        if (!empty($section_required_credentials)) {
            if (!$this->check_user_is_allowed($role_id, $section_required_credentials)) {
                return false;
            }
        }

        return true;
    }

    /*
    */
    public function check_user_has_permission($role_id, $permission_required)
    {
        $ci =&get_instance();

        $ci->load->model('permission_m');
        $ci->load->model('role_permission_m');

        $permission = $ci->permission_m->get_by_name($permission_required);

        if (!empty($permission)) {
            if ($ci->role_permission_m->get_by_relationship($role_id, $permission->id)) {
                return true;
            }
        }

        return false;
    }

    public function create_super_admin()
    {
        $ci =&get_instance();

        $ci->load->model('permission_m');
        $ci->load->model('role_permission_m');

        $permissions = $ci->permission_m->get_all();

        if (!empty($permissions)) {
            $role_permission = $ci->role_permission_m;

            foreach ($permissions as $permission) {
                $id = $permission->id;

                if (!$role_permission->check_combination_exists(SUPERADMIN_ID, $id)) {
                    $role_permission->create_relationship(SUPERADMIN_ID, $id);
                }
            }
        }
    }
}