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
        $title = 'Test page';

        $page = $this->page_m->get_by_id(2);

		$this->_assert_equals($page->title, $title);
	}

	function test_page_retrieve_by_slug()
	{
        $slug = 'this-is-my-wonderful-and-incredible-url-slug';

        $page = $this->page_m->get_by_slug($slug);

		$this->_assert_not_empty($page);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */