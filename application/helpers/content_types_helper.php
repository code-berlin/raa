<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function content_types_get_list($content_type_name) {
		$CI =& get_instance();
		$model_name = $content_type_name.'_m';
		$CI->load->model($model_name);
		$list_elements = $CI->$model_name->get_all();

		if(!empty($list_elements) && is_array($list_elements)){

			foreach($list_elements as $list_element){
				
				$data['object'] = $list_element;
				$CI->load->view('content_types/'.$content_type_name.'_list_item', $data);
			}
		} else return;

	}

	function content_types_get_item($content_type_name, $id = 0) {
		$CI =& get_instance();
		// TODO
	}



?>