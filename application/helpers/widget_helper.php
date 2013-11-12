<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function load_widget($name) {
		$CI =& get_instance();
		$CI->load->model('widget_m');

		$widget = $CI->widget_m->get_by_name($name);

		// When widget exists in the database, include it
		if ($widget != NULL && $widget->activated == 1) {
			$path = 'application/widgets/'.$name.'/index.php';

			if (file_exists($path)) {
				include $path;
			}
		}
	}

?>