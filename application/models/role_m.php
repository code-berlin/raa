<?php
class Role_m extends RedBean_SimpleModel {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/role_dao');
		$this->load->model('role_permission_m');
		$this->load->model('permission_m');
	}

	function create() {
		return $this->role_dao->create();
	}

	function get_by_id($id) {
		return $this->role_dao->get_by('id', $id);
	}

	function get_permissions($id) {
		return $this->role_permission_m->get_permissions($id);
	}

	function save($object) {
		return $this->role_dao->save($object);
	}

	function remove($object) {
		return $this->role_dao->remove($object);
	}
}