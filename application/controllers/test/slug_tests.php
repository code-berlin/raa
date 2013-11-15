<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Slug_tests extends Toast
{
	function Slug_tests()
	{
		parent::Toast(__FILE__);
		// Load any models, libraries etc. you need here

		$this->example_slug = 'test-page-'.uniqid();
		$this->slug_id = 0;
	}

	function _pre() {
		$this->load->model('url_m');
		$this->load->model('type_m');

		$this->slug_id = $this->type_m->save_slug('page', $this->example_slug, 0);
	}

	function _post() {
		$slug = $this->url_m->get_by_id($this->slug_id);
		$this->url_m->delete($slug);
	}

	function test_slug_type_correlation()
	{
		$url = $this->url_m->get_by_slug($this->example_slug);
		$type = $this->type_m->get_by_name('page');

		$this->_assert_equals($url->type_id, $type->id);
	}

	function test_object_type_loader()
	{
		// Retrieve object type related to this slug
		$result = $this->url_m->get_by_slug($this->example_slug);

		// Use this object type as reference for loading models
		$object_type = $result->type->name.'_m';

		$this->load->model($object_type);

		$objects = $this->$object_type->get_all();

		$this->_assert_not_empty($objects);
	}

	function test_sluggifier()
	{
		$url = str_replace('-', ' ', $this->example_slug);
		$slugged_url = $this->example_slug;

		$this->_assert_equals($slugged_url, $this->url_m->sluggify($url));
	}

	function test_slug_storage() {
		$this->_assert_not_equals($this->slug_id, 0);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */