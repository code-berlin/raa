<?php
require_once(APPPATH . 'controllers/test/Toast.php');

class Basic_tests extends Toast
{
    public $minimal_db_version = 0;
    function Basic_tests() {
        parent::Toast(__FILE__);
    }

    function _pre() {
        $this->load->model('type_m');
    }

    function _post() {

    }


    function test_check_database_version() {
        $this->config->load('migration');
        $latest_version = $this->config->item('migration_version');
        $this->_assert_true($latest_version >= $this->minimal_db_version);
    }

}