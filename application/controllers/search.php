<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller used for the migration of the database to different versions
 */
class Search extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

    function gsearch() {
    	
    	$data['seo_meta_description'] = '';
    	$data['seo_meta_keywords'] = '';
    	$data['seo_footer_text'] = '';
    	
    	$data['type'] = 'search';

    	$data['template_content'] = $this->load->view('search/gsearch', '', true);

    	$this->load->view('layouts/default', $data);
    }

}