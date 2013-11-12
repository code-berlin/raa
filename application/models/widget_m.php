<?php
class Widget_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/widget_dao');
	}

	function get_all() {
		return $this->widget_dao->get_all();
	}

	function get_by_id($id) {
		return $this->widget_dao->get_by_id($id);
	}

}