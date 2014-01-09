<?php
require_once(APPPATH . 'models/permission_relationships_m.php');

class Section_permission_m extends Permission_relationships_m {

	function __construct()
	{
		parent::__construct('section');
	}
}