<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for permissions
 */
class Role_permission_dao extends DB_dao {

	public function __construct(){
		parent::__construct('rolepermission');
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

	public function get_by_role_and_permission($role_id, $permission_id) {
		$element = R::findOne(
			$this->table,
			'role_id = :'.$role_id.' AND permission_id = :'.$permission_id,
			array(
				':'.$role_id => $role_id,
				':'.$permission_id => $permission_id
			)
		);

		return $this->get_by_id($element->id);
	}
}
