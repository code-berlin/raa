<?php
/**
 * DAO for template
 *
 */
class Template_dao extends CI_Model {

	public function __construct() {

		parent::__construct();

		$this->load->library('rb');

		$this->table = 'template';

	}

	public function get_by_name($name) {
		return R::findOne($this->table, 'name = :name',
			array(':name' => $name));
	}

}