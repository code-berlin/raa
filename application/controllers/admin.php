<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        
        if (!isset($_SESSION['user_name']))
        {
            redirect('admin/login');
        }

        $this->load->view('admin/admin');
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required');

        if ($this->form_validation->run() !== false)
        {
            $this->load->model('admin_m');
            $result = $this
                ->admin_m
                ->verify_user(
                    $this
                    ->input
                    ->post('user_name'),
                    $this
                    ->input
                    ->post('user_password')
                    );

            if ($result !== false)
            {
                $_SESSION['user_name'] = $result->username; 
                redirect('admin');
            }
        }

        $this->load->view('admin/login');
    }

    public function logout()
    {
        unset($_SESSION['user_name']);
        redirect('admin/login');
    }

    /**
    *   Handles the page CRUD.
    */
    public function page()
    {

        if (!isset($_SESSION['user_name']))
        {
            redirect('admin/login');
        }

        $crud = $this->grocery_crud;

        $crud->set_table('page');
        $crud->set_relation('id_template','template','name');
        $crud->display_as('id_template','Template');

        $crud->set_field_upload('image','assets/uploads/files');

        $this->load->view('admin/admin', $crud->render());
    }
}
