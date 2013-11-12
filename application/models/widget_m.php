<?php
class Widget_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/widget_dao');
	}

	function get_all() {
		return $this->widget_dao->get_all();
	}

	function get_by_name($name) {
		return $this->widget_dao->get_by_name($name);
	}

	function get_by_id($id) {
		return $this->widget_dao->get_by_id($id);
	}

	function save($widget) {
		return $this->widget_dao->save($widget);
	}

	function scan_for_widgets() {
		// Scan widgets folder for available widgets
		$widgets_dir = scandir("application/widgets");

		foreach($widgets_dir as $widget) {
			// If it's an actual folder save the widget
			if ($widget != '.' && $widget != '..') {
				$this->save($widget);
			}
		}

		// Clean removed widgets
		$this->widget_dao->clean();
	}

}