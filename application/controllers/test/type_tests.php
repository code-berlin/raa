<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Type_tests extends Toast
{
	function Type_tests() {
		parent::Toast(__FILE__);

		$this->id = 0;
		$this->type_name = 'test_type_xxx';
	}

	function _pre() {
		$this->load->model('type_m');

		$this->id = $this->type_m->save($this->type_name);
	}

	function _post() {
		$this->delete_type();
	}

	function test_type_removal() {
		$this->delete_type();

		$type = $this->type_m->get_by_name($this->type_name);

		$this->_assert_equals($type, NULL);
	}

	function test_type_creation() {
		$this->_assert_not_equals($this->id, 0);
	}

	function delete_type() {
		$this->type_m->delete($this->id);
	}

}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */