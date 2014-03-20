<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PHP Template.
 */

    class MY_Config extends CI_Config{

        function __construct(){
            parent::__construct();
            $this->do_staging();
        }

        private function do_staging(){



        	if(defined('STDIN')){
        		$mystage = $_SERVER['argv'][1];
        	}else{
        		$mystage = $_SERVER['SERVER_NAME'];
        	}

        	if(isset($this->config['stage'][$mystage])){
                $stage = $this->config['stage'][$mystage];
                $this->config['stage']=$stage;

                $this->config['base_url'] = $this->config['base_url'][$stage];
            }else{
            	exit;
            }
        }

	    /*
	     * gets the staged config if its part
	    * the $config will be replaced by the staged values
	    *
	    * @param	$config array		by reference the configuration values of the loaded file
	    * @return	bool				staged config loaded successfully?
	    */
	    private function get_staged_config(&$config){
	    	if(!isset($config[$this->config['stage']])){
	    		return FALSE;
	    	}

	    	$config = $config[$this->config['stage']];
	    	return TRUE;
	    }

	    /**
	     * Load Config File
	     * this method overwrites the basic load method
	     * it adds functionality to load stageable configs
	     *
	     * @access	public
	     * @param	string	the config file name
	     * @param   boolean  if configuration values should be loaded into their own section
	     * @param   boolean  true if errors should just return false, false if an error message should be displayed
	     * @return	boolean	if the file was loaded correctly
	     */
	    function load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
	    {
	    	$file = ($file == '') ? 'config' : str_replace('.php', '', $file);
	    	$found = FALSE;
	    	$loaded = FALSE;

	    	foreach ($this->_config_paths as $path)
	    	{
	    		$check_locations = defined('ENVIRONMENT')
	    		? array(ENVIRONMENT.'/'.$file, $file)
	    		: array($file);

	    		foreach ($check_locations as $location)
	    		{
	    			$file_path = $path.'config/'.$location.'.php';

	    			if (in_array($file_path, $this->is_loaded, TRUE))
	    			{
	    				$loaded = TRUE;
	    				continue 2;
	    			}

	    			if (file_exists($file_path))
	    			{
	    				$found = TRUE;
	    				break;
	    			}
	    		}

	    		if ($found === FALSE)
	    		{
	    			continue;
	    		}

	    		include($file_path);

	    		/* stagablity start */

	    		//checks wether the config is staged or not
	    		if(isset($staged) && $staged === TRUE && !$this->get_staged_config($config)){
	    			if ($fail_gracefully === TRUE)
	    			{
	    				return FALSE;
	    			}
	    			show_error('Your '.$file_path.' file does not appear to contain a staged configuration array.');
	    		}

	    		/* stagablity end */

	    		if ( ! isset($config) OR ! is_array($config))
	    		{
	    			if ($fail_gracefully === TRUE)
	    			{
	    				return FALSE;
	    			}
	    			show_error('Your '.$file_path.' file does not appear to contain a valid configuration array.');
	    		}

	    		if ($use_sections === TRUE)
	    		{
	    			if (isset($this->config[$file]))
	    			{
	    				$this->config[$file] = array_merge($this->config[$file], $config);
	    			}
	    			else
	    			{
	    				$this->config[$file] = $config;
	    			}
	    		}
	    		else
	    		{
	    			$this->config = array_merge($this->config, $config);
	    		}

	    		$this->is_loaded[] = $file_path;
	    		unset($config);

	    		$loaded = TRUE;
	    		log_message('debug', 'Config file loaded: '.$file_path);
	    		break;
	    	}

	    	if ($loaded === FALSE)
	    	{
	    		if ($fail_gracefully === TRUE)
	    		{
	    			return FALSE;
	    		}
	    		show_error('The configuration file '.$file.'.php'.' does not exist.');
	    	}

	    	return TRUE;
	    }
    }
?>
