<?php
/**
 * DAO for settings
 *
 */
class Settings_dao extends CI_Model{

    public function __construct(){
        parent::__construct();

        $this->load->library('rb');

        $this->object = new stdClass();
    }

    public function get_settings(){
        $settings_bean = R::findOne('settings', 'id > :id',
            array(':id' => '0'));

        if ($settings_bean == null){
            R::dispense('settings');
        }

        return $settings_bean;
    }

    public function get_blog_title(){
        $settings_bean = $this->get_settings();
        return $settings_bean->blog_title;
    }

    public function get_email(){
        $settings_bean = $this->get_settings();
        return $settings_bean->email;
    }

    public function get_seo(){
        $settings_bean = $this->get_settings();
        return $settings_bean->seo;
    }

    public function get_keywords(){
        $settings_bean = $this->get_settings();
        return $settings_bean->keywords;
    }
}