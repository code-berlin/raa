<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Widget_tests extends Toast
{
	function Widget_tests()
	{
		parent::Toast(__FILE__);
		// Load any models, libraries etc. you need here
	}

	/**
	 * OPTIONAL; Anything in this function will be run before each test
	 * Good for doing cleanup: resetting sessions, renewing objects, etc.
	 */
	function _pre() {
        $this->load->model('widget_m');
	}

	/**
	 * OPTIONAL; Anything in this function will be run after each test
	 * I use it for setting $this->message = $this->My_model->getError();
	 */
	function _post() {}

}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */