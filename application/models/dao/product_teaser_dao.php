<?php
/**
 * DAO for settings
 *
 */
class Product_teaser_dao extends CI_Model {

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');

		$this->table = 'productteaser';

		$this->object = new stdClass();
	}

	public function get_by_id($id) {
		$this->object = R::load($this->table, $id);

		return $this->object;
	}

	public function get_by_ids($ids) {

		$id_arr = explode(',',$ids);

		$this->object = R::find($this->table,
    		' published = 1 AND id IN (' . R::genSlots($id_arr) . ')',
    		$id_arr);

		return $this->object;
	}

}