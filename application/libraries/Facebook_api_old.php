<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH.'libraries/facebook/facebook.php');

class Facebook_api {
	private $facebook;
	private $facebook_config;
	private $ci;
	private $user;
	private $user_pages;

	public function __construct(){
		$this->ci =& get_instance();

		$this->facebook_config = $this->ci->config->item('fb_config');
		$this->facebook = new Facebook($this->facebook_config);

		$this->user = 0;

		$this->user_pages = array();
	}

 	/*
	* makes a post call to the Facebook API in order to retrive the
	* current user information
	* @params String - if @params="/friends", the API returns the user's
	* list of friends
	*/
  	public function fb_retrieve_user($params='', $friend=false, $id_friend=0){
  		$params = '?access_token='.$this->facebook->getAccessToken();

		try {
			$user = ($friend) ? $this->facebook->api("/".$id_friend.$params) : $this->facebook->api("/me".$params);
		} catch (FacebookApiException $e) {
    		error_log($e);
    		return false;
  		}

  		return $user;
  	}

  	public function fb_me($params=''){
		$this->fb_retrieve_user($params);
  	}

  	public function fb_friend($id_friend,$params=''){
  		$this->fb_retrieve_user($params, true, $id_friend);
  	}

  	/*
	* makes a post call to the Facebook API in order to retrive the friend picture
	* @param String $id_friend
 	*/
  	public function fb_friend_picture($id_friend){
  		$params = '&access_token='.$this->facebook->getAccessToken();

		try {
		$friend_picture = $this->facebook->api("/".$id_friend."?fields=picture".$params);
		} catch (FacebookApiException $e) {
			error_log($e);
			return false;
		}

  		return $friend_picture;
  	}

	/*
	* makes a post call to the Facebook API in order to publish a wall post on the user's page
	*/
  	public function fb_wall_post($user_name){
		try {
    		$parameters = array(
    			'message' => $user_name .' '.$this->ci->config->item('fb_application_message'),
				'caption'=>$this->ci->config->item('fb_application_caption'),
				'link' => $this->ci->config->item('fb_application_tab_url'),
				'picture'=>$this->ci->config->item('fb_application_picture'),
				'access_token'=>$this->facebook->getAccessToken()
			);

 		    $action_id = $this->facebook->api('/me/feed', 'POST', $parameters);

			return $action_id;
		} catch (FacebookApiException $e) {
	    	error_log($e);
	    	return false;
		}
  	}

	/*
	* makes a post call to the Facebook API in order to publish a wall post on the user's page
	*/
  	public function fb_wall_post_custom_message($user_name, $message){
		try {
    		$parameters = array(
    			'message' => $user_name .' '.$message,
				'caption'=>$this->ci->config->item('fb_application_caption'),
				'link' => $this->ci->config->item('fb_application_tab_url'),
				'picture'=>$this->ci->config->item('fb_application_picture'),
				'access_token'=>$this->facebook->getAccessToken()
			);

 		    $action_id = $this->facebook->api('/me/feed', 'POST', $parameters);

			return $action_id;
		} catch (FacebookApiException $e) {
	    	error_log($e);
	    	return false;
		}
  	}

  	/*
	* makes a post call to the Facebook API in order to publish an action on the user's timeline
	*/
  	public function fb_action_post($message){
		try {
			$parameters = array(
				$this->ci->config->item('fb_application_opengraph_object') => $this->ci->config->item('fb_application_opengraph_page'),
				'message'=>$message,
				'access_token' => $this->facebook->getAccessToken()
			);

 		    $action_id = $this->facebook->api('/me/'.$this->ci->config->item('fb_application_namespace').':'.$this->ci->config->item('fb_application_opengraph_action'), 'POST', $parameters);

    		return $action_id;
		} catch (FacebookApiException $e) {
	    	error_log($e);
	    	return false;
		}
  	}

	/*
	* makes a post call to the Facebook API in order to publish a wall post on the user's page
	*/
  	public function fb_delete($action_id){
		try {
    		$op_status = $this->facebook->api('/'.$action_id, 'DELETE');
			return $op_status;
		} catch (FacebookApiException $e) {
	    	error_log($e);
	    	return false;
		}
  	}

	/*
	* returns a json encoded array with the facebook signed request parameters
	* @param array $signed_request - facebook signed request
	* @param String $secret - application secret code
	* @return array
	*/
	public function parse_signed_request() {
		return $this->facebook->getSignedRequest();
	}

	/*
	* creates the oauth url, or link to the facebook authorization dialog
	* @return String
	*/
	public function create_oauth_url() {
		//$this->ci->session->set_userdata('state', md5(uniqid(rand(), TRUE)));
		//$this->ci->session->set_userdata('auth_nonce', md5(uniqid(rand(), TRUE)));

		$oauth_url = 'https://www.facebook.com/dialog/oauth/';
		$oauth_url .= '?client_id='.$this->facebook_config['appId'];
		$oauth_url .= '&redirect_uri=http://dev21.raa.code-b-development.com/admin/facebook_app';
		$oauth_url .= '&scope=email,publish_stream,read_stream,publish_actions';
		//$oauth_url .= '&auth_type=https';
		//$oauth_url .= '&auth_nonce='.$this->ci->session->userdata('auth_nonce');
		//$oauth_url .= '&state='.$this->ci->session->userdata('state');

		return $oauth_url;
	}

	/*
	* check if the user is currently logged within the application session
	* @return array
	*/
	public function check_credentials(){
		$user_info = false;
		$is_user_logged = $this->facebook->getUser();

		if (isset($is_user_logged) && $is_user_logged !== 0){
			$user_info = $this->fb_me('?fields=id,name,first_name,last_name,email');
		}

		if (!$user_info) {
			//log_message('error', 'API COMMUNICATION ERROR');
			//$this->ci->config->item('fb_api_connection_error_message');
			echo("<script> top.location.href='".$this->create_oauth_url()."'; </script>");

			return false;
		}

		return $user_info;
	}


    /****************************************************************
    *                                                               *
    *                                                               *
    *                                                               *
    *                       FACEBOOK PAGES                          *
    *                                                               *
    *                                                               *
    *                                                               *
    ****************************************************************/

	/*
	* Updates Facebook config values
	*
	* @param
	* @return
	*/
	public function update_facebook_config($data=array()) {
		foreach($data as $key => $value) {
			$this->facebook_config[$key] = $value;
		}
	}

	public function update_facebook_object() {
		$this->facebook = new Facebook($this->facebook_config);
	}

	/*
	* Sets Facebook user
	*/
	public function set_facebook_user() {
		$this->user = $this->facebook->getUser();
	}

	/*
	* Retrieves Facebook user
	*/
	public function get_facebook_user() {
		return $this->user;
	}

	/*
	* Checks Facebook user
	*
	* @return facebook user id (0 if it's no authenticated)
	*/
	public function check_facebook_user() {
		$this->set_facebook_user();
		return $this->get_facebook_user();
	}

	/*
	* Retrieves Facebook config
	*/
	public function get_facebook_config() {
		return $this->facebook_config;
	}

	/*
	* Retrieves user access token
	*
	*/
	public function get_access_token() {
		echo $this->facebook->getAccessToken();
	}

	/*
	* Retrieves URL for user login/logout
	*
	* @param $user id of the user
	*
	* @return url for user authentication
	*/
	public function get_status_url($user) {
		if ($user) {
			$url = $this->facebook->getLogoutUrl();
		} else {
			// Login url with page's permissions
			$url = $this->facebook->getLoginUrl(array('scope'=>'manage_pages,publish_stream'));
		}

		return $url;
	}

	/*
	* Loads user pages
	*
	* Saves user/app pages in an array
	*/
	public function load_user_pages() {
		$accounts = $this->facebook->api('/me/accounts');

		foreach($accounts as $account) {
			foreach($account as $item) {
				if (isset($item['id'])) {
					if (isset($item['access_token'])) {
						$this->user_pages[$item['id']]['access_token'] = $item['access_token'];
					}

					if (isset($item['name'])) {
						$this->user_pages[$item['id']]['name'] = $item['name'];
					}
				}
			}
		}

		echo '<pre>';
		var_dump($accounts);
		echo '</pre>';
	}

	/*
	* Retrieves user/app pages
	*
	* @return array user pages
	*/
	public function get_user_pages() {
		return $this->user_pages;
	}

	/*
	* Posts message on Facebook page
	*
	* @param $page_id id of the Facebook page
	* @param $message message to be posted
	* @param $access_token token for posting on Facebook
	*
	* @return post id
	*/
	public function post_on_page($page_id, $message, $access_token) {
        return $this->facebook->api('/'.$page_id.'/feed', 'post', array(
            'access_token'  => $access_token,
            'message'       => $message
        ));
	}
}