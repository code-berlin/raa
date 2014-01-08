<?php
require_once(APPPATH . 'controllers/test/Toast.php');
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Permission_tests extends Basic_tests
{
	function Permission_tests() {
		parent::Toast(__FILE__);

		$this->minimal_db_version = 22;
		$this->id = 0;
	}

	function _pre() {
		$this->load->model('permission_m');
	}

	function _post() {
		$this->permission_m->remove($this->get_permission($this->id));
	}

	function test_create_and_retrieve_permission() {
		$this->id = $this->permission_m->create_permission('TEST_PERMISSION');

		$this->_assert_not_empty($this->get_permission($this->id));
	}

	function get_permission($id) {
		return $this->permission_m->get_by_id($id);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */