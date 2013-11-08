<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    /**
    *   Retrieves pages
    */
    public function index($id=2)
    {
        $this->load->model('page_m');

        $data['page'] = $this->page_m->get_by_id($id);

        if (!empty($data['page'])) {
            $this->load->view('home/page', $data);
        } else {
            $this->load->view('errors/404.html');
        }
    }
}