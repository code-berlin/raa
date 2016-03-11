<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Language {

	var $ci;

	function __construct() {
		$this->ci = &get_instance();
    }

    function test() {
    	//$crud = new grocery_CRUD();

    	//$crud = grocery_crud_categories($this->ci->grocery_crud, $config);
    	//$crud->set_table('page');
    	//var_dump('lang test');
    }
    
}