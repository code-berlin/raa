<?php
class Widgets_containers_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/widgets_containers_dao');
	}

	function create() {
		return $this->widgets_containers_dao->create();
	}

	function save($object) {
		return $this->widgets_containers_dao->save($object);
	}

	function remove($object) {
		return $this->widgets_containers_dao->remove($object);
	}

	function get_all_by_widgets_container_id($id) {
		return $this->widgets_containers_dao->get_all_by('widgets_container_id', $id);
	}

	function get_all_by_widgets_container_name_ordered_by_position($name) {
		$this->load->model('widgets_container_m');

		$widget_container = $this->widgets_container_m->get_by_name($name);

		return $this->get_all_by_widgets_container_id($widget_container->id);
	}
}