<?php
/**
 * DAO for URLs
 *
 */
class Url_dao extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->table = 'url';

		$this->load->library('rb');
	}

	public function get_all() {
		return R::find($this->table);
	}

	public function get_by_id($id) {
		return R::load($this->table, $id);
	}

	public function get_by_slug($slug) {
		$url = R::findOne($this->table, 'slug = :slug',
			array(':slug' => $slug));

		if (!empty($url)) {
			R::preload($url, array('type')); // Related types
		}

		return $url;
	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($url) {
		return R::store($url);
	}

	public function delete($url) {
		return R::trash($url);
	}
}
