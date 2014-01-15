<?php
class Facebook_app_m extends CI_Model {
	function __construct() {
		parent::__construct();

		$this->load->model('dao/facebook_app_dao');
	}
}