<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for widgets and containers relation
 *
 */
class Widgets_containers_dao extends DB_dao {

	public function __construct(){
		parent::__construct('widgetscontainersrelation');
	}

	public function get_all_by($name, $id) {
		return R::find($this->table, $name.' = :'.$name.' ORDER BY widget_position', array(':'.$name => $id));
	}
}
