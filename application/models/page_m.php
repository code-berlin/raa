<?php
class Page_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/page_dao');
	}

	function get_all() {
		return $this->page_dao->get_all();
	}

	function get_by_id($id) {
		return $this->page_dao->get_by_id($id);
	}

	function get_by_slug($slug) {
		return $this->page_dao->get_by_slug($slug);
	}

	function save($page) {
		return $this->page_dao->save($page);
	}

}