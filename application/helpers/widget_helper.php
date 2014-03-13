<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function load_widget($name, $id=0) {
		$ci =& get_instance();
		$ci->load->model('widget_m');
		$ci->load->library('widgets');

		$widget = $ci->widget_m->get_by_name($name);

		// When widget exists in the database, include it
		if ($widget != NULL && $widget->activated == 1) {
			// Rename file extension to html.
			$path = 'application/widgets/'.$name.'/index.php';

			if (file_exists($path)) {
				include $path;
			} else {
				$name = str_replace('-', '_', $name);
				$ci->widgets->{$name}($id);
			}
		}
	}
?>