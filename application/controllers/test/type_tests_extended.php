<?php
require_once(APPPATH . 'controllers/test/Toast.php');
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Type_tests_extended extends Basic_tests
{
    function Type_tests() {
        parent::Toast(__FILE__);
        $this->minimal_db_version = 12;
    }

    function _pre() {
    }

    function _post() {
    }

    function test_type_table_correlations(){
        $this->load->library('rb');
        $types = R::findAll('type',
            ' ORDER BY id ');

        foreach ( $types as $type ) {
            $this->_assert_true($this->db->table_exists($type->name));
        }
    }

}