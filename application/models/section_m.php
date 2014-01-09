<?php
class Section_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/section_dao');
		$this->load->model('section_permission_m');
	}

	function create() {
		return $this->section_dao->create();
	}

	function get_by_id($id) {
		return $this->section_dao->get_by('id', $id);
	}
	function get_by($field, $id) {
		return $this->section_dao->get_by($field, $id);
	}

	function get_permissions($id) {
		return $this->section_permission_m->get_permissions($id);
	}

	function save($object) {
		return $this->section_dao->save($object);
	}

	function remove($object) {
		return $this->section_dao->remove($object);
	}
}