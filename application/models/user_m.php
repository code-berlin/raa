<?php
class User_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/user_dao');
	}

	public function get_by_username($username) {
		return $this->user_dao->get_by_username($username);
	}

	public function save($url) {
		return $this->user_dao->save($url);
	}

	public function create() {
		return $this->user_dao->create();
	}

	public function remove($url) {
		return $this->user_dao->remove($url);
	}

}