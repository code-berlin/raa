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

	function get_children_ordered_by_menu_title($page_id) {
		return $this->page_dao->get_children_ordered_by_menu_title($page_id);
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

    function get_sidebar_teaser() {
		return $this->page_dao->get_sidebar_teaser();
    }

    function get_sidebar_teaser_alt() {
		return $this->page_dao->get_sidebar_teaser_alt();
    }

    function get_grouped_articles($page_id, $include_actualpage = false, $order = 'default'){
    	return $this->page_dao->get_grouped_articles($page_id, $include_actualpage, $order);
    }

    function get_top_articles($page_id){
    	return $this->page_dao->get_top_articles($page_id);
    }

    function get_ungrouped_articles() {
        return $this->page_dao->get_ungrouped_articles();
    }

    function get_ungrouped_articles_and_selected_article($articlegroupitem_id) {
        return $this->page_dao->get_ungrouped_articles_and_selected_article($articlegroupitem_id);
    }

    function get_articlegroupitem($page_id){
        return $this->page_dao->get_articlegroupitem($page_id);
    }

    function get_latest_article_by_parent($page_id, $limit = 10) {
        return $this->page_dao->get_latest_article_by_parent($page_id, $limit);
    }

    function get_latest_article($limit = 10) {
        return $this->page_dao->get_latest_article($limit);
    }


}