<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    function __construct() {
    	parent::__construct();
    }

    function index() {

    	$this->load->model('page_m');

    	$output = '';

    	$output .= $this->load->view('sitemap/sitemap_head', '', TRUE);

    	$data['loc'] = base_url('/');
        $data['priority'] = '1';
    	$output .= $this->load->view('sitemap/url_entry',$data, TRUE);
 	
    	$pages = $this->page_m->get_all();

    	foreach ($pages as $key => $value) {
            
            if ($value['slug'] == 'home' || $value['slug'] == 'datenschutz') continue;

            if (!empty($value['parent_id'])) {
                $data['loc'] = base_url($value['parent_slug'] . '/' . $value['slug']);
            } else {
                $data['loc'] = base_url($value['slug']);
            }
            $data['priority'] = $value['sitemap_prio'];

            $output .= $this->load->view('sitemap/url_entry',$data, TRUE);

        }


    	$output .= $this->load->view('sitemap/sitemap_foot', '', TRUE);

    	$this->output
            ->set_content_type('text/xml') // This is the standard MIME type
            ->set_output($output); // set the output

    }

}