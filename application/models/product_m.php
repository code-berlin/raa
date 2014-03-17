<?php
class Product_m extends RedBean_SimpleModel {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/product_dao');
	}

	public function get_all() {
		return $this->product_dao->get_all();
	}


	public function get_by_id($id) {
		return $this->product_dao->get_by_id($id);
	}


	function get_by_slug($slug) {
		return $this->product_dao->get_by_slug($slug);
	}
}