<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function item($id_menu)
    {

        $crud = $this->grocery_crud;

        $crud->where('id_menu', $id_menu);
        $crud->set_table('menu_item');

        $crud->set_relation('id_menu','menu','name');
        $crud->set_relation('url_id','url','slug');

        $crud->display_as('id_menu','Menu');
        $crud->display_as('url_id','Slug');

        $this->load->view('admin/admin', $crud->render());
    }

}
