<?php

/**
 * DAO for Teaser
 *
 */
class Teaser_item_dao extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'teaseritem';

		$this->object = new stdClass();
	}

	public function get_by_teaser_instance_id($teaser_instance_id) {

		$qry = 'SELECT
					`item`.`title`,
					`item`.`text`,
					`page`.`id` AS `page_id`,
					`page`.`slug` AS `page_slug`,
					`page`.`image` AS `page_image`,
					`page`.`menu_title` AS `page_title`,
					`page`.`teaser_text` AS `page_text`,
					`page`.`commercial` AS `page_commercial`,
					`parent`.`slug` AS `parent_slug`,
					`parent`.`menu_title` AS `parent_menu_title`,
					`item`.`content_type` as `content_type`,
					`item`.`external_link` as `external_link`,
					`item`.`external_image` as `external_image`,
					`articlegroup`.`id` as `article_group_id`,
					`articlegroup`.`name` as `article_group_name`
				FROM `teaseritem` AS `item`
				LEFT JOIN
					page ON `page`.`id` = `item`.`contentId`
				LEFT JOIN
					`page` AS `parent` ON `parent`.`id` = `page`.`parent_id`
				LEFT JOIN
					articlegroupitem ON `articlegroupitem`.`contentId` = `item`.`contentId`
				LEFT JOIN
					articlegroup ON `articlegroup`.`id` = `articlegroupitem`.`articlegroupId`
				WHERE
					`item`.`published` = 1 AND
					`item`.`teaser_instanceId` = :teaser_instance_id AND
					IF (`content_type` = \'page\', `page`.`published`, 1) = 1
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
