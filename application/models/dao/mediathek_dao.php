<?php
/**
 * DAO for Mediathek
 *
 */
class Mediathek_dao extends CI_Model {

	public function __construct() {

		parent::__construct();

		$this->load->library('rb');

		$this->table = 'mediathek';

	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($asset) {
		return R::store($asset);
	}

	public function get_by_name($name) {
		return R::findOne($this->table, 'name = :name',
			array(':name' => $name));
	}

	public function get_by_id($id) {
		return R::findOne($this->table, 'id = :id',
			array(':id' => $id));
	}

}