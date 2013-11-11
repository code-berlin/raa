<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    /**
    *   Retrieves pages
    */
    public function index($id=0)
    {
        $this->load->model('page_m');

        $data['page'] = $this->page_m->get_by_id($id);

        if ($data['page']->id > 0) {
            $this->load->view('page/index', $data);
        } else {
            $this->load->view('errors/404.html');
        }
    }
}