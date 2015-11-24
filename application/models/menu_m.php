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

	public function get_all() {
		return $this->menu_dao->get_all();
	}

	public function get_all_menus_with_items() {

	}
}