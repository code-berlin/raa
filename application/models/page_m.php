<?php
class Page_m extends CI_Model {

	function __construct()
	{
		parent::__construct();

		$this->load->model('dao/page_dao');
	}

	function get_all() {
		return $this->page_dao->get_all();
	}

	function get_by_id($id) {
		return $this->page_dao->get_by_id($id);
	}

	function get_by_slug($slug) {
		return $this->page_dao->get_by_slug($slug);
	}

	function get_by_slug_and_template_id($slug, $template_id) {
		return $this->page_dao->get_by_slug_and_template_id($slug, $template_id);
	}

	function create() {
		return $this->page_dao->create();
	}

	function save($page) {
		return $this->page_dao->save($page);
	}

	function delete($page) {
		return $this->page_dao->delete($page);
	}

	function get_random_subpages($count) {
		return $this->page_dao->get_random_subpages($count);
	}

	function get_children($page_id) {
		return $this->page_dao->get_children($page_id);
	}

	function get_parent($page_id) {
		return $this->page_dao->get_parent($page_id);
	}

	function get_siblings($page_id) {
		return $this->page_dao->get_siblings($page_id);
	}

	function get_articles_by_page_id_and_menu_id($page_id, $menu_id) {
		return $this->page_dao->get_articles_by_page_id_and_menu_id($page_id, $menu_id);
    }
    
}