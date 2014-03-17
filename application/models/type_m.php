<?php
class Type_m extends RedBean_SimpleModel {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/type_dao');
	}

	public function get_by_id($id) {
		return $this->type_dao->get_by_id($id);
	}

	public function get_by_name($name) {
		return $this->type_dao->get_by_name($name);
	}

	public function save($name) {
		return $this->type_dao->save($name);
	}

	/**
	* Save slug on the type / slug relation table.
	*/
	public function save_slug($type_name, $slug, $page_id) {
		return $this->type_dao->save_slug($type_name, $slug, $page_id);
	}

	public function delete($id) {
		return $this->type_dao->delete($id);
	}
}