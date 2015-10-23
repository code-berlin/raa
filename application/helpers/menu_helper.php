<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

	// Default 2-level navigation based on the pages created in the backend
    function show_main_menu() {

        $ci =& get_instance();
        
        $data = load_main_menu();

        $ci->load->view('main_menu', $data);

    }

    // Default 2-level navigation based on the pages created in the backend
    function load_main_menu() {

        $ci =& get_instance();
        $ci->load->model('page_m');

        $menu_items = $ci->page_m->get_all_subpages_ordered_by_menu_order();

        $data['current_page'] = $ci->uri->segment(1);
        $data['url']  = $_SERVER['REQUEST_URI'];
        $data['menu_items'] = $menu_items;

        foreach ($menu_items as $key => $item) {
            $data['menu_items'][$key]['children'] = $ci->page_m->get_children($item['id']);
        }

        return $data;

    }

    // Old function based on the idea of creating custom templates for menus
    function load_menu($id_menu, $menu_template) {
        $CI =& get_instance();
        $CI->load->model('menu_item_m');

        $menu_items = $CI->menu_item_m->get_by_menu_id($id_menu);
        
        // check if the menu to be loaded has 'published' field set to 1 or 0
        $menu_state = $CI->menu_item_m->check_if_published($id_menu);

        if($menu_items && $menu_state){
            foreach ($menu_items as $menu_item) {
                if (check_if_menu_item_published($menu_item->url_id))
                {
                    $published_items[] = $menu_item;
                }
            }

            if (!empty($published_items) && isset($published_items))
            {
                $data['items'] = $published_items;
                $CI->load->view('menu_templates/'.$menu_template, $data);
            }

        }
    }

 
?>