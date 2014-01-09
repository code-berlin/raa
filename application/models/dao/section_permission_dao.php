<?php
require_once(APPPATH . 'models/dao/permission_relationships_dao.php');

/**
 * DAO for permissions
 */
class Section_permission_dao extends Permission_relationships_dao {

	public function __construct(){
		parent::__construct('sectionpermission');
	}
}
