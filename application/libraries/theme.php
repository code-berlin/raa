<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Theme {

	function __construct() {
    }

    function get_template_data($data = '') {
    	$CI =& get_instance();
		if ($CI->config->item('theme') != false && file_exists(FCPATH . APPPATH . 'libraries/themes/' . $CI->config->item('theme') . EXT)) {
			$CI->load->library('themes/' . $CI->config->item('theme'), $data, 'theme_lib');
			return $CI->theme_lib->get_template_data($data);
		}

		return false;
    }

}