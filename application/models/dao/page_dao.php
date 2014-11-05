<?php
/**
 * DAO for pages
 *
 */
class Page_dao extends CI_Model{

	public function __construct(){
	    parent::__construct();

		$this->load->library('rb');

		$this->table = 'page';

		$this->object = new stdClass();
	}

	public function get_all() {
		$this->object = R::find($this->table);

		$this->preload_template();

		return $this->object;
	}

	public function get_by_id($id) {
		$this->object = R::load($this->table, $id);

		$this->preload_template();

		return $this->object;
	}

	public function get_by_slug($slug) {
		$this->object = R::findOne($this->table, 'slug = :slug',
			array(':slug' => $slug));

		$this->preload_template();

		return $this->object;
	}

	public function preload_template() {
		if (!empty($this->object)) {
			R::preload($this->object, array('template')); // Related types
		}
	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($page) {
		return R::store($page);
	}

	public function delete($page) {
		return R::trash($page);
	}

	public function get_all_subpages_ordered_by_menu_order() {
        return R::getAll('SELECT menu_title, slug, id, main_category FROM '.$this->table.' WHERE (parent_id IS NULL OR parent_id = 0) AND published = 1 AND (menu_title != "") ORDER BY menu_order ASC');
    }

    public function get_children($page_id) {
        return R::getAll('SELECT menu_title, slug, id FROM '.$this->table.' WHERE parent_id = '.$page_id.' AND published = 1 ORDER BY menu_order ASC');
    }
}
