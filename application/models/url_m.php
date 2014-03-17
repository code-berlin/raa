<?php
class Url_m extends RedBean_SimpleModel {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/url_dao');
	}

	public function get_by_id($id) {
		return $this->url_dao->get_by_id($id);
	}

	public function get_all() {
		return $this->url_dao->get_all();
	}

	public function get_by_slug($slug) {
		return $this->url_dao->get_by_slug($slug);
	}

	public function save($url) {
		return $this->url_dao->save($url);
	}

	public function create() {
		return $this->url_dao->create();
	}

	public function remove($url) {
		return $this->url_dao->remove($url);
	}

	/**
	* Creates a slug from a url. We only accept dashes (-).
	*/
	public function sluggify($url) {
		return preg_replace('/[^a-z0-9\-]/', '-', strtolower($url));
	}
}