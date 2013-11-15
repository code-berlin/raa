<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function widgets_container_load_container($name) {
		$CI =& get_instance();

		$CI->load->model('widgets_containers_m');
		$CI->load->model('widget_m');

		$widgets_container = $CI->widgets_containers_m->get_all_by_widgets_container_name_ordered_by_position($name);

		foreach ($widgets_container as $container) {
			load_widget($container->widget->widgetname);
		}
	}

?>