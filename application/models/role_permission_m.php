<?php
class Role_permission_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/role_permission_dao');
		$this->load->model('permission_m');
	}

	function create() {
		return $this->role_permission_dao->create();
	}

	function get_by_id($id) {
		return $this->role_permission_dao->get_by_id($id);
	}

	function get_by_role($role_id) {
		return $this->role_permission_dao->get_by('role_id', $role_id);
	}

	function get_permissions($role_id) {
		return $this->role_permission_dao->get_by('role_id', $role_id);
	}

	function save($object) {
		return $this->role_permission_dao->save($object);
	}

	function remove($object) {
		return $this->role_permission_dao->remove($object);
	}

	function create_role_permission($role_id, $permission_id) {
		$role_permission = $this->create();
		$role_permission->role_id = $role_id;
		$role_permission->permission_id = $permission_id;
		return $this->save($role_permission);
	}
}