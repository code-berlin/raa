<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

	function load_menu($id_menu, $menu_template){
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