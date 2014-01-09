<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_l {

    public function user_logged_in_with_redirect()
    {
        $ci =&get_instance();
        $username = $ci->session->userdata('user_name');
    	if (!$username)
        {
            redirect('admin/auth/login');
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
    public function check_user_is_allowed($role_id, $permissions_required) {
        $ci =&get_instance();
        $ci->load->model('permission_m');
        $ci->load->model('role_permission_m');

        $permissions = count($permissions_required);
        $valid_permissions = 0;

        foreach ($permissions_required as $permission_required) {
            $permission = $ci->permission_m->get_by_name($permission_required);

            if (!empty($permission)) {
                if ($ci->role_permission_m->get_by_role_and_permission($role_id, $permission->id)) {
                    $valid_permissions++;
                }
            }

            if ($valid_permissions > 0 && ($valid_permissions == $permissions)){
                return true;
            }
        }

        return false;
    }

}