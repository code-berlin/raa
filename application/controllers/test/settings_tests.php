<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Settings_tests extends Toast
{

    var $delete_settings = true;
    var $settings = null;
    function Settings_tests()
    {
        parent::Toast(__FILE__);
        // Load any models, libraries etc. you need here
        $this->load->model('settings_m');
        $this->load->library('rb');
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


    function test_get_settings()
    {
        $settings = $this->settings;
        $result = $this->settings_m->get_settings();
        $this->_assert_equals($settings->blog_title,$result->blog_title);
        $this->_assert_equals($settings->email,$result->email);
        $this->_assert_equals($settings->seo,$result->seo);
        $this->_assert_equals($settings->keywords,$result->keywords);


    }

    function test_get_blog_title(){
        $settings = $this->settings;
        $result = $this->settings_m->get_blog_title();
        $this->_assert_equals($settings->blog_title, $result);

    }

    function test_get_email(){
        $settings = $this->settings;
        $result = $this->settings_m->get_email();
        $this->_assert_equals($settings->email, $result);

    }

    function test_get_seo(){
        $settings = $this->settings;
        $result = $this->settings_m->get_seo();
        $this->_assert_equals($settings->seo, $result);

    }

    function test_get_keywords(){
        $settings = $this->settings;
        $result = $this->settings_m->get_keywords();
        $this->_assert_equals($settings->keywords, $result);
    }

    private function add_settings_fields(){

        $settings = R::dispense('settings');
        $settings->blog_title = "test_title";
        $settings->email = "test@settings.org";
        $settings->seo = "seo_tests";
        $settings->keywords = "i'm keywords";

        $id = R::store($settings);
        return $settings;
    }
}