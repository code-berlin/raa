<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
    }

    public function page()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('page');
        $crud->set_relation('id_template','template','name');
        $crud->display_as('id_template','Template');

        $crud->set_field_upload('image','assets/uploads/files');

        $this->load->view('page', $crud->render());
    }
}
