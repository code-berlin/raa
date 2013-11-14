<?php
class Menu_item_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/menu_item_dao');
	}

	public function get_by_menu_id($id) {
		return $this->menu_item_dao->get_by_menu_id($id);
	}
}