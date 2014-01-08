<?php
require_once(APPPATH . 'controllers/test/Toast.php');
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Role_permission_tests extends Basic_tests
{
	function Role_permission_tests() {
		parent::Toast(__FILE__);

		$this->minimal_db_version = 22;

		define('PERMISSIONS', 5);
		define('ROLE', 1);

		$this->role_permissions = array();

		$this->permission = new stdClass();
		$this->role = new stdClass();
		$this->role_permission = new stdClass();
	}

	function _pre() {
		$this->load->model('role_permission_m');

		for($i=0; $i<PERMISSIONS; $i++) {
			$id = $this->role_permission_m->create_role_permission(ROLE, $i);
			array_push($this->role_permissions, $id);
		}
	}

	function _post() {
		$role_permission_m = $this->role_permission_m;

		foreach ($this->role_permissions as $key => $value) {
			$role_permission = $role_permission_m->get_by_id($value);

			$role_permission_m->remove($role_permission);
		}
	}

	function test_link_multiple_permissions_to_a_role() {
		$role_permission_m = $this->role_permission_m;

		foreach ($this->role_permissions as $key => $value) {
			$role_permission = $role_permission_m->get_by_id($value);

			$this->_assert_equals($value, $role_permission->id);

			$role_permission_m->remove($role_permission);
		}
	}

	function test_retrieve_set_of_permissions_by_role() {
		$role_permissions = $this->role_permission_m->get_by_role(ROLE);

		$this->_assert_not_empty($role_permissions);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */