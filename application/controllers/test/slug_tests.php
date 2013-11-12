<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Slug_tests extends Toast
{
	function Slug_tests()
	{
		parent::Toast(__FILE__);
		// Load any models, libraries etc. you need here
	}

	/**
	 * OPTIONAL; Anything in this function will be run before each test
	 * Good for doing cleanup: resetting sessions, renewing objects, etc.
	 */
	function _pre() {
        $this->load->model('url_m');
	}

	/**
	 * OPTIONAL; Anything in this function will be run after each test
	 * I use it for setting $this->message = $this->My_model->getError();
	 */
	function _post() {}

	function test_slug_type_correlation()
	{
        $page_id = 3;
        $example_slug = 'this-is-my-wonderful-and-incredible-url-slug';

        $type = $this->url_m->get_by_slug($example_slug);

        if ($type) {
			$this->_assert_equals($type->id, $page_id);
		} else {
			return false;
		}
	}

	function test_object_type_loader()
	{
		$example_slug = 'this-is-my-wonderful-and-incredible-url-slug';

        // Retrieve object type related to this slug
        $result = $this->url_m->get_by_slug($example_slug);

        if ($result) {
	        // Use this object type as reference for loading models
	        $object_type = $result->type->name.'_m';

	        $this->load->model($object_type);

	        $objects = $this->$object_type->get_all();

	        $this->_assert_not_empty($objects);
		} else {
			return false;
		}
	}

	function test_sluggifier()
	{
		$url = 'test test test/test&test\test';
		$slugged_url = 'test-test-test-test-test-test';

		$this->_assert_equals($slugged_url, $this->url_m->sluggify($url));
	}

	function test_slug_storage() {
		$new_slug = $this->url_m->save_slug('post', 'test-storage-slug');

		$this->_assert_not_empty($new_slug);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */