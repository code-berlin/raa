<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Page_tests extends Toast
{
	function Page_tests()
	{
		parent::Toast(__FILE__);
		// Load any models, libraries etc. you need here
	}

	/**
	 * OPTIONAL; Anything in this function will be run before each test
	 * Good for doing cleanup: resetting sessions, renewing objects, etc.
	 */
	function _pre() {
        $this->load->model('page_m');
	}

	/**
	 * OPTIONAL; Anything in this function will be run after each test
	 * I use it for setting $this->message = $this->My_model->getError();
	 */
	function _post() {}

	function test_page_retrieve_by_id()
	{
        $page = $this->page_m->get_by_id(1);

		$this->_assert_not_equals($page->id, 0);
	}

	function test_page_retrieve_by_slug()
	{
        $slug = 'amazing-7-7-7-3-3-3';

        $page = $this->page_m->get_by_slug($slug);

		$this->_assert_not_empty($page);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */