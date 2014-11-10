<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function get_email(){
    $CI =& get_instance();
    $CI->load->model('settings_m');

    return $CI->settings_m->get_email();
}

function get_seo(){
    $CI =& get_instance();
    $CI->load->model('settings_m');

    return $CI->settings_m->get_seo();
}

function get_keywords(){
    $CI =& get_instance();
    $CI->load->model('settings_m');

    return $CI->settings_m->get_keywords();
}

?>