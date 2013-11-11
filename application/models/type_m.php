<?php
class Type_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('rb');
	}

	public function get_by_name($name) {
		return R::findOne('type', 'name = :name',
			array(':name' => $name));
	}
}