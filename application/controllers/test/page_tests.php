<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Page_tests extends Toast
{
	function Page_tests()
	{
		parent::Toast(__FILE__);
		// Load any models, libraries etc. you need here

		$this->slug = 'test-page-'.uniqid();
		$this->new_page = new stdClass();
		$this->new_page_id = 0;
	}

	function _pre() {
		$this->load->model('page_m');

		$page_m = $this->page_m;

		$page = $page_m->get_by_slug($this->slug);

		if (empty($page)) {
			$this->new_page = $page_m->create();
			$this->new_page->slug = $this->slug;

			$this->new_page_id = $page_m->save($this->new_page);
		}
	}

	function _post() {
		$this->page_m->delete($this->new_page);
	}

	function test_page_retrieve_by_id()
	{
		$page = $this->page_m->get_by_id($this->new_page_id);

		$this->_assert_equals($page->id, $this->new_page_id);
	}

	function test_page_retrieve_by_slug()
	{
		$page = $this->page_m->get_by_slug($this->slug);

		$this->_assert_not_empty($page);
	}

	function test_page_creation()
	{
		$this->_assert_equals($this->new_page_id, $this->new_page->id);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */