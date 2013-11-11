<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dispatcher extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
    }

    public function index($slug)
    {
        $this->load->model('url_m');

        // Retrieve object type related to this slug
        $result = $this->url_m->get_by_slug($slug);
        $type = $result->type->name;

        // Use this object type as reference for loading models and views
        $model_type = $type.'_m';
        $this->load->model($model_type);

        // It's important for each class to have this get_by_slug method
        $data[$type] = $this->$model_type->get_by_slug($slug);

        $this->load->view($type.'/index', $data);
    }
}
