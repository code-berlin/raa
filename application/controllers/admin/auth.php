<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Auth extends CI_Controller
{

  function __construct()
    {
        parent::__construct();
    }


	public function login()
    {
 
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required');

        $data = [];

        if ($this->form_validation->run())
        {
            $this->load->model('admin_m');
            
            $user_name = $this->input->post('user_name');
            $password = $this->input->post('user_password');

            $result = $this->admin_m->verify_user($user_name, $password);
            $is_disabled = $this->admin_m->is_disabled($user_name);

            
                if ($result !== false)
                {
                    if ($is_disabled == false)
                    {
                        $user = array('user_name'=>$result->username);
                        $this->session->set_userdata($user);
                        redirect('admin/index');
                    }
                    else {
                        $data['disabled_message'] = "You don't have permission to access this page.";
                    }
                }
        }

        $this->load->view('admin/login', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('user_name');
        redirect('auth');
    }

}