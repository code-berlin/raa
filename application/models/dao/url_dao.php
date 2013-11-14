<?php
/**
 * DAO for URLs
 *
 */
class Url_dao extends CI_Model{

	public function __construct(){
	    parent::__construct();

		$this->load->library('rb');
	}

	public function get_all() {
		return R::find('url');
	}

	public function get_by_id($id) {
		return R::load('url', $id);
	}

	public function get_by_slug($slug) {
		$url = R::findOne('url', 'slug = :slug',
			array(':slug' => $slug));

		if (!empty($url)) {
			R::preload($url, array('type')); // Related types
		}

		return $url;
	}

	public function save($url) {
		return R::store($url);
	}
}
