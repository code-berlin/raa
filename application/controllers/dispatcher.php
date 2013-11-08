<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dispatcher extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
    }

    /**
    *
    */
    public function index()
    {
        $this->load->model('url_m');

        //$_SERVER['REQUEST_URI'];

        $result = $this->url_m->get_by_slug($_SERVER['REQUEST_URI']);

        echo '<pre>';
        var_dump($result);
        echo '</pre>';

        //redirect('/home/index/'.$_SERVER['REQUEST_URI']);
        die;
    }
}
