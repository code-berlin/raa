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

        $teaserItems = $this->teaser_item_dao->get_by_teaser_instance_id($teaser_instance_id);
        $teaserItemsEnriched = array();

        foreach ($teaserItems as $key => $value) {

            $slug = '';

            if ($value['content_type'] == 'external') {
                $target = '_blank';
            } else {
                $target = '_self';
            }

            if (isset($value['external_image'])) {
                $image = $value['external_image'];
            } else {
                $image = $value['page_image'];
            }

            if (isset($value['external_link'])) {
                $slug = $value['external_link'];
            } else if (isset($value['page_slug'])) {
                $slug = base_url((isset($value['parent_slug']) && !empty($value['parent_slug']) ? $value['parent_slug'] . '/' : '') . $value['page_slug']);
            }

            $dateString = date("d.m.Y H:i:s", strtotime($value['page_date']));

            $teaserItemsEnriched[$key] = $value;
            $teaserItemsEnriched[$key]['target'] = $target;
            $teaserItemsEnriched[$key]['image'] = $image;
            $teaserItemsEnriched[$key]['slug'] = $slug;
            $teaserItemsEnriched[$key]['datestring'] = $dateString;

        }

    	return $teaserItemsEnriched;
    }

    function count_teaser_items($teaser_instance_id) {
    	return $this->teaser_item_dao->count_by_teaser_instance_id($teaser_instance_id);
    }

    function get_teaser_instance_by_page_id($page_id) {
    	return $this->teaser_instance_dao->get_by_page_id($page_id);
    }

}