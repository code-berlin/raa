<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for permissions
 */
class Section_dao extends DB_dao {

	public function __construct(){
		parent::__construct('section');
	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($section) {
		return R::store($section);
	}

	public function remove($section) {
		return R::trash($section);
	}

}
