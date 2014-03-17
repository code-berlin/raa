<?php
class Menu_item_m extends RedBean_SimpleModel {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/menu_item_dao');
	}

	public function get_by_menu_id($id) {
		return $this->menu_item_dao->get_by_menu_id($id);
	}

	public function check_if_published($id) {
		return $this->menu_item_dao->check_if_published($id);
	}
}