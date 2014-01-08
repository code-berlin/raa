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
}
