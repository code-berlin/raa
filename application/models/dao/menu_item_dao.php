<?php
/**
 * DAO for menu
 *
 */
class Menu_item_dao extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->table = 'menu_item';
	}

	public function get_by_menu_id($id) {
		$menu_items  = R::find($this->table, 'id_menu = ?', array($id));

		R::preload($menu_items, array('url')); // Related types

		return $menu_items;
	}

	public function check_if_published($id) {

		$item = R::load('menu', $id);

		if ($item)
		{
			$published_state = $item->published;
		}
		else
		{
			$published_state = NULL;
		}

		return $published_state;
	}
}
