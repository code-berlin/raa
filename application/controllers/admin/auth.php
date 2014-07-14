<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function login() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $data = array();

        if ($this->form_validation->run()) {
            $this->load->model('admin_m');

            $user_name = $this->input->post('username');
            $password = $this->input->post('password');

            $result = $this->admin_m->verify_user($user_name, $password);
            $is_disabled = $this->admin_m->is_disabled($user_name);

            if ($result !== false) {
                if ($is_disabled == false) {
                    $user = array('user_name'=>$result->username);
                    $this->session->set_userdata($user);
                    redirect('admin/index');
                } else {
                    $data['disabled_message'] = "You don't have permission to access this page.";
                }
            } else {
                $data['wrong_credentials'] = "Incorrect login credentials. Try again.";
            }
        }

        $this->load->view('admin/login', $data);
    }

    public function logout() {
        $this->session->unset_userdata('user_name');
        redirect('auth');
    }

}