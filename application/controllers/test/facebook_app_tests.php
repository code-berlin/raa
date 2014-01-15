<?php
require_once(APPPATH . 'controllers/test/Toast.php');
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Facebook_app_tests extends Basic_tests
{
	function Facebook_app_tests() {
		parent::Toast(__FILE__);

		$this->minimal_db_version = 22;
	}

	function _pre() {
		$this->load->model('facebook_app_m');
	}

	function _post() {}

	function test_update_facebook_config_information() {
		$config = array(
			'appId' => 123,
			'secret' => 'shh',
			'cookie' => false
		);

		$old_config = $this->facebook_api->get_facebook_config();

		$this->facebook_api->update_facebook_config($config);

		$updated_config = $this->facebook_api->get_facebook_config();

		$this->_assert_not_equals($old_config['appId'], $config['appId']);
		$this->_assert_not_equals($old_config['secret'], $config['secret']);
		$this->_assert_not_equals($old_config['cookie'], $config['cookie']);
		$this->_assert_equals($updated_config['appId'], $config['appId']);
		$this->_assert_equals($updated_config['secret'], $config['secret']);
		$this->_assert_equals($updated_config['cookie'], $config['cookie']);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */