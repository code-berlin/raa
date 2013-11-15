<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dispatcher extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('widget');
        $this->load->helper('widgets_container');
    }

    public function index($slug)
    {
        $this->load->model('url_m');

        $type = '';

        // Retrieve object type related to this slug
        $result = $this->url_m->get_by_slug($slug);

        if(!empty($result)) {
            $type = $result->type->name;
            $model_type = $type.'_m';

            $this->load->model($model_type);

            // It's important for each class to have this method
            $data[$type] = $this->$model_type->get_by_slug($slug);
        }

        if (!empty($type)) {
            $view = (!empty($data[$type]->template)) ? $data[$type]->template->name : 'index';

            $this->load->view($type.'/'.$view, $data);
        } else {
            $this->load->view('errors/404.html');
        }
    }
}
