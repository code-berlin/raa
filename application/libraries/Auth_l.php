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
}