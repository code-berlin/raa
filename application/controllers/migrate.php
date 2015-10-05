<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller used for the migration of the database to different versions
 */
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

        //if migrations table and users table exists it can't be the first usage -> force auth
        if($this->db->table_exists('migrations') && $this->db->table_exists('user') && $this->db->table_exists('role') ){
            if (!$this->auth_l->user_logged_in()){
                $this->auth_l->user_logged_in_with_redirect();
            }else{
                //no version specified -> migrate to latest
                if ($version == null){
                    if ( ! $this->migration->current()) {
                        show_error($this->migration->error_string());
                    }
                    $result_string = "Migrating to latest version: ".$latest_version;
                    //version specified -> check and migrate to version
                }else{
                    $mig_result = $this->db->get('migrations');
                    $current_version = 0;
                    foreach ($mig_result->result()  as $mr){
                        $current_version = $mr->version;
                        break;
                    }
                    //invalid version number
                    if ($version < 1 || $version > $latest_version ){
                        $result_string = "Invalid version. Version has to be between 1 and ".$latest_version;
                        //trying to migrate to current version
                    }else if($version == $current_version){
                        $result_string = "Sir, you are already on Version ".$version.", Sir!";
                    }else{
                        //error while migrating
                        if ( ! $this->migration->version($version)) {
                            show_error($this->migration->error_string());
                        }
                        $result_string = "Migrating to version ".$version;
                    }
                }
            }
            //first usage of the migration function, just update to the latest version
        }else{
            if ( ! $this->migration->current()) {
                show_error($this->migration->error_string());
            }
            $result_string = "Migrating to latest version: ".$latest_version;
            $result_string .= "<br><a href='/'>Go to homepage</a>";
            $result_string .= "<br><a href='/admin'>Go to admin panel</a>";

        }

        $data['migration_string'] = $result_string;
        $this->load->view('migrate/index', $data);
    }

    /**
     * jenkins calls go to this function
     * @param $pass the password, basic DOS security
     * @return bool false if something went wrong during the migration process, true otherwise
     */
    public function jenkins($pass){
        $this->load->library('migration');
        $this->config->load('migration');

        if ($pass =='thisisreallysecure'){
            if ( !$this->migration->current()) {
                $email = $this->config->item('admin_email');
                if (empty($email)){
                    $email = 'tech@code-b.com';
                }
                $this->load->library('email');

                $this->email->from('noreply@code-b.com', 'JENKINS');
                $this->email->to($email);

                $this->email->subject('Jenkins migration failed');
                $this->email->message('While trying to migrate to the latest Version Jenkins failed with the following error: '.$this->migration->error_string());

                $this->email->send();
                log_message('error', 'Error while trying to migrate to latest Version: '.$this->migration->error_string());
                return false;
            }
            return true;
        }else{
            return false;
        }
    }





}