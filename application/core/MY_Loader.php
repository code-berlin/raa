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

    }
?>
