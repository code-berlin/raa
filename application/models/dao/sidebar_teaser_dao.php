<?php
/**
 * DAO for sidebar_teaser
 *
 */
class Sidebar_teaser_dao extends CI_Model {

	public function __construct() {
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'sidebarteaser';

	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($sidebar_teaser) {
		return R::store($sidebar_teaser);
	}

	public function get_all() {
		return R::find($this->table);
	}

	public function get_by_name($name) {
		return R::findOne($this->table, 'name = :name',
			array(':name' => $name));
	}

	public function get_by_id($id) {
		return R::load($this->table, $id);
	}

}