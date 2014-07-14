<?php
class Permission_m extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->model('dao/permission_dao');
    }

    function create() {
        return $this->permission_dao->create();
    }

    function get_all() {
        return $this->permission_dao->get_all();
    }

    function get_by_id($id) {
        return $this->permission_dao->get_by_id($id);
    }

    function get_by_name($name) {
        return $this->permission_dao->get_by('name', $name);
    }

    function save($object) {
        return $this->permission_dao->save($object);
    }

    function remove($object) {
        return $this->permission_dao->remove($object);
    }

    function create_permission($name) {
        $permission = $this->create();
        $permission->name = $name;
        return $this->save($permission);
    }
}