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
		$urls = R::findOne('url', 'slug = :slug',
			array(':slug' => $slug));

		if (!empty($urls)) {
			R::preload($urls, array('type')); // Related types
		}

		return $urls;
	}

	public function save_slug($type_name, $slug) {
		$this->load->model('type_m');

		$id = 0;
		$type = $this->type_m->get_by_name($type_name);

		if (!empty($type)) {
			$url= R::dispense('url');
			$url->type_id = $type->id;
			$url->slug = $slug;

			// The store method returns the saved object ID.
			$id = R::store($url);
		}

		return $id;
	}
}
