<?php
class Facebook_app_m extends RedBean_SimpleModel {
	function __construct() {
		parent::__construct();

		$this->load->model('dao/facebook_app_dao');
	}
}