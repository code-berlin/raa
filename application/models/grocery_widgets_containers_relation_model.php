<?php
require_once(APPPATH . 'models/grocery_crud_model.php');
class Grocery_widgets_containers_relation_model extends grocery_CRUD_Model {
    public function get_all_by_widgets_container_id($id) {
        $this->load->model('widgets_containers_m');

        return $this->widgets_containers_m->get_all_by_widgets_container_id($id);
    }
}