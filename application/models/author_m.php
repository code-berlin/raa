<?php
class Author_m extends CI_Model {

	function __construct() {
		parent::__construct();

		$this->load->model('dao/author_dao');
	}

	function create() {
		return $this->author_dao->create();
	}

	function save($author) {
		return $this->author_dao->save($author);
	}

	function get_by_name($name) {
		return $this->author_dao->get_by_name($name);
	}

}