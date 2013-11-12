<?php
/**
 * DAO for type
 *
 */
class Type_dao extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');
	}

	public function get_by_id($id) {
		return R::load('type', $id);
	}

	public function get_by_name($name) {
		return R::findOne('type',
			'name = :name',
			array(':name' => $name)
		);
	}

	public function save($name) {
		$type= R::dispense('type');
		$type->name = $name;

		return R::store($type);
	}

	public function delete($id) {
		$type = $this->get_by_id($id);

		return R::trash($type);
	}
}
