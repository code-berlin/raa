<?php
/**
 * DAO for type
 *
 */
class Type_dao extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->load->library('rb');
	}

	public function get_by_id($id) {
		return R::load('type', $id);
	}

	public function get_by_name($name) {
		return R::findOne('type',
			'name = :name',
			array(':name' => $name)
		);
	}

	public function save($name) {
		$type= R::dispense('type');
		$type->name = $name;

		return R::store($type);
	}

	public function save_slug($type_name, $slug, $page_id) {
		$id = 0;
		$type = $this->get_by_name($type_name);

		if (!empty($type)) {
			$this->load->model('url_m');

			// Update current page slug reference
			if ($page_id > 0) {
				$this->load->model('page_m');

				$page = $this->page_m->get_by_id($page_id);
				$url = $this->url_m->get_by_slug($page->slug);

				if ($url != NULL) {
					$url->slug = $slug;
					$this->url_m->save($url);
				}
			} else {
				$url = $this->url_m->create();
				$url->type_id = $type->id;
				$url->slug = $slug;

				$id = $this->url_m->save($url);
			}
		} else {
			if ($this->save($type_name) > 0) {
				$this->save_slug($type_name, $slug);
				die;
			}
		}

		return $id;
	}

	public function delete($id) {
		$type = $this->get_by_id($id);

		return R::trash($type);
	}
}
