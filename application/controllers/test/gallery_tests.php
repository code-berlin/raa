<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Gallery_tests extends Toast
{

	function Gallery_tests(){

		parent::__construct(__FILE__);

	}


	function test_gallery_detail() {

		$this->load->model("gallery_m");

		$this->config->set_item('mockup_api_url', base_url("/moc_api/get_data?file=gallery/detail/gallery_detail.json")); // mockup API call

		$gallery = $this->gallery_m->get_gallery_detail(0);

		if(isset($gallery['subject'])){
			$this->_assert_not_empty($gallery['subject']);
		} else {
			$this->_assert_true(false);
		}
		if(isset($gallery['relatedArticles'])){
			$this->_assert_not_empty($gallery['relatedArticles']);
		} else {
			$this->_assert_true(false);
		}

	}

}