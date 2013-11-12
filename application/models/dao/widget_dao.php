<?php
/**
 * DAO for widgets
 *
 */
class Widget_dao extends CI_Model{

	public function __construct(){
	    parent::__construct();

		$this->load->library('rb');

		$this->widgets = array();
	}

	public function get_all() {
		return R::find('widget');
	}

	public function get_by_id($id) {
		return R::load('widget', $id);
	}

	public function get_by_name($name) {
		$widget = R::findOne('widget', 'widgetname = :name',
			array(':name' => $name));

		return $widget;
	}

	public function save($name) {
		if ($this->get_by_name($name) == NULL) {
			$widget= R::dispense('widget');

			$widget->widgetname = $name;
			$widget->activated = 1;
			$widget->created = date('Y-m-d H:i:s');

			R::store($widget);
		}

		array_push($this->widgets, $name);
	}

	public function clean() {
		$widgets = $this->get_all();

		foreach($widgets as $widget) {
			if(!in_array($widget->widgetname, $this->widgets)) {
				$this->remove($widget->widgetname);
			}
		}
	}

	public function remove($name) {
		$widget= $this->get_by_name($name);

		R::trash($widget);
	}

}
