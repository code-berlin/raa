<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for widgets and containers relation
 *
 */
class Widgets_container_dao extends DB_dao {

	public function __construct(){
		parent::__construct('widgetscontainer');
	}
}
