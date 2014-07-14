<?php
class User_m extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->model('dao/user_dao');
    }

    public function get_by_username($email) {
        return $this->user_dao->get_by_username($email);
    }

    public function get_amount_of_users() {
        return $this->user_dao->get_counted();
    }

    public function get_amount_of_users_except_superadmin() {
        return $this->user_dao->get_counted_except('role_id', 1);
    }

    public function can_add_more_users() {
        $this->load->model('main_config_m');

        $users_permitted = $this->main_config_m->get_amount_of_users_permitted();
        $amount_of_users = $this->get_amount_of_users_except_superadmin();

        return $amount_of_users < $users_permitted;
    }

    public function get_all_allowed_to_post($system_facebook_app_id = 0) {
        return $this->user_dao->get_all_allowed_to_post($system_facebook_app_id);
    }

    public function get_all_users_except_superadmin_and_myself($my_id) {
        $users = $this->user_dao->get_all_except_superadmin_and_myself($my_id);

        return $this->order_results($users);
    }

    public function get_all_users_with_same_app_except_superadmin_and_myself($my_id, $my_facebook_app_id, $my_twitter_app_id = 0) {
        $users = $this->user_dao->get_all_users_with_same_app_except_superadmin_and_myself($my_id, $my_facebook_app_id, $my_twitter_app_id);

        return $this->order_results($users);
    }
    /**
    * Creates an array of elements based on id and name/surname.
    *
    * @param $result object or array with retrieved information from the database
    */
    public function order_results ($users) {
        $ordered = array();

        foreach($users as $user) {
            $ordered[$user->id] = $user->name.' '.$user->surname;
        }

        return $ordered;
    }

    public function check_email_is_unique($my_id, $email) {
        return $this->user_dao->check_email_is_unique($my_id, $email);
    }

    public function get_by_id($id) {
        return $this->user_dao->get_by_id($id);
    }

    public function save($user) {
        return $this->user_dao->save($user);
    }

    public function create() {
        return $this->user_dao->create();
    }

    public function remove($user) {
        return $this->user_dao->remove($user);
    }

    /**
     * checks if the currently logged user has a permission specified by name
     * @param $permission_name name of the permission, e.g. VIEW_INBOX
     * @return bool true if the user has the permission, false otherwise
     */
    public function has_permission($permission_name){
        $CI = & get_instance();
        $CI->load->model('permission_m');
        $CI->load->model('role_m');
        $CI->load->library('session');

        $permission = $this->permission_m->get_by_name($permission_name);

        if (!isset($permission) || empty($permission)){
            return false;
        }

        $email = $this->session->userdata('email');
        $user = $this->get_by_username($email);

        $role_permissions = $this->role_m->get_permissions($user->role_id, true);
        return in_array($permission->id, $role_permissions);
    }

    public function is_superadmin(){
        $CI = & get_instance();
        $CI->load->library('session');
        $email = $this->session->userdata('email');
        $user = $this->get_by_username($email);

        return ($user->role_id == SUPERADMIN_ID);
    }

    public function is_admin(){
        $CI = & get_instance();
        $CI->load->library('session');
        $email = $this->session->userdata('email');
        $user = $this->get_by_username($email);

        return ($user->role_id == ADMIN_ID);
    }
}