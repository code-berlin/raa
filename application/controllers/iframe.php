<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iframe extends CI_Controller {

    private $type;

    function __construct()
    {
        parent::__construct();
        $this->type = '';
    }

    function product_teaser($page_id) {

        $this->load->model('page_m');


        $this->data['page'] = $this->page_m->get_by_id($page_id);

        $this->type = 'iframe';
        $templates_folder = 'templates';
        $view = 'productteaser';

        $this->data['page']['productteaser'] = '';

        if (!empty($this->data['page']['productteaser_order'])) {

            $this->load->model('product_teaser_m');

            $productteaser = $this->product_teaser_m->get_by_ids($this->data['page']['productteaser_order']);

            $this->data['page']['productteaser'] = $productteaser;

        }

        $this->layout->setLayout('iframe');

        return $this->layout->view($this->type.'/'.$templates_folder.'/'.$view, $this->data);
    }

}