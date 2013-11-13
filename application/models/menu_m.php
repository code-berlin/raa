<?php
class Menu_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/menu_dao');
	}

	public function get_by_id($id) {
		return $this->menu_dao->get_by_id($id);
	}
}