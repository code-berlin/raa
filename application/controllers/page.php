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


    function with_sidebar($page_id) {

        $data = array();

        $this->load->model('page_m');

        $page = $this->page_m->get_by_id($page_id);

        $data['social']['title'] = $page->menu_title;
        $data['social']['description'] = $page->teaser_text;
        $data['social']['image'] = $page->image;


        $data['contentSiblings'] = $this->page_m->get_siblings($page_id);

        $data['articles'] = $this->page_m->get_articles_by_page_id_and_menu_id($page_id, 1);

        $data['articlePagination'] = get_article_pagination($data['articles'], $page_id);

        return $data;

    }


    function list_page($page_id) {

        $data = array();

        $this->load->model('page_m');

        $page = $this->page_m->get_by_id($page_id);

        $data['social']['title'] = $page->menu_title;
        $data['social']['description'] = $page->teaser_text;
        $data['social']['image'] = $page->image;

        $data['teaserItems'] = $this->page_m->get_children($page_id);

        $data['teaserColumns'] = 3;

        return $data;

    }

    function error_404() {

        $data = array();

        $this->load->model('page_m');
        $data['teaserItems'] = $this->page_m->get_random_subpages(6);
        $data['teaserColumns'] = 3;

        return $data;
    }

}