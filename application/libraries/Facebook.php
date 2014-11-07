<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
 
// Autoload the required files
define('FACEBOOK_SDK_V4_SRC_DIR', APPPATH.'libraries/facebook/Facebook/');
require_once(APPPATH.'libraries/facebook/autoload.php');
 
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookJavaScriptLoginHelper;

class Facebook {
  private $ci;
  private $helper;
  private $session;
  private $app_id;
  private $app_secret;
 
  public function __construct() {
    $this->ci =& get_instance();
    $this->app_id = $this->ci->config->item('facebook')['app_id'];
    $this->app_secret = $this->ci->config->item('facebook')['app_secret'];

    // Initialize the SDK
    FacebookSession::setDefaultApplication($this->app_id, $this->app_secret);
 
    // Create the login helper
    $this->helper = new FacebookJavaScriptLoginHelper();

    try {
        $this->session = $this->helper->getSession();
    } catch(FacebookRequestException $ex) {
        // When Facebook returns an error
    } catch(Exception $ex) {
        // When validation fails or other local issues
    }

    if ($this->session) {
      // Logged in
      $this->ci->session->set_userdata('fb_token', $this->session->getToken());
      $this->session = new FacebookSession($this->session->getToken());
      $this->ci->tools->d($this->session->getToken());
      var_dump("logged in");
    } else {
      $this->ci->session->unset_userdata('fb_token');
    }
  }
 
  /**
   * Returns the current user's info as an array.
   */
  public function get_user() {
    if ($this->session) {
      /**
       * Retrieve User’s Profile Information
       */
      // Graph API to request user data
      $request = (new FacebookRequest($this->session, 'GET', '/me'))->execute();
 
      // Get response as an array
      $user = $request->getGraphObject()->asArray();
 
      return $user;
    }
    return false;
  }
}