<?php
class Author_m extends CI_Model {

	function __construct() {
		parent::__construct();

		$this->load->model('dao/author_dao');
	}


	function create($name, $profession, $image, $text, $published, $gender) {
		return $this->author_dao->create($name, $profession, $image, $text, $published, $gender);
	}

	function get_by_name($name) {
		return $this->author_dao->get_by_name($name);
	}


}