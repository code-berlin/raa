<?php

/**
 * DAO for Teaser
 *
 */
class Teaser_item_dao extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'teaser_item';

		$this->object = new stdClass();
	}

	public function get_by_teaser_instance_id($teaser_instance_id) {

		$qry = 'SELECT 
					`item`.`title`, `item`.`text`, `page`.`id` AS `page_id`, `page`.`slug` AS `page_slug`, `page`.`image` AS `page_image`, `page`.`menu_title` AS `page_title`, `page`.`teaser_text` AS `page_text`, `parent`.`slug` AS `parent_slug` 
				FROM `teaser_item` AS `item` 
				LEFT JOIN 
					page ON `page`.`id` = `item`.`contentId` 
				LEFT JOIN 
					`page` AS `parent` ON `parent`.`id` = `page`.`parent_id` 
				WHERE 
					`item`.`published` = 1 AND 
					`item`.`teaser_instanceId` = :teaser_instance_id AND 
					`page`.`published` = 1 
				ORDER BY 
					`item`.`position`;';

		$this->object = R::getAll($qry, [ 'teaser_instance_id' => $teaser_instance_id ]);

		return $this->object;
	}

	public function count_by_teaser_instance_id($teaser_instance_id) {
		$this->object = R::count($this->table, 'teaser_instanceId = ? ', [ $teaser_instance_id ]);

		return $this->object;
	}

}