<?php
class Url_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('rb');
	}

	public function get_all() {
		return R::find('page');
	}

	public function get_by_slug($slug) {
		$urls = R::findOne('url', 'slug = :slug',
			array(':slug' => $slug));

		R::preload($urls, array('type')); // Related types

		return $urls;
	}

    /**
    * Save slug on the type / slug relation table.
    */
	public function save_slug($type_name, $slug) {
		$this->load->model('type_m');

		$url= R::dispense('url');
		$url->type_id = $this->type_m->get_by_name($type_name)->id;
		$url->slug = $slug;
		$id = R::store($url);
	}

    /**
    * Creates a slug from a url. We only accept dashes (-).
    */
	public function sluggify($url) {
		return preg_replace('/[^a-z0-9\-]/', '-', strtolower($url));
	}

}