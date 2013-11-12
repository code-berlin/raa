<?php

	/**
	* 
	*/
	class Admin_m extends CI_Model
	{

		function __construct()
		{
			parent::__construct();
			$this->load->library('rb');
		}

		public function verify_user($username, $password)
		{	

			$get_user = R::findOne('user', 'username = :username and password = :password', array(':username' => $username,':password' => sha1($password)));

			if ($get_user !== null)
			{
				return $get_user;
			}
			return false;

		}
	}

?>