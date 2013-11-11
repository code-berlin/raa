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
        $crud->display_as('id_menu','Menu');
        
        //$crud->set_field_upload('image','assets/uploads/files');
        
        $this->load->view('admin/admin', $crud->render());    
    }

     
    
}
