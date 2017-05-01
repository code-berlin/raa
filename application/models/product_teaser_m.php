<?php
require_once(APPPATH . 'models/dao/db_dao.php');

class Product_teaser_m extends CI_Model {
	
	function __construct() {
        parent::__construct();

  		$this->load->model('dao/product_teaser_dao');
   	}

	function get_by_id($id) {
    	return $this->product_teaser_dao->get_by_id($id);
	}

	function get_by_ids($ids) {
    	return $this->product_teaser_dao->get_by_ids($ids);
	}

}