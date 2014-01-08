<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for URLs
 *
 */
class User_dao extends DB_dao {

	public function __construct(){
		parent::__construct('user');
	}

	public function get_by_username($username) {

		$user = R::findOne($this->table,
			'username = :username',
			array(':username' => $username));

		return $user;
	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($user) {
		return R::store($user);
	}

	public function remove($user) {
		return R::trash($user);
	}

}
