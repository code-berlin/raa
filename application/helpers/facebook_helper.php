<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function facebook_user_logged_in(){
    $CI =& get_instance();

    return $CI->session->userdata('facebook_user');
}

?>