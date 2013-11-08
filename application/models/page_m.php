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
		$table = 'page';
		$condition = 'id = :id AND published = :published';
		$rules = array(':id' => $id, ':published' => 1);

		return R::findOne($table, $condition, $rules);
	}
}