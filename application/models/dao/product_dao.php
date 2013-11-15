<?php
/**
 * DAO for pages
 *
 */
class Product_dao extends CI_Model{

	public function __construct(){
	    parent::__construct();

		$this->load->library('rb');

		$this->table = 'product';

		$this->object = new stdClass();
	}

	public function get_all() {
		$this->object = R::find($this->table);
		
		//$this->preload_template();

		return $this->object;
	}

	public function get_by_id($id) {
		$this->object = R::load($this->table, $id);

		$this->preload_template();

		return $this->object;
	}

	public function get_by_slug($slug) {
		$this->object = R::findOne($this->table, 'slug = :slug',
			array(':slug' => $slug));

		$this->preload_template();

		return $this->object;
	}

	public function preload_template() {
		if (!empty($this->object)) {
			R::preload($this->object, array('template')); // Related types
		}
	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($page) {
		return R::store($page);
	}

	public function delete($page) {
		return R::trash($page);
	}
}
