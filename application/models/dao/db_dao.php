<?php
/**
 * DAO
 *
 */
class DB_dao extends CI_Model{

	public function __construct($table){
		parent::__construct();
        $CI = & get_instance();
        $CI->load->library('rb');

		$this->table = $table;
	}

	public function get_all() {
		return R::find($this->table);
	}

	public function get_all_by($field, $value) {
		return R::find($this->table, $field.' = :'.$field, array(':'.$field => $value));
	}

	public function get_by_id($id) {
		return R::load($this->table, $id);
	}

	public function get_by($field, $value) {
		return R::findOne($this->table, $field.' = :'.$field, array(':'.$field => $value));
	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($object) {
		return R::store($object);
	}

	public function remove($object) {
		return R::trash($object);
	}

}
