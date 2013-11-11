<?php
class Type_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/type_dao');
	}

	public function get_by_name($name) {
		return $this->type_dao->get_by_name($name);
	}
}