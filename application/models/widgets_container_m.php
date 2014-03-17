<?php
class Widgets_container_m extends RedBean_SimpleModel {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/widgets_container_dao');
	}

	function create() {
		return $this->widgets_container_dao->create();
	}

	function get_by_name($name) {
		return $this->widgets_container_dao->get_by('name', $name);
	}

	function save($object) {
		return $this->widgets_container_dao->save($object);
	}

	function remove($object) {
		return $this->widgets_container_dao->remove($object);
	}
}