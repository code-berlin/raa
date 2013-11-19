<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->layout->view('/templates/homepage_template');
    }

    public function load_menu($id_menu, $menu_template){
        $this->load->model('menu_item_m');

        $menu_items = $this->menu_item_m->get_by_menu_id($id_menu);

        if($menu_items){
            $data['items'] = $menu_items;

            $this->load->view('menu_templates/'.$menu_template, $data);
        }
    }

}
