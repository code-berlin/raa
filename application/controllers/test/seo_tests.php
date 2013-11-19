<?php
require_once(APPPATH . 'controllers/test/Toast.php');
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Seo_tests extends Basic_tests
{

    var $delete_settings = true;
    var $settings = null;
    function Seo_tests()
    {
        parent::Toast(__FILE__);
        // Load any models, libraries etc. you need here
        $this->load->model('settings_m');
        $this->load->library('rb');
        $this->minimal_db_version =16;
    }

    /**
     * OPTIONAL; Anything in this function will be run before each test
     * Good for doing cleanup: resetting sessions, renewing objects, etc.
     */
    function _pre() {
        $this->delete_settings = true;
        $this->settings = null;
        if (R::count('settings') > 0){
            $this->settings = R::findOne('settings', 'id > :id',
                array(':id' => '0'));
            $this->delete_settings = false;
        }else{
            $this->settings = $this->add_settings_fields();
        }
    }

    /**
     * OPTIONAL; Anything in this function will be run after each test
     * I use it for setting $this->message = $this->My_model->getError();
     */
    function _post() {
        if ($this->delete_settings){
            R::trash($this->settings);
        }
    }


    function test_load_seo_information()
    {
        $settings = $this->settings;
        
        $home_page_meta_information = $this->layout->_load_seo_information(); // loading the settings of the homepage
        $this->_assert_equals($home_page_meta_information['seo_meta_title'], $settings->seo_meta_title);
        $this->_assert_equals($home_page_meta_information['seo_meta_keywords'], $settings->seo_meta_keywords);
        $this->_assert_equals($home_page_meta_information['seo_meta_description'], $settings->seo_meta_description);
        $this->_assert_equals($home_page_meta_information['seo_footer_text'], $settings->seo_footer_text);
    }
 
    private function add_settings_fields(){

        $settings = R::dispense('settings');
        $settings->blog_title = "test_title";
        $settings->email = "test@settings.org";
        $settings->seo_meta_title = "seo_meta_title";
        $settings->seo_meta_keywords = "seo_meta_keywords";
        $settings->get_seo_meta_description = "seo_meta_descriptino";
        $settings->seo_footer_text = "seo_footer_text";
        $id = R::store($settings);
        return $settings;
    }
}