<?php
class Page_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_all() {
		getById(1);
	}

	function get_by_id($id) {
		echo $id;
	}
}