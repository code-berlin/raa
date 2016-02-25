<?php
/**
 * DAO for pages
 *
 */
class Author_dao extends CI_Model {

	public function __construct() {

		parent::__construct();

		$this->load->library('rb');

		$this->table = 'author';

	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($author) {
		return R::store($author);
	}

	public function get_by_name($name) {
		return R::findOne($this->table, 'name = :name',
			array(':name' => $name));
	}

	public function get_all() {
		return R::find($this->table, 'published = 1');
	}

}