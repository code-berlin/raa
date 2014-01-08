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

			$user = R::findOne('user', 'username = :username and password = :password', array(':username' => $username,':password' => $this->encrypt->sha1($password)));

			//check if the user authentication passed and the user is not disabled
			if ($user !== null)
			{
				return $user;
			}
			
			return false;

		}

		public function is_disabled($username)
		{
			$user = R::findOne('user', 'username = :username', array(':username' => $username));
			$status = intval($user->disabled);
			
			if($status != 0) {
				return true;
			}

			return false;
		}
	}

?>