<?php
/**
 * DAO for settings
 *
 */
class Settings_dao extends CI_Model{
    private $settings_bean;

    public function __construct(){
        parent::__construct();

        $this->load->library('rb');

        $this->settings_bean = $this->get_settings();
    }

    public function get_settings(){
        $settings_bean = R::findOne('settings', 'id > :id', array(':id' => '0'));

        if ($settings_bean == null){
            R::dispense('settings');
        }

        return $settings_bean;
    }

    public function get_email(){
        return $this->settings_bean->email;
    }

    public function get_homepage(){
        if (!$this->settings_bean) {
            return false; // There's no homepage yet (migration was not ran, database is empty)
        }
        return $this->settings_bean->page_id;
    }

    public function get_seo_meta_title(){
        return $this->settings_bean->seo_meta_title;
    }

    public function get_seo_meta_keywords(){
        return $this->settings_bean->seo_meta_keywords;
    }

    public function get_seo_meta_description(){
        return $this->settings_bean->seo_meta_description;
    }

    public function get_seo_footer_text(){
        return $this->settings_bean->seo_footer_text;
    }
}