<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for permissions
 */
class Role_dao extends DB_dao {

	public function __construct(){
		parent::__construct('role');
	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($role) {
		return R::store($role);
	}

	public function remove($role) {
		return R::trash($role);
	}

}
