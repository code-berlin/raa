<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    /**
    *   Handles the page CRUD.
    */
    public function index($id=2)
    {
        //$this->load->model('page_m');

        //$data['page'] = $this->page_m->get_by_id($id);
        echo 'hola';
        die;
        /*if (!empty($data['page'])) {
            echo 'hola';
            $this->load->view('home/page', $data);
        } else {
            $this->load->view('errors/404.html');
        }*/
    }
}
