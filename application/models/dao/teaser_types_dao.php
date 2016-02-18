<?php

/**
 * DAO for Teaser
 *
 */
class Teaser_types_dao extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'teasertypes';

		$this->object = new stdClass();

	}

	public function get_all() {

		$this->object = R::find($this->table);

		return $this->object;

	}

	public function get_by_id($id) {
		$this->object = R::load($this->table, $id);

		return $this->object;
	}

}