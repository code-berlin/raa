<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        //$this->load->library('layout');
        $this->load->helper('widget');
        $this->load->helper('widgets_container');
    }

    /**
    *   Retrieves pages by id
    */
    public function index($id=0)
    {
        $this->load->model('page_m');

        $data['page'] = $this->page_m->get_by_id($id);
        $data['widgets'] = array('widget1', 'widget2');

        if (!empty($data['page']) && $data['page']->id > 0) {
            $view = (!empty($data['page']->template)) ? $data['page']->template->name : 'index';

            $this->load->view('page/'.$view, $data);
        } else {
            $this->load->view('errors/404.html');
        }
    }
}