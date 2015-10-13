<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * PHP Template.
 */

    class MY_Loader extends CI_Loader{

        function __construct(){
            parent::__construct();

        }


        function database($params = '', $return = FALSE, $active_record = TRUE){
            if($params==''){
                $params = $this->get_stage();
            }

            return parent::database($params, $return, $active_record);
        }

        function get_stage(){

            //i have no clue why the config is sometimes loaded and sometimes not :/
            //perhaps its a mistake in MY_Router
            if(!isset($this->config)){
                $this->config =& load_class('Config');
            }

            $conf = $this->config->config;

            if(isset($conf['stage'])){
                return $conf['stage'];
            }

            return '';

        }

        /**
         * Load View
         *
         * This function is used to load a "view" file.  It has three parameters:
         *
         * 1. The name of the "view" file to be included.
         * 2. An associative array of data to be extracted for use in the view.
         * 3. TRUE/FALSE - whether to return the data or load it.  In
         * some cases it's advantageous to be able to return data so that
         * a developer can process it in some way.
         *
         * @param   string
         * @param   array
         * @param   bool
         * @return  void
         */
        public function view($view, $vars = array(), $return = FALSE)
        {
            if ($this->config->item('theme') != false && file_exists(FCPATH . APPPATH . 'views/themes/' . $this->config->item('theme') . '/' . $view . EXT)) {
                return $this->_ci_load(array('_ci_view' => 'themes/' . $this->config->item('theme') . '/'  . $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
            }
            return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
        }

    }
?>
