<?php
class Sidebar_teaser_m extends CI_Model {

	function __construct() {
		parent::__construct();

		$this->load->model('dao/sidebar_teaser_dao');
	}

	function create() {
		return $this->sidebar_teaser_dao->create();
	}

	function save($sidebar_teaser) {
		return $this->sidebar_teaser_dao->save($sidebar_teaser);
	}

	function get_all() {
		return $this->sidebar_teaser_dao->get_all();
	}

	function get_by_name($name) {
		return $this->sidebar_teaser_dao->get_by_name($name);
	}

	function get_by_id($id) {
		return $this->sidebar_teaser_dao->get_by_id($id);
	}

}