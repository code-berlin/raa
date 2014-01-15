<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for Facebook apps
 *
 */
class Facebook_app_dao extends DB_dao {
	public function __construct() {
		parent::__construct('facebookapp');
	}
}
