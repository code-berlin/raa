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
		return $this->role_permission_dao->get_all_by('role_id', $role_id);
	}

	function get_by_role_and_permission($role_id, $permission_id) {
		return $this->role_permission_dao->get_by_role_and_permission($role_id, $permission_id);
	}

	function get_permissions($role_id) {
		return $this->role_permission_dao->get_all_by('role_id', $role_id);
	}

	function save($object) {
		return $this->role_permission_dao->save($object);
	}

	function remove($object) {
		return $this->role_permission_dao->remove($object);
	}

	function check_combination_exists($role_id, $permission_id) {
		$role_permissions = $this->role_permission_dao->get_all_by('role_id', $role_id);

		if (!empty($role_permissions)) {
			foreach($role_permissions as $role_permission) {
				if ($role_permission->permission_id == $permission_id) {
					return true;
				}
			}
		}

		return false;
	}

	function create_role_permission($role_id, $permission_id) {
		$role_permission = $this->create();
		$role_permission->role_id = $role_id;
		$role_permission->permission_id = $permission_id;
		return $this->save($role_permission);
	}

	function clear_role_permissions($role_id) {
		$role_permissions = $this->get_by_role($role_id);

		foreach ($role_permissions as $role_permission) {
			$this->remove($role_permission);
		}
	}

	function get_role_permissions_list($role_id) {
        $role_permissions = $this->get_by_role($role_id);

        $permission_ids = array();

        foreach ($role_permissions as $role_permission) {
            array_push($permission_ids, $role_permission->permission_id);
        }

        return $permission_ids;
	}
}