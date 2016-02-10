<?php
class Template_m extends CI_Model {

	function __construct() {
		parent::__construct();

		$this->load->model('dao/template_dao');
	}

	function get_by_name($name) {
		return $this->template_dao->get_by_name($name);
	}

}