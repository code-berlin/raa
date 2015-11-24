<?php
/**
 * DAO for menu
 *
 */
class Menu_item_dao extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'menu_item';
	}

	public function get_by_menu_id($id) {
		$menu_items  = R::find($this->table, 'id_menu = ? AND published = 1', array($id));

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

	public function get_menu_items_by_menu_id_and_parent_id($menu_id, $parent_id) {
		
		$qry = "SELECT `menu_item`.`id`, `menu_item`.`contentId`, `child`.`menu_title`, `child`.`slug`, `child`.`parent_id`, `parent`.`slug` as parent_slug FROM `menu_item` 
				LEFT JOIN `page` as child ON `menu_item`.`contentId` = `child`.`id` 
				LEFT JOIN `page` as parent ON `parent`.`id` = `child`.`parent_id`
				WHERE `menu_item`.`content_type` = 'page'
				AND `menu_item`.`id_menu` = :menu_id
				AND `menu_item`.`parent_id` " . ($parent_id == "" ? " IS NULL" : " = :parent_id") . " 
				AND `menu_item`.`published` = 1 
				AND `child`.`published` = 1
				ORDER BY `menu_item`.`position` ASC";

		if ($parent_id == "") return R::getAll($qry, [ 'menu_id' => $menu_id ]);

		return R::getAll($qry, [ 'menu_id' => $menu_id, 'parent_id' => $parent_id ]);

	}

}
