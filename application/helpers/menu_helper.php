<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

    function load_menus() {

        $ci =& get_instance();

        $ci->load->model('menu_m');
        $ci->load->model('menu_item_m');

        $data = '';

        $data['menus'] = $ci->menu_m->get_all();

        $data['menu'] = array();
        $data['menu']['current_page'] = $ci->uri->segment(1);

        foreach ($data['menus'] as $key => $value) {

            $submenu = $ci->menu_item_m->get_menu_items_by_menu_id_and_parent_id($value['id'], '');

            foreach ($submenu as $k => $v) {
                $data['menu'][$value['name']][$k]['slug'] = $v['slug'];
                $data['menu'][$value['name']][$k]['menu_title'] = $v['menu_title'];
                $data['menu'][$value['name']][$k]['parent_slug'] = $v['parent_slug'];
                $data['menu'][$value['name']][$k]['children'] = $ci->menu_item_m->get_menu_items_by_menu_id_and_parent_id($value['id'], $v['id']);
                $data['menu'][$value['name']][$k]['jumpmark'] = $v['jumpmark'];
            }

        }

        return $data['menu'];

    }


?>