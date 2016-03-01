<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Theme {

	function __construct() {
    }

    function get_template_data($data) {
    	$CI =& get_instance();

		if ($CI->config->item('theme') != false && file_exists(FCPATH . APPPATH . 'libraries/themes/' . $CI->config->item('theme') . '/' . $CI->config->item('theme') . EXT)) {
			$CI->load->library('themes/' . $CI->config->item('theme') . '/' . $CI->config->item('theme'), '', 'theme_lib');
			return $CI->theme_lib->get_template_data($data);
		}

		return false;
    }

    function theme_method($method, $method_arr) {
        $CI =& get_instance();

		if ($CI->config->item('theme') != false && file_exists(FCPATH . APPPATH . 'libraries/themes/' . $CI->config->item('theme') . '/' . $CI->config->item('theme') . EXT)) {
			$CI->load->library('themes/' . $CI->config->item('theme') . '/' . $CI->config->item('theme'), '', 'theme_lib');
			if (method_exists($CI->theme_lib, $method)) {
				try {
					$CI->theme_lib->$method($method_arr);
				} catch(Exception $e) {
					echo "Something went wrong: " + $e->getMessage();
				}
			} else {
				echo "Method does not exist";
			}


		}

	}

}