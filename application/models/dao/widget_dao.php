<?php
/**
 * DAO for widgets
 *
 */
class Widget_dao extends CI_Model{

	public function __construct(){
	    parent::__construct();

		$this->load->library('rb');
	}

	public function get_all() {
		return R::find('widget');
	}

	public function get_by_id($id) {
		return R::load('widget', $id);
	}

}
