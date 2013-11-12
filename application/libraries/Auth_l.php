<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth_l {

    public function user_logged_in_with_redirect()
    {
        $ci =&get_instance();
    	if (!$ci->session->userdata('user_name'))
        {
            redirect('admin/auth/login');
        }
    }

    public function user_logged_in()
    {
        $ci =&get_instance();
    	if (!$ci->session->userdata('user_name'))
        {
            return false;
        }
        return true;
    }
}