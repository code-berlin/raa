<?php

/**
 * DAO for Teaser
 *
 */
class Teaser_instance_dao extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'teaser_instance';

		$this->object = new stdClass();
	}

	public function get_by_id($id) {
		$this->object = R::load($this->table, $id);

		return $this->object;
	}

	public function get_by_page_id($page_id) {

		$qry = 'SELECT `instance`.`id`, `instance`.`position`, `instance`.`title`, `instance`.`text`, `types`.`name` FROM `' . $this->table . '` as `instance` LEFT JOIN `teaser_types` AS `types` ON `types`.`id` = `instance`.`teaser_types_id` WHERE `instance`.`page_id` = :page_id AND `instance`.`published` = 1 ORDER BY `instance`.`position`;';

		$this->object = R::getAll($qry, [ 'page_id' => $page_id ]);

		return $this->object;
	}

}