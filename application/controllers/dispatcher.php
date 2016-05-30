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

    public function index($slug='', $subslug = '', $thirdslug = '') {

        $this->load->model('url_m');
        $this->load->model('page_m');

        $this->lang->load('std');

        $page = '';
        $result = '';
        $published = false;
        $view = '';
        $templates_folder = 'templates';
        $actual_slug = '';

        $this->data['language'] = $this->language;
        $this->data['theme'] = $this->config->item('theme');

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

        // get slug of actual page
        if (!empty($thirdslug)) {
            $actual_slug = $thirdslug;
        } elseif (!empty($subslug)) {
            $actual_slug = $subslug;
        } else {
            $actual_slug = $slug;
        }

        // Retrieve object type related to this slug
        $result = $this->url_m->get_by_slug($actual_slug);

        $published = check_if_published($result, $slug, $subslug, $thirdslug);

        $this->data['menu'] = load_menus();

        if(!empty($result) && $published) {
            $this->type = $result->type->name;

            if (!empty($this->type)) {
                $model_type = $this->type.'_m';

                $this->load->model($model_type);

                // It's important for each class to have this method
                // page data comes now as multi id bean, which only has one entry where index = id

                $bean_data = $this->$model_type->get_by_slug($actual_slug);

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
                        $teaser[$value['id']]['teaser_type'] = $value['name'];
                        $teaser[$value['id']]['jumpmark'] = $value['jumpmark'];

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
                $slug_method = $actual_slug;

                if (strpos($slug_method, '-') !== false) { // Is there a dash in the page's slug?
                    $slug_method = str_replace('-', '_', $slug_method);
                }

                if (method_exists($this, $slug_method)) { // Is there a method in page.php that extends the template?
                    $this->data['extra_data'] = $this->$slug_method();
                }

                // Get extra data for current page based on its template type
                // If $slug_method exists, it can be found in page.php controller

                $this->load->library('theme');

                $lib_data = array();

                $lib_data['slug'] = $slug;

                if (!empty($subslug)) {
                    $lib_data['slug'] = $lib_data['slug'] . '/' . $subslug;
                }

                if (!empty($thirdslug)) {
                    $lib_data['slug'] = $lib_data['slug'] . '/' . $thirdslug;
                }

                $lib_data['page_id'] = $this->data[$this->type]->id;
                $lib_data['template_method'] = $template_method;
                $this->data['lib_data'] = $this->theme->get_template_data($lib_data);

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
        $this->data['lib_data'] = $this->error_404();
        return $this->layout->view('page/'.$templates_folder.'/error_404', $this->data);

    }

    public function theme_method($method) {

        $args = func_num_args();
        $method_args = array();

        for ($i = 0; $i < $args; $i++) {
            if ($i == 0) continue;
            $method_args[] = $args[$i];
        }

        $this->load->library('theme');
        $this->theme->theme_method($method, $method_args);

    }
}
