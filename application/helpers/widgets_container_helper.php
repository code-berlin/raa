<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Loads a widget container.
* It depends on the widget helper to show the widgets.
*/
function load_widgets_container($name) {
	$CI =& get_instance();
	$CI->load->model('widgets_containers_m');

	$widgets_container = $CI->widgets_containers_m->get_all_by_widgets_container_name_ordered_by_position($name);

	if (!empty($widgets_container)) {
		foreach ($widgets_container as $container) {
			load_widget($container->widget->widgetname);
		}
	}
}
?>