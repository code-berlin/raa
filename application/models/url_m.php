<?php
class Url_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/url_dao');
	}

	public function get_all() {
		return $this->url_dao->get_all();
	}

	public function get_by_slug($slug) {
		return $this->url_dao->get_by_slug($slug);
	}

	/**
	* Save slug on the type / slug relation table.
	*/
	public function save_slug($type_name, $slug) {
		return $this->url_dao->save_slug($type_name, $slug);
	}

    /**
    * Creates a slug from a url. We only accept dashes (-).
    */
	public function sluggify($url) {
		return preg_replace('/[^a-z0-9\-]/', '-', strtolower($url));
	}
}