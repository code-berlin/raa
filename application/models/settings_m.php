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

    public function get_homepage(){
        return $this->settings_dao->get_homepage();
    }

    public function get_seo_meta_title(){
        return $this->settings_dao->get_seo_meta_title();
    }

    public function get_seo_meta_keywords(){
        return $this->settings_dao->get_seo_meta_keywords();
    }

    public function get_seo_meta_description(){
        return $this->settings_dao->get_seo_meta_description();
    }

    public function get_seo_footer_text(){
        return $this->settings_dao->get_seo_footer_text();
    }
}