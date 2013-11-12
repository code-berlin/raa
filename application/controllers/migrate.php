<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index($version=null){
        $this->load->library('migration');
        $this->config->load('migration');
        $latest_version = $this->config->item('migration_version');
        $result_string = "";

        if($this->db->table_exists('migrations') && $this->db->table_exists('user') ){
            if (!$this->auth_l->user_logged_in()){
                $this->auth_l->user_logged_in_with_redirect();
            }else{
                //no version specified migrate to latest
                if ($version == null){
                    if ( ! $this->migration->current()) {
                        show_error($this->migration->error_string());
                    }
                    $result_string = "Migrating to latest version: ".$latest_version;
                    //version specified, check and migrate to version
                }else{
                    if ($version < 1 || $version > $latest_version ){
                        $result_string = "Invalid version. Version has to be between 1 and ".$latest_version;
                    }else{
                        if ( ! $this->migration->version($version)) {
                            show_error($this->migration->error_string());
                        }
                        $result_string = "Migrating to version ".$version;
                    }
                }
            }
        }else{
            if ( ! $this->migration->current()) {
                show_error($this->migration->error_string());
            }
            $result_string = "Migrating to latest version: ".$latest_version;

        }

        $data['migration_string'] = $result_string;
        $this->load->view('migrate/index', $data);
    }





}