<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dispatcher extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('widget');
        $this->load->helper('widgets_container');
        $this->load->helper('published');
    }

    public function index($slug='') {
        $this->load->model('url_m');

        // Retrieve homepage in case it exists.
        if (empty($slug)) {
            $this->load->model('settings_m');
            $this->load->model('page_m');

            $page = $this->page_m->get_by_id($this->settings_m->get_homepage());
            $slug = $page->slug;
        }

        echo '<pre>';
        var_dump($slug);
        echo '</pre>';

        // Retrieve object type related to this slug
        $result = $this->url_m->get_by_slug($slug);

        $published = check_if_published($result, $slug);

        echo '<pre>';
        var_dump($result);
        echo '</pre>';

        echo '<pre>';
        var_dump($published);
        echo '</pre>';

        if(!empty($result) && $published) {
            $type = $result->type->name;
            $model_type = $type.'_m';

            $this->load->model($model_type);

            // It's important for each class to have this method
            $data[$type] = $this->$model_type->get_by_slug($slug);
        } else {
            echo '<pre>';
            var_dump('not found');
            echo '</pre>';
            die;
            //show_404();
        }



        if (!empty($type)) {
            $view = (!empty($data[$type]->template)) ? $data[$type]->template->name : 'index';

            // setting the data type and the id for the layout
            $data['type'] = $type;
            $data['id'] = $result->id;

            $this->layout->view($type.'/'.$view, $data);
        }
    }
}
