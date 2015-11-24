<?php
/**
 * DAO for menu
 *
 */
class Menu_dao extends CI_Model{

	public function __construct(){

		parent::__construct();

		$this->load->library('rb');

		$this->table = 'menu';

	}

	public function get_all() {
		$this->object = R::find($this->table, 'published = 1');

		//$this->preload_template();

		return $this->object;
	}

	public function get_by_id($id) {
		/*$menu_items  = R::find('menu_item', 'id_menu = ?', array($id));
		return R::load($this->table, $id);*/
	}

}
