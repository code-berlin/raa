<?php
class Theme extends CI_Controller {

	function __construct() {
		parent::__construct();
	}


	function index($method, $data = '') {
		
		if ($this->config->item('theme') != false && 
			file_exists(FCPATH . APPPATH . 'models/themes/' . $this->config->item('theme') . '/' . $this->config->item('theme') . '_m' . EXT)) {
			$this->load->model('themes/' . $this->config->item('theme') . '/' . $this->config->item('theme') .  '_m', 'theme_m');
			if (method_exists($this->theme_m, $method)) {
				return $this->theme_m->$method($data);
			}
		}
	}


}