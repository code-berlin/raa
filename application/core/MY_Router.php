<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PHP Template.
 */

class MY_Router extends CI_Router {

	var $CI;
    var $db;
    var $stage = '';
    
    var $error_controller = 'error';
    var $error_method_404 = 'error_404';

    function __construct($config = array()){
        parent::__construct($config);
    }

    /**
	 * Set the route mapping
	 *
	 * This function determines what should be served based on the URI request,
	 * as well as any "routes" that have been set in the routing config file.
	 *
	 * @access	private
	 * @return	void
	 */
	function _set_routing()
	{
		
		$this->uri->_fetch_uri_string();

		// Are query strings enabled in the config file?  Normally CI doesn't utilize query strings
		// since URI segments are more search-engine friendly, but they can optionally be used.
		// If this feature is enabled, we will gather the directory/class/method a little differently
		$segments = array();
		if ($this->config->item('enable_query_strings') === TRUE AND isset($_GET[$this->config->item('controller_trigger')]))
		{
			if (isset($_GET[$this->config->item('directory_trigger')]))
			{
				$this->set_directory(trim($this->uri->_filter_uri($_GET[$this->config->item('directory_trigger')])));
				$segments[] = $this->fetch_directory();
			}

			if (isset($_GET[$this->config->item('controller_trigger')]))
			{
				$this->set_class(trim($this->uri->_filter_uri($_GET[$this->config->item('controller_trigger')])));
				$segments[] = $this->fetch_class();
			}

			if (isset($_GET[$this->config->item('function_trigger')]))
			{
				$this->set_method(trim($this->uri->_filter_uri($_GET[$this->config->item('function_trigger')])));
				$segments[] = $this->fetch_method();
			}
		}

		// Load the routes.php file.
		if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
		}
		elseif (is_file(APPPATH.'config/routes.php'))
		{
			include(APPPATH.'config/routes.php');
		}

		$this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;
		unset($route);


		// Set the default controller so we can display it in the event
		// the URI doesn't correlated to a valid controller.
		$this->default_controller = ( ! isset($this->routes['default_controller']) OR $this->routes['default_controller'] == '') ? FALSE : strtolower($this->routes['default_controller']);

		if (!empty($this->uri->uri_string) && stripos($this->uri->uri_string, 'admin') === false && stripos($this->uri->uri_string, 'auth') === false && stripos($_SERVER['REQUEST_URI'], '.') === false) {

			$excepted = '/' . $this->uri->uri_string . '/';

	        $protocoll = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://');

            $parsed_url = parse_url($protocoll . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	        
	       	if($parsed_url["path"] != $excepted) {
	        	$this->redirect($protocoll . $_SERVER['HTTP_HOST'] . $excepted . (isset($parsed_url['query']) ? "?" . $parsed_url['query'] : ""),'location',301);
	        }

		}


		// Were there any query string segments?  If so, we'll validate them and bail out since we're done.
		if (count($segments) > 0)
		{
			return $this->_validate_request($segments);
		}


		// Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
		if ($this->uri->uri_string == '')
		{
			return $this->_set_default_controller();
		}


		// Do we need to remove the URL suffix?
		$this->uri->_remove_url_suffix();

		// Compile the segments into an array
		$this->uri->_explode_segments();

		// Parse any custom routing that may exist
		$this->_parse_routes();

		// Re-index the segment array so that it starts with 1 rather than 0
		$this->uri->_reindex_segments();
	}

	function redirect($uri = '', $method = 'location', $http_response_code = 302)
	{
		
		if(!isset($this->config)){
            $this->config =& load_class('Config');
        }
            
        $conf = $this->config->config;
        //var_dump($this);
        if(isset($conf['stage'])){
            $site_uri = $conf['base_url'];
        }     
        
		
		if ( ! preg_match('#^https?://#i', $uri))
		{
			$uri = 'http://'.$site_uri.$uri ;
		}

		switch($method)
		{
			case 'refresh'	: header("Refresh:0;url=".$uri);
				break;
			default			: header("Location: ".$uri, TRUE, $http_response_code);
				break;
		}
		exit;
	}

}