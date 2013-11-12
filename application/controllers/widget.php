<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widget extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    /**
    *   Retrieves widgets
    */
    public function index($id=0)
    {
        $this->load->model('widget_m');
    }
}