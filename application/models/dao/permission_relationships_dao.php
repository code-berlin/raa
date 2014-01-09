<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for permissions
 */
class Permission_relationships_dao extends DB_dao {

	public function __construct($type){
		$this->type = $type;

		switch ($this->type) {
			case 'rolepermission':
				parent::__construct('rolepermission');
				$this->table_id = 'role_id';
				break;
			case 'sectionpermission':
				parent::__construct('sectionpermission');
				$this->table_id = 'section_id';
				break;
		}
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

	public function get_by_relationship($type_id, $permission_id) {
		$element = R::findOne(
			$this->table,
			$this->table_id.' = :'.$type_id.' AND permission_id = :'.$permission_id,
			array(
				':'.$type_id => $type_id,
				':'.$permission_id => $permission_id
			)
		);

		if ($element) {
			return $this->get_by_id($element->id);
		} else {
			return 0;
		}
	}
}
