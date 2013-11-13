<?php
/**
 * DAO for menu
 *
 */
class Menu_dao extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->table = 'menu';

		$this->load->library('rb');
	}

	public function get_by_id($id) {
		/*$menu_items  = R::find('menu_item', 'id_menu = ?', array($id));
		return R::load($this->table, $id);*/
	}
}
