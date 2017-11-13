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
        $data['seo_meta_title'] = '';

    	$data['type'] = 'search';

        $data['menu'] = $subdata['menu'] = load_menus();

        $data['template_method'] = 'search';

        $this->load->library('theme');

        $lib_data = array();
        $lib_data['page_id'] = '';
        $lib_data['template_method'] = 'search';
        $lib_data['slug'] = 'gsearch';

        $subdata['lib_data'] = $this->theme->get_template_data($lib_data);
        $subdata['searchterm'] = urldecode($_REQUEST['gs']);
        $subdata['theme'] = $this->config->item('theme');
		$subdata['img_placeholder'] = get_image_placeholder($subdata['theme']);
        $subdata['img_placeholder_slideshow'] = get_image_placeholder_for_slideshow($subdata['theme']);

        $data['canonical_url'] = base_url('gsearch');

    	$data['template_content'] = $this->load->view('search/gsearch', $subdata, true);

    	$this->load->view('layouts/default', $data);
    }

}
