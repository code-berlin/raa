<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

define('FACEBOOK_SDK_V4_SRC_DIR', APPPATH.'libraries/facebook/Facebook/');
require_once(APPPATH.'libraries/facebook/autoload.php');
 
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookJavaScriptLoginHelper;

class Facebook {
  private $ci;
  private $helper;
  private $fb_session;
  private $fb_token;
  private $app_id;
  private $app_secret;
 
  public function __construct() {
    $this->ci =& get_instance();
    
    $this->app_id = $this->ci->config->item('facebook')['app_id'];
    $this->app_secret = $this->ci->config->item('facebook')['app_secret'];
    $this->fb_token = 'fb_token';

    /*
    * Initialize the SDK
    */
    FacebookSession::setDefaultApplication($this->app_id, $this->app_secret);

    /*
    * Get new Facebook session
    */
    if (!isset($this->fb_session)) {
      $this->helper = new FacebookJavaScriptLoginHelper();
      try {
          $this->fb_session = $this->helper->getSession();
      } catch(FacebookRequestException $e) {
          // When Facebook returns an error
          unset($this->fb_session);
      } catch(Exception $e) {
          // When other issues occur
          unset($this->fb_session);
      }
    }

    /*
    * Set or unset Facebook access token in CI session
    */
    if (isset($this->fb_session)) {
      $this->ci->session->set_userdata($this->fb_token, $this->fb_session->getToken());
    } else {
      $this->ci->session->unset_userdata($this->fb_token);
    }
    
  }
  
  /*******************************
  *
  *
  *       API CALLS
  *
  *
  ********************************/

  /*
  * Returns the current user's info as an array
  */
  public function get_user() {
    if (isset($this->fb_session)) {
      // Get user data
      $request = (new FacebookRequest($this->fb_session, 'GET', '/me'))->execute();
      $user = $request->getGraphObject()->asArray();

      return $user;
    }
    return false;
  }
}