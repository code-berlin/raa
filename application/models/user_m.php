<?php
class User_m extends RedBean_SimpleModel {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/user_dao');
	}

	public function get_by_username($username) {
		return $this->user_dao->get_by_username($username);
	}

	public function save($user) {
		return $this->user_dao->save($user);
	}

	public function create() {
		return $this->user_dao->create();
	}

	public function remove($user) {
		return $this->user_dao->remove($user);
	}

}