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

    public function index($slug='', $subslug = '') {

        $this->load->model('url_m');
        $this->load->model('page_m');        
        $this->load->helper('ads');

        $page = '';
        $result = '';
        $published = false;
        $view = '';
        $templates_folder = 'templates';

        $this->data['language'] = $this->language;

        // Retrieve homepage in case it exists.
        if (empty($slug)) {
            $this->load->model('settings_m');

            $page = $this->page_m->get_by_id($this->settings_m->get_homepage());

            // If $page is false, it means there's no homepage set yet
            if (!$page) {
                $this->tools->show_error_page();
                die;
            }

            $slug = $page->slug;
        }

        // Retrieve object type related to this slug
        if (!empty($subslug)) {
            $result = $this->url_m->get_by_slug($subslug);
        } else {
            $result = $this->url_m->get_by_slug($slug);
        }

        $published = check_if_published($result, $slug, $subslug);

        $this->data['menu'] = load_menus();

        if(!empty($result) && $published) {
            $this->type = $result->type->name;

            if (!empty($this->type)) {
                $model_type = $this->type.'_m';

                $this->load->model($model_type);

                // It's important for each class to have this method
                // page data comes now as multi id bean, which only has one entry where index = id
                if (!empty($subslug)) {
                    $bean_data = $this->$model_type->get_by_slug($subslug);
                } else {
                    $bean_data = $this->$model_type->get_by_slug($slug);
                }
                $this->data[$this->type] = $bean_data[key($bean_data)];                

                // setting the data type and the id for the layout
                $this->data['type'] = $this->type;

                $this->data['id'] = $this->data[$this->type]->id;
                $this->data['section_name'] =  $this->data[$this->type]->slug;

                $this->load->model('teaser_m');
                $teaser_instances = $this->teaser_m->get_teaser_instance_by_page_id($this->data[$this->type]->id);

                $teaser = array();

                if (!empty($teaser_instances)) {

                    foreach ($teaser_instances as $key => $value) {
                        $teaser[$value['id']]['title'] = $value['title'];
                        $teaser[$value['id']]['text'] = $value['text'];
                        $teaser[$value['id']]['type'] = $value['name'];

                        $teaser[$value['id']]['items'] = $this->teaser_m->get_teaser_items_by_teaser_instance_id($value['id']);

                    }

                }

                $this->data['teaser'] = $teaser;

                 // Get extra data for current page based on its slug
                // If $template_method exists, it can be found in page.php controller
                $template_method = $this->data[$this->type]->template->name;
                $this->data['template_method'] = $template_method;

                if (strpos($template_method, '-') !== false) { // Is there a dash in the page's slug?
                    $template_method = str_replace('-', '_', $template_method);
                }

                if (method_exists($this, $template_method)) { // Is there a method in page.php that extends the template?
                    $this->data['template_data'] = $this->$template_method($this->data[$this->type]->id);
                }

                // Get extra data for current page based on its template type
                // If $slug_method exists, it can be found in page.php controller
                $slug_method = $slug;

                if (strpos($slug_method, '-') !== false) { // Is there a dash in the page's slug?
                    $slug_method = str_replace('-', '_', $slug_method);
                }

                if (method_exists($this, $slug_method)) { // Is there a method in page.php that extends the template?
                    $this->data['extra_data'] = $this->$slug_method();
                }

                // Get extra data for current page based on its template type
                // If $slug_method exists, it can be found in page.php controller

                $this->load->library('theme');

                $this->data['lib_data'] = $this->theme->get_template_data();

                // Set the template name or throw error
                if (!empty($this->data[$this->type]->template)) {
                    $view = $this->data[$this->type]->template->name;
                } else {
                    return $this->tools->show_not_implemented_page();
                }

                return $this->layout->view($this->type.'/'.$templates_folder.'/'.$view, $this->data);
            }
        }

        // show error page
        header('HTTP/1.0 404 Not Found');
        $this->data['template_method'] = 'error_404';
        $this->data['template_data'] = $this->error_404();
        return $this->layout->view('page/'.$templates_folder.'/error_404', $this->data);

    }
}
