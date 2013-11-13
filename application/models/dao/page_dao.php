<?php
/**
 * DAO for pages
 *
 */
class Page_dao extends CI_Model{

	public function __construct(){
	    parent::__construct();

		$this->load->library('rb');

		$this->object = new stdClass();
	}

	public function get_all() {
		$this->object = R::find('page');

		$this->preload_template();

		return $this->object;
	}

	public function get_by_id($id) {
		$this->object = R::load('page', $id);

		$this->preload_template();

		return $this->object;
	}

	public function get_by_slug($slug) {
		$this->object = R::findOne('page', 'slug = :slug',
			array(':slug' => $slug));

		$this->preload_template();

		return $this->object;
	}

	public function preload_template() {
		if (!empty($this->object)) {
			R::preload($this->object, array('template')); // Related types
		}
	}

	public function save($page) {
		return R::store($page);
	}
}
