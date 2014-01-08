<?php
require_once(APPPATH . 'controllers/test/Toast.php');
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Auth_tests extends Basic_tests
{
	function Auth_tests() {
		parent::Toast(__FILE__);
		$this->minimal_db_version =19;
		$this->user = new stdClass();
		$this->role = new stdClass();
	}

	function _pre() {

		$this->load->library('session');
		$this->session->unset_userdata('user_name'); // erasing the session

		$this->load->library('auth_l'); 

		$this->load->model('role_m');		
		$this->role = $this->role_m->create();
		$this->role->title = 'admin';

		$this->role_id = $this->role_m->save($this->role);

		$this->load->model('user_m');
		$this->user = $this->user_m->create();
		$this->user->username = 'test13212-username@code-b.com';
		$this->user->role_id = $this->role_id;

		$this->user_id = $this->user_m->save($this->user);

	}

	function _post() {

		$this->session->unset_userdata('user_name'); // erasing the session
		$this->user_m->remove($this->user);
		$this->role_m->remove($this->role);

	}

	function test_retrieve_user_role() { 
		
		// no session
		$user_role = $this->auth_l->retrieve_user_role();
		$this->_assert_false($user_role);

		// setting the session and going on with the test
		$user = array('user_name'=>$this->user->username);
		$this->session->set_userdata($user);

		$user_role = $this->auth_l->retrieve_user_role();
		$this->_assert_equals($user_role, $this->role->title);
		
	}
 
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */