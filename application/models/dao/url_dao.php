<?php
require_once(APPPATH . 'models/dao/db_dao.php');

/**
 * DAO for URLs
 *
 */
class Url_dao extends DB_dao {

	public function __construct(){
		parent::__construct('url');
	}

	public function get_by_slug($slug) {

		$url = R::findOne($this->table, 'slug = :slug',
			array(':slug' => $slug));

		if (!empty($url)) {
			R::preload($url, array('type')); // Related types
		}

		return $url;
	}
}
