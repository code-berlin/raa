<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Auth extends CI_Controller
{

  function __construct()
    {
        parent::__construct();
        session_start();
    }


	public function login()
    {
 
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required');

        if ($this->form_validation->run())
        { 
            $this->load->model('admin_m');
            
            $user_name = $this->input->post('user_name');
            $password = $this->input->post('user_password');

            $result = $this->admin_m->verify_user($user_name, $password);

            if ($result !== false)
            {
                $_SESSION['user_name'] = $result->username; 
                redirect('admin/index');
            }
        }

        $this->load->view('admin/login');
    }

    public function logout()
    {
        unset($_SESSION['user_name']);
        redirect('auth');
    }

}