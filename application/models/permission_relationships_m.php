<?php
class Permission_relationships_m extends CI_Model {

	function __construct($type)
	{
		parent::__construct();

		$this->type = $type;

		switch ($this->type) {
			case 'role':
				$this->load->model('dao/role_permission_dao');
				$this->model = $this->role_permission_dao;
				break;
			case 'section':
				$this->load->model('dao/section_permission_dao');
				$this->model = $this->section_permission_dao;
				break;
		}

		$this->load->model('permission_m');
	}

	function create() {
		return $this->model->create();
	}

	function get_by_id($id) {
		return $this->model->get_by_id($id);
	}

	function get_by($field, $value) {
		return $this->model->get_by($field, $id);
	}

	function get_by_type($relationship_id) {
		return $this->model->get_all_by($this->type.'_id', $relationship_id);
	}

	function get_by_relationship($relationship_id, $permission_id) {
		return $this->model->get_by_relationship($relationship_id, $permission_id);
	}

	function get_permissions($relationship_id) {
		return $this->model->get_all_by($this->type.'_id', $relationship_id);
	}

	function save($object) {
		return $this->model->save($object);
	}

	function remove($object) {
		return $this->model->remove($object);
	}

	function check_combination_exists($relationship_id, $permission_id) {
		$relationships = $this->model->get_all_by($this->type.'_id', $relationship_id);

		if (!empty($relationships)) {
			foreach($relationships as $relationship) {
				if ($relationship->permission_id == $permission_id) {
					return true;
				}
			}
		}

		return false;
	}

	function create_relationship($relationship_id, $permission_id) {
		$relationship = $this->create();
		switch ($this->type) {
			case 'role':
				$relationship->role_id = $relationship_id;
				break;
			case 'section':
				$relationship->section_id = $relationship_id;
				break;
		}
		$relationship->permission_id = $permission_id;
		return $this->save($relationship);
	}

	function clear_relationships($relationship_id) {
		$relationships = $this->get_by_type($relationship_id);

		foreach ($relationships as $relationship) {
			$this->remove($relationship);
		}
	}

	function get_relationships_list($relationship_id) {
        $relationships = $this->get_by_type($relationship_id);

        $permission_ids = array();

        foreach ($relationships as $relationship) {
            array_push($permission_ids, $relationship->permission_id);
        }

        return $permission_ids;
	}
}