<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Iframe extends CI_Controller
{

    private $type;

    function __construct()
    {
        parent::__construct();
        $this->type = '';
    }

    function product_teaser($id)
    {
        // you can set an page id as $id or comma separated ids for teaser to use them
        // needed for calculator               
        if (empty($this->data['page']->productteaser) || empty($this->data['page']->productteaser_order)) {

            $id = urldecode($id);

            if (stripos($id, ',') !== false) {

                $this->data['page'] = new stdClass();

                $this->data['page']->productteaser_order = $id;

            } else {

                $this->load->model('page_m');

                $this->data['page'] = $this->page_m->get_by_id($id);

            }

            if (!empty($this->data['page']->productteaser_order)) {

                $this->load->model('product_teaser_m');

                $productteaser = $this->product_teaser_m->get_by_ids($this->data['page']->productteaser_order);

                $this->data['page']->productteaser = $productteaser;

            }

        }

        $this->type = 'iframe';
        $templates_folder = 'templates';
        $view = 'productteaser';

        $this->layout->setLayout('iframe');

        return $this->layout->view($this->type . '/' . $templates_folder . '/' . $view, $this->data);
    }

}