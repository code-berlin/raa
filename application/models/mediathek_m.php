<?php
class Mediathek_m extends CI_Model {

	function __construct() {
		parent::__construct();

		$this->load->model('dao/mediathek_dao');
	}

	function create() {
		return $this->mediathek_dao->create();
	}

	function save($asset) {
		return $this->mediathek_dao->save($asset);
	}

	function get_by_name($name) {
		return $this->mediathek_dao->get_by_name($name);
	}

	function get_by_id($id) {
		return $this->mediathek_dao->get_by_id($id);
	}

}