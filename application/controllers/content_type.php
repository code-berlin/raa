<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_type extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        //$this->load->library('layout');
        $this->load->helper('widget');
        $this->load->helper('widgets_container');
    }

    /**
    *   Retrieves products by id
    */
    public function index($id=0, $content_type_name)
    {
        $this->load->model($content_type_name.'_m');

        $item = $this->{$content_type_name.'_m'}->get_by_id($id);

        if($item->id > 0 && $item->slug!='') { 
            redirect(base_url($item->slug), 'location', 301);
        } else {
            $data[$content_type_name] = $item;
        }

        if (!empty($data[$content_type_name]) && $data[$content_type_name]->id > 0) {
            $view = (!empty($data[$content_type_name]->template)) ? $data[$content_type_name]->template->name : 'index';

            $this->load->view($content_type_name.'/'.$view, $data);
        } else {
            $this->load->view('errors/404.html');
        }
    }
}