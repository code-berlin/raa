<?php

	Class rb_loader {
	
		public function __construct() {

			require_once(APPPATH.'/third_party/rb/rb.php');
			$this->CI =& get_instance();
			$db_details = array(
                'dsn' => 'mysql:host='.$this->CI->db->hostname.';dbname='.$this->CI->db->database,
				'user' => $this->CI->db->username,
				'password' => $this->CI->db->password
			);




			R::setup($db_details['dsn'],$db_details['user'],$db_details['password']);
            if ($handle = opendir(APPPATH.'/models')) {
                while (false !== ($entry = readdir($handle))) {
                    if (strpos($entry,'.php') !== false)
                        require_once(APPPATH.'/models/'.$entry);
                }
            }

            R::freeze(true);
		}
		
		public function reload_connection(){
			
			$this->CI =& get_instance();
			$db_details = array(
                'dsn' => 'mysql:host='.$this->CI->db->hostname.';dbname='.$this->CI->db->database,
				'user' => $this->CI->db->username,
				'password' => $this->CI->db->password
			);
			
			R::addDatabase('test',$db_details['dsn'],$db_details['user'],$db_details['password'],true);
			R::selectDatabase('test');
		}
		
	}