<?php
class Menu_m extends DB_dao {

	function __construct()
	{
		parent::__construct(NULL);
        $CI = & get_instance();
        $CI->load->model('dao/menu_dao');
	}

	public function get_by_id($id) {
		return $this->menu_dao->get_by_id($id);
	}
}