<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require('page.php');

class Dispatcher extends Page {
    private $data;
    private $type;
    private $language;

    public function __construct() {
        parent::__construct();

        $this->data = array();
        $this->type = '';
        $this->language = $this->tools->get_language_value();
    }

    public function index($slug='') {
        $this->load->model('url_m');

        $page = '';
        $result = '';
        $published = false;
        $view = '';
        $templates_folder = 'templates';

        $this->data['language'] = $this->language;

        // Retrieve homepage in case it exists.
        if (empty($slug)) {
            $this->load->model('settings_m');
            $this->load->model('page_m');

            $page = $this->page_m->get_by_id($this->settings_m->get_homepage());
            
            // If $page is false, it means there's no homepage set yet
            if (!$page) {
                $this->tools->show_error_page();
                die;
            }

            $slug = $page->slug;
        }

        // Retrieve object type related to this slug
        $result = $this->url_m->get_by_slug($slug);

        $published = check_if_published($result, $slug);

        if(!empty($result) && $published) {
            $this->type = $result->type->name;

            if (!empty($this->type)) {
                $model_type = $this->type.'_m';

                $this->load->model($model_type);

                // It's important for each class to have this method
                $this->data[$this->type] = $this->$model_type->get_by_slug($slug);

                // setting the data type and the id for the layout
                $this->data['type'] = $this->type;
                $this->data['id'] = $result->id;
                $this->data['section_name'] =  $this->data[$this->type]->slug;
                
                // Get extra data for current page based on its slug
                // If $page_method exists, it can be found in page.php controller
                $page_method = $slug;

                if (strpos($page_method, '-') !== false) { // Is there a dash in the page's slug?
                    $page_method = str_replace('-', '_', $page_method);
                }
                
                if (method_exists($this, $page_method)) { // Is there a method in page.php that extends the template?
                    $this->data['extra_data'] = $this->$page_method();
                }

                // Set the template name or throw error
                if (!empty($this->data[$this->type]->template)) {
                    $view = $this->data[$this->type]->template->name;
                } else {
                    return $this->tools->show_not_implemented_page();
                }

                return $this->layout->view($this->type.'/'.$templates_folder.'/'.$view, $this->data);
            }
        }

        $this->tools->show_error_page();
    }
}
