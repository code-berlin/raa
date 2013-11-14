<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Slug_tests extends Toast
{
	function Slug_tests()
	{
		parent::Toast(__FILE__);
		// Load any models, libraries etc. you need here

		$this->example_slug = 'test-page-'.uniqid();
	}

	function _pre() {
		$this->load->model('url_m');
		$this->load->model('type_m');
	}

	function _post() {}

	function test_slug_type_correlation()
	{
		$page_id = 3;

		$type = $this->url_m->get_by_slug($this->example_slug);

		if ($type) {
			$this->_assert_equals($type->id, $page_id);
		} else {
			return false;
		}
	}

	function test_object_type_loader()
	{
		// Retrieve object type related to this slug
		$result = $this->url_m->get_by_slug($this->example_slug);

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
		$url = str_replace('-', ' ', $this->example_slug);
		$slugged_url = $this->example_slug;

		$this->_assert_equals($slugged_url, $this->url_m->sluggify($url));
	}

	function test_slug_storage() {
		$id = $this->type_m->save_slug('post', $this->example_slug, 0);

		$slug = $this->url_m->get_by_id($id);
		$this->url_m->delete($slug);

		$this->_assert_not_empty($id);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */