<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
    }

    /**
    *   Handles the page CRUD.
    */
    public function index($id)
    {
        $this->load->model('page_m');
        $this->page_m->get_by_id($id);
    }
}
