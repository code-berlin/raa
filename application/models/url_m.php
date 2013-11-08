<?php
class Url_m extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('rb');
	}

	function get_all() {
		return R::find('page');
	}

	function get_by_slug($slug) {
		$results = array();
		$tables = array('url', 'type');

		$condition = 'slug = :slug';
		$rules = array(':slug' => $slug);

		$url = R::findOne($tables[0], $condition, $rules);
		$type = R::load($tables[1], $url->id_type);

		$results['type_name'] = $type->name;
		$results['slug'] = $slug;

		return $results;
	}
}