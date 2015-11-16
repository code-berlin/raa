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

    	// get pages with type 1
    	$data['priority'] = '0.1';

    	$pages = $this->page_m->get_all();

    	var_dump($pages);exit;
        	
    	/*
    	$data['loc'] = 'https://www.docjones.de/impressum';
    	$output .= $this->load->view('sitemap/url_entry',$data, TRUE);
		$data['loc'] = 'https://www.docjones.de/agb';
    	$output .= $this->load->view('sitemap/url_entry',$data, TRUE);
    	$data['loc'] = 'https://www.docjones.de/datenschutz';
    	$output .= $this->load->view('sitemap/url_entry',$data, TRUE);
    	$data['loc'] = 'https://www.docjones.de/presse';
    	$output .= $this->load->view('sitemap/url_entry',$data, TRUE);
    	$data['loc'] = 'https://www.docjones.de/ueberuns';
    	$output .= $this->load->view('sitemap/url_entry',$data, TRUE);

*/
    	$data['priority'] = '0.8';

    	// get pages with type 1

    	$output .= $this->load->view('sitemap/sitemap_foot', '', TRUE);

    	$this->output
            ->set_content_type('text/xml') // This is the standard MIME type
            ->set_output($output); // set the output

    }

}