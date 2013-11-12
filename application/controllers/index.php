<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct()
    {
        parent::__construct();
 
    }

 
    public function index()
    {

       $this->load->view('home/index');
    }
    
    public function load_menu($id_menu, $menu_template){
        
        $menu_items = R::find('menu_item', 'id_menu = ?', array($id_menu));
        if($menu_items){
 
            $data['items'] = $menu_items;
            $this->load->view('menu_templates/'.$menu_template, $data);
                    
        }
    }
  
}
