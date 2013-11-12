<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Type_tests extends Toast
{
	function Type_tests() {
		parent::Toast(__FILE__);
	}

	function _pre() {
		$this->load->model('type_m');
	}

	function test_type_removal() {
		$name = 'test_type_removal_xxx';
		$type = $this->type_m;

		$id = $type->save($name);

		$type->delete($id);

		$new_type = $type->get_by_name($name);

		$this->_assert_equals($new_type, NULL);
	}

	function test_type_creation() {
		$name = 'test_type_xxx';
		$type = $this->type_m;

		$id = $type->save($name);

		// Delete useless object created just for testing purposes
		$type->delete($id);

		$this->_assert_not_equals($id, 0);
	}

}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */