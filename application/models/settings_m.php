<?php
class Settings_m extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->model('dao/settings_dao');
    }


    public function get_settings(){
        return $this->settings_dao->get_settings();
    }

    public function get_blog_title(){
        return $this->settings_dao->get_blog_title();
    }

    public function get_email(){
        return $this->settings_dao->get_email();
    }

    public function get_seo(){
        return $this->settings_dao->get_seo();
    }

    public function get_keywords(){
        return $this->settings_dao->get_keywords();
    }

}