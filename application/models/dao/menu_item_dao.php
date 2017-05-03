<?php
/**
 * DAO for menu
 *
 */
class Menu_item_dao extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'menuitem';
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

		$qry = "SELECT `menuitem`.`id`, `menuitem`.`contentId`, `menuitem`.`jumpmark`, `child`.`menu_title`, `child`.`menu_title_mobile`, `child`.`slug`, `child`.`parent_id`, `child`.`image`, `parent`.`slug` as parent_slug FROM `menuitem`
				LEFT JOIN `page` as child ON `menuitem`.`contentId` = `child`.`id`
				LEFT JOIN `page` as parent ON `parent`.`id` = `child`.`parent_id`
				WHERE `menuitem`.`content_type` = 'page'
				AND `menuitem`.`id_menu` = :menu_id
				AND `menuitem`.`parent_id` " . ($parent_id == "" ? " IS NULL" : " = :parent_id") . "
				AND `menuitem`.`published` = 1
				AND `child`.`published` = 1
				ORDER BY `menuitem`.`position` ASC";

		if ($parent_id == "") return R::getAll($qry, [ 'menu_id' => $menu_id ]);

		return R::getAll($qry, [ 'menu_id' => $menu_id, 'parent_id' => $parent_id ]);

	}

}
