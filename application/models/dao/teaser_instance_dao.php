<?php

/**
 * DAO for Teaser
 *
 */
class Teaser_instance_dao extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'teaserinstance';

		$this->object = new stdClass();
	}

	public function get_by_id($id) {
		$this->object = R::load($this->table, $id);

		return $this->object;
	}

	public function get_by_page_id($page_id) {

		$qry = 'SELECT
					`instance`.`id` AS id, `instance`.`position` AS position, `instance`.`title` AS title, `instance`.`text` AS text, `instance`.`jumpmark` AS jumpmark, `types`.`name` AS name
				FROM `' . $this->table . '` AS `instance`
				LEFT JOIN
					`teasertypes` AS `types` ON `types`.`id` = `instance`.`teaser_types_id`
				WHERE
					`instance`.`page_id` = :page_id AND
					`instance`.`published` = 1
				ORDER BY
					`instance`.`position`;';

		$this->object = R::getAll($qry, [ 'page_id' => $page_id ]);

		return $this->object;
	}

}