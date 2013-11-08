<?php
class Page_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('rb');
	}

	function get_all() {
		getById(1);
	}

	function get_by_id($id) {
		$pages = R::find('page', 'id = ?', array($id));

		echo '<pre>';
		var_dump($pages);
		echo '</pre>';

		echo $id;
	}
}