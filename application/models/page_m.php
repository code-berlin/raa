<?php
class Page_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('rb');
	}

	function get_all() {
		return R::find('page');
	}

	function get_by_id($id) {
		return R::load('page', $id);
	}

	function get_by_slug($slug) {
		return R::findOne('page', 'slug = :slug',
			array(':slug' => $slug)
		);
	}

}