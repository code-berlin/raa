<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('published');
    }

    public function index()
    {
        $this->layout->view('/templates/homepage_template');
    }

}

