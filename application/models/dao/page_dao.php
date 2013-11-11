<?php
/**
 * DAO for pages
 *
 */
class Page_dao extends CI_Model{

	public function __construct(){
	    parent::__construct();
		$this->load->library('rb');
	}

	public function get_all() {
		return R::find('page');
	}

	public function get_by_id($id) {
		return R::load('page', $id);
	}

	public function get_by_slug($slug) {
		return R::findOne('page', 'slug = :slug',
			array(':slug' => $slug));
	}
}
