<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth_l {

    public function user_logged_in_with_redirect()
    {
    	if (!isset($_SESSION['user_name']))
        {
            redirect('admin/auth/login');
        }
    }

    public function user_logged_in()
    {
    	if (!isset($_SESSION['user_name']))
        {
            return false;
        }
        return true;
    }
}