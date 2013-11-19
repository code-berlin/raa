<?php
require_once(APPPATH . 'controllers/test/Toast.php');
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Seo_tests extends Basic_tests
{

    var $delete_settings = true;
    var $delete_page_with_seo = true;    
    var $delete_page_with_some_seo = true;  
    var $delete_page_with_no_seo = true;    

    var $settings = null;
    function Seo_tests()
    {
        parent::Toast(__FILE__);
        // Load any models, libraries etc. you need here
        $this->load->model('settings_m');
        $this->load->model('page_m');
        $this->load->library('rb');

        $this->slug_seo = 'test-page-with-seo-23179213879123';
        $this->page_with_seo = new stdClass();

        $this->slug_no_seo = 'test-page-with-no-seo-98732478432';
        $this->page_with_no_seo = new stdClass();

        $this->slug_some_seo = 'test-page-with-some-seo-129837213';
        $this->page_with_some_seo = new stdClass();


        $this->minimal_db_version =17;
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

        // creating the page with seo information
        $this->page_with_seo = $this->add_page_seo_fields();

        // creating the page with no seo information
        $this->page_with_no_seo = $this->add_page_no_seo_fields();

        // creating the page with some seo information
        $this->page_with_some_seo = $this->add_page_some_seo_fields();        
    }

    /**
     * OPTIONAL; Anything in this function will be run after each test
     * I use it for setting $this->message = $this->My_model->getError();
     */
    function _post() {
        if ($this->delete_settings){
            R::trash($this->settings);
        }
        if ($this->delete_page_with_seo){
            R::trash($this->page_with_seo);
        }
        if ($this->delete_page_with_no_seo){
            R::trash($this->page_with_no_seo);
        }
        if ($this->delete_page_with_some_seo){
            R::trash($this->page_with_some_seo);
        }        
    }


    function test_check_current_seo_settings()
    {
        $page_m = $this->page_m;
        
        $page_with_seo = $page_m->get_by_slug($this->slug_seo);
        $page_with_no_seo = $page_m->get_by_slug($this->slug_no_seo);
        $page_with_some_seo = $page_m->get_by_slug($this->slug_some_seo); 

        $this->_assert_equals($this->layout->_check_current_seo_settings($page_with_seo), 2);
        $this->_assert_equals($this->layout->_check_current_seo_settings($page_with_some_seo), 1);
        $this->_assert_equals($this->layout->_check_current_seo_settings($page_with_no_seo), 0);

    }


    function test_load_seo_information()
    {
    
        // testing the general setting seo information for the homepage (a "page" without type and id)
        $settings = $this->settings;
        
        $home_page_meta_information = $this->layout->_load_seo_information(); // loading the settings of the homepage
        $this->_assert_equals($home_page_meta_information['seo_meta_title'], $settings->seo_meta_title);
        $this->_assert_equals($home_page_meta_information['seo_meta_keywords'], $settings->seo_meta_keywords);
        $this->_assert_equals($home_page_meta_information['seo_meta_description'], $settings->seo_meta_description);
        $this->_assert_equals($home_page_meta_information['seo_footer_text'], $settings->seo_footer_text);


        // testing the seo information for a page which has specific seo information (all set)
        $page_m = $this->page_m;
        $page_with_seo = $page_m->get_by_slug($this->slug_seo);
        $page_with_seo_meta_information = $this->layout->_load_seo_information(array(), 'page', $page_with_seo->id);

        $this->_assert_equals($page_with_seo_meta_information['seo_meta_title'], $page_with_seo->seo_meta_title);
        $this->_assert_equals($page_with_seo_meta_information['seo_meta_keywords'], $page_with_seo->seo_meta_keywords);
        $this->_assert_equals($page_with_seo_meta_information['seo_meta_description'], $page_with_seo->seo_meta_description);
        $this->_assert_equals($page_with_seo_meta_information['seo_footer_text'], $page_with_seo->seo_footer_text);


        // testing the seo information for a page which has no specific seo information (none set)
        $page_with_no_seo = $page_m->get_by_slug($this->slug_no_seo);
        $page_with_no_seo_meta_information = $this->layout->_load_seo_information(array(), 'page', $page_with_no_seo->id);

        $this->_assert_equals($page_with_no_seo_meta_information['seo_meta_title'], $settings->seo_meta_title);
        $this->_assert_equals($page_with_no_seo_meta_information['seo_meta_keywords'], $settings->seo_meta_keywords);
        $this->_assert_equals($page_with_no_seo_meta_information['seo_meta_description'], $settings->seo_meta_description);
        $this->_assert_equals($page_with_no_seo_meta_information['seo_footer_text'], $settings->seo_footer_text);


        // testing the seo information for a page which has only some specific seo information (some set)
        $page_with_some_seo = $page_m->get_by_slug($this->slug_some_seo);
        $page_with_some_seo_meta_information = $this->layout->_load_seo_information(array(), 'page', $page_with_some_seo->id);

        $this->_assert_equals($page_with_some_seo_meta_information['seo_meta_title'], $page_with_some_seo->seo_meta_title);
        $this->_assert_equals($page_with_some_seo_meta_information['seo_meta_keywords'], "");
        $this->_assert_equals($page_with_some_seo_meta_information['seo_meta_description'], "");
        $this->_assert_equals($page_with_some_seo_meta_information['seo_footer_text'], $page_with_some_seo->seo_footer_text);        

    }
 


    private function add_settings_fields(){

        $settings = R::dispense('settings');
        $settings->blog_title = "test_title";
        $settings->email = "test@settings.org";
        $settings->seo_meta_title = "seo_meta_title";
        $settings->seo_meta_keywords = "seo_meta_keywords";
        $settings->seo_meta_description = "seo_meta_description";
        $settings->seo_footer_text = "seo_footer_text";
        $id = R::store($settings);
        return $settings;
    }

    private function add_page_seo_fields(){

        $page = R::dispense('page');
        $page->title = "title of a page with seo";
        $page->slug = 'test-page-with-seo-23179213879123';
        $page->seo_meta_title = "page_seo_meta_title";
        $page->seo_meta_keywords = "page_seo_meta_keywords";
        $page->seo_meta_description = "page_seo_meta_description";
        $page->seo_footer_text = "page_seo_footer_text";
        $id = R::store($page);
        return $page;
    }


    private function add_page_no_seo_fields(){

        $page = R::dispense('page');
        $page->title = "title of a page with no seo";
        $page->slug = 'test-page-with-no-seo-98732478432';
        $page->seo_meta_title = "";
        $page->seo_meta_keywords = "";
        $page->seo_meta_description = "";
        $page->seo_footer_text = "";
        $id = R::store($page);
        return $page;
    }    


    private function add_page_some_seo_fields(){

        $page = R::dispense('page');
        $page->title = "title of a page with some seo";
        $page->slug = 'test-page-with-some-seo-129837213';
        $page->seo_meta_title = "meta title";
        $page->seo_meta_keywords = "";
        $page->seo_meta_description = "";
        $page->seo_footer_text = "footer text";
        $id = R::store($page);
        return $page;
    }    
 
}