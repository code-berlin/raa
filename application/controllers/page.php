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

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('widget');
        $this->load->helper('widgets_container');
        $this->load->helper('published');
    }
}