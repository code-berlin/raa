<?php
class Teaser_m extends CI_Model {

	function __construct() {
        parent::__construct();

        $this->load->model('dao/teaser_types_dao');
        $this->load->model('dao/teaser_instance_dao');
        $this->load->model('dao/teaser_item_dao');
    }

    function get_all_teaser_types() {
    	return $this->teaser_types_dao->get_all();
    }

    function get_teaser_type_by_id($id) {
    	return $this->teaser_types_dao->get_by_id($id);
    }

    function get_teaser_instance_by_id($id) {
    	return $this->teaser_instance_dao->get_by_id($id);
    }

    function get_teaser_items_by_teaser_instance_id($teaser_instance_id) {
    	return $this->teaser_item_dao->get_by_teaser_instance_id($teaser_instance_id);
    }

    function count_teaser_items($teaser_instance_id) {
    	return $this->teaser_item_dao->count_by_teaser_instance_id($teaser_instance_id);
    }

    function get_teaser_instance_by_page_id($page_id) {
    	return $this->teaser_instance_dao->get_by_page_id($page_id);
    }

}