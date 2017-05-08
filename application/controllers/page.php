<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* HOW-TO
*
* To add additional information (that don't come from the database) to a template,
* create a function named exaclty like the slug of the page you want to extend
* and return an array of data. For example, if you have a homepage with slug "home",
* do something like this:
*
*   protected function home() {
        $data['info'] = "Value";
        $data['other_info'] = "Other value";
        return $data;
    }
*
* The data will be available in the template as $extra_data
*
* IMPORTANT: If a page slug has dash (-) in it, the respective function should use underscore (_).
* For example, if there's a page with slug 'my-profile', its function name would be 'my_profile()'
*
*/

class Page extends CI_Controller {

    protected $facebook_user;

    function __construct() {
        parent::__construct();

        // Helpers
        $this->load->helper('url');
        $this->load->helper('widget');
        $this->load->helper('widgets_container');
        $this->load->helper('published');
        $this->load->helper('facebook');
        $this->load->helper('content');

        // Libraries
        $this->load->library('facebook');

        // Models
        $this->load->model('facebook_user_m');

        // Functions
        //$this->set_facebook_user_state();
    }

    /******************************************
    *
    *               EXTRA DATA FOR PAGES
    *
    *******************************************/

    // protected function home() {
    //     $data['info'] = "Value";
    //     $data['other_info'] = "Other value";
    //     return $data;
    // }

    /******************************************
    *
    *               HELPER FUNCTIONS
    *
    *******************************************/

    // Checks if Facebook user exists, and sets (or unsets) session userdata
    protected function set_facebook_user_state() {

        $this->facebook_user = $this->facebook->get_user();

        if ($this->facebook_user) {
            // User exists, let's add him or her to the session if needed
            if (!$this->session->userdata('facebook_user')) {
                $this->session->set_userdata('facebook_user', $this->facebook_user);
            }
            // Create new Facebook user if needed
            $this->create_new_facebook_user($this->facebook_user);
        } else {
            // No user, no fun. Kill session userdata
            // and redirect to homepage (for authorization)
            $this->session->unset_userdata('facebook_user');
            if (uri_string()) {
                redirect('/');
            }
        }
    }

    /*
    * Creates a new Facebook user in the database if needed
    * @param $fb_user {Array} array got from facebook API call for a user
    * @return {int} Database ID of the created user
    */
    private function create_new_facebook_user($fb_user) {

        $user_exists = $this->facebook_user_m->get_by('facebook_id', $fb_user['id']);

        if ($user_exists) {
            // User is already in the database, stop the script
            return;
        }

        $new_user = array(
            'first_name' => $fb_user['first_name'],
            'last_name' => $fb_user['last_name'],
            'facebook_id' => $fb_user['id'],
            'email' => $fb_user['email']
        );

        $this->facebook_user_m->create();
        $this->facebook_user_m->set($new_user);

        return $this->facebook_user_m->save();
    }

    function homepage($page_id) {

        $data =  array();

        return $data;

    }


    function article_page($page_id) {

        $data = array();

        $this->load->model('page_m');

        $page = $this->page_m->get_by_id($page_id);

        $data['social']['title'] = (!empty($page->seo_meta_title) ? $page->seo_meta_title : $page->headline);
        $data['social']['description'] = (!empty($page->seo_meta_description) ? $page->seo_meta_description : $page->teaser_text);
        $data['social']['image'] = $page->image;

        return $data;

    }


    function list_page($page_id) {

        $data = array();

        $this->load->model('page_m');

        $page = $this->page_m->get_by_id($page_id);

        $data['social']['title'] = (!empty($page->seo_meta_title) ? $page->seo_meta_title : $page->headline);
        $data['social']['description'] = (!empty($page->seo_meta_description) ? $page->seo_meta_description : $page->teaser_text);
        $data['social']['image'] = $page->image;

        return $data;

    }

    function price_comparison($page_id) {

        $data = array();

        $this->load->model('page_m');

        $page = $this->page_m->get_by_id($page_id);

        $pzn_str = $page->ad_keywords;

        $pzns = array();

        if (!empty($pzn_str)) $pzns = explode(',', $pzn_str);

        if (count($pzns) > 0) {
            $this->load->helper('price_comparison_api_helper');
            foreach ($pzns as $key => $value) {
                  $res = get_drug_info($value);
                  if (!empty($res)) $data[$value] = $res;
            }
        }


        return $data;

    }

    function editorial($page_id) {

        $data = array();

        $this->load->model('page_m');
        $this->load->model('author_m');

        $page = $this->page_m->get_by_id($page_id);

        $data['social']['title'] = (!empty($page->seo_meta_title) ? $page->seo_meta_title : $page->headline);
        $data['social']['description'] = (!empty($page->seo_meta_description) ? $page->seo_meta_description : $page->teaser_text);
        $data['social']['image'] = $page->image;

        $data['authors'] = $this->author_m->get_all();

        return $data;

    }

    function error_404() {

        $data = array();

        $this->load->model('page_m');
        $data['teaserItems'] = $this->page_m->get_random_subpages(6);
        $data['teaserColumns'] = 3;

        return $data;
    }

    function google_map($page_id) {

        $data = array();

        $data['api_key'] = $this->config->item('google_maps_api_key');

        if (isset($_REQUEST['gms'])) {
            $data['gm_searchterm'] = $_REQUEST['gms'];
            $data['iframe_src'] = 'https://www.google.com/maps/embed/v1/search?key='. $data['api_key'] . '&q=' . urlencode('Apotheken near' . $data['gm_searchterm']);
        }

        return $data;

    }


}