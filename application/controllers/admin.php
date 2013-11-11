<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->database();

        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $this->load->view('admin/admin');
    }

    /**
    *   Handles the page CRUD.
    */
    public function page()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('page');
        $crud->set_relation('id_template','template','name');
        $crud->display_as('id_template','Template');

        $crud->set_field_upload('image','assets/uploads/files');

        // Fields sanitation
        $crud->callback_before_insert(array($this, 'check_fields'));
        $crud->callback_before_update(array($this, 'check_fields'));

        $this->load->view('admin/admin', $crud->render());
    }

    public function check_fields($post) {
        $this->load->model('url_m');

        $post['slug'] = $this->url_m->sluggify($post['slug']);

        $this->url_m->save_slug('page', $post['slug']);

        return $post;
    }
}
