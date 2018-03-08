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
        $this->load->helper('content');

        $this->lang->load('std');

        $page = '';
        $result = '';
        $published = false;
        $view = '';
        $templates_folder = 'templates';

        if ($slug == 'home') $slug = '';

        $this->data['language'] = $this->language;
        $this->data['theme'] = $this->config->item('theme');
        $this->data['canonical_url'] = base_url($slug . ($subslug !== '' ? '/' . $subslug : ''));
        // get image placeholders (from theme if exists or raa)
        $this->data['img_placeholder'] = get_image_placeholder($this->data['theme']);
        $this->data['img_placeholder_slideshow'] = get_image_placeholder_for_slideshow($this->data['theme']);
        
        // Retrieve homepage in case it exists.
        if (empty($slug)) {
            $this->load->model('settings_m');

            $page = $this->page_m->get_by_id($this->settings_m->get_homepage());

            if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] != $this->data['canonical_url']) {
                if ($_GET['debug'] == 1) {
                    var_dump((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] != $this->data['canonical_url']);
                    exit;
                }
                redirect($this->data['canonical_url']);
            }

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

                $this->data['date'] = date("d.m.Y H:i:s", strtotime($this->data[$this->type]->date));

                $this->load->model('teaser_m');

                $teaser_instances = $this->teaser_m->get_teaser_instance_by_page_id($this->data[$this->type]->id);

                $teaser = array();
                $relatedArticles = array();

                if (!empty($teaser_instances)) {

                    foreach ($teaser_instances as $key => $value) {

                        // extract related articles in extra variable (special feature for article pages)
                        if ($value['name'] === 'relatedArticles') {
                            $relatedArticles['title'] = $value['title'];
                            $relatedArticles['text'] = $value['text'];
                            $relatedArticles['items'] = $this->teaser_m->get_teaser_items_by_teaser_instance_id($value['id']);
                            continue;
                        }

                        $teaser[$value['id']]['title'] = $value['title'];
                        $teaser[$value['id']]['text'] = $value['text'];
                        $teaser[$value['id']]['teaser_type'] = $value['name'];
                        $teaser[$value['id']]['is_column'] = $value['is_column'];
                        $teaser[$value['id']]['jumpmark'] = $value['jumpmark'];
                        $teaser[$value['id']]['items'] = $this->teaser_m->get_teaser_items_by_teaser_instance_id($value['id']);

                        // if teasertype is external_link_page then shuffle order
                        if ($value['name'] === 'external_link_page')  {
                            shuffle($teaser[$value['id']]['items']);
                        }

                        if ($value['name'] === 'ordered_list')  {
                            $teaser[$value['id']]['items'] = teaser_items_ordered_list($teaser[$value['id']]['items']);
                        }

                    }

                }

                $this->data['teaser'] = $teaser;
                $this->data['relatedArticles'] = $relatedArticles;

                $this->data['page']['productteaser'] = '';

                if (!empty($this->data['page']['productteaser_order'])) {

                    $this->load->model('product_teaser_m');

                    $productteaser = $this->product_teaser_m->get_by_ids($this->data['page']['productteaser_order']);

                    $this->data['page']['productteaser'] = $productteaser;

                }                

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

                $lib_data = array();

                $lib_data['slug'] = $slug;

                if (!empty($subslug)) {
                    $lib_data['slug'] = $lib_data['slug'] . '/' . $subslug;
                }

                // Retrieve breadcrumbs if user isnt on homepage
                if ($slug != 'home') {
                    $this->data['breadcrumbs'] = get_breadcrumbs($this->data[$this->type], $this->config->item('name'));
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
