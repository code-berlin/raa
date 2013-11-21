<?php

class Basic_migration  extends CI_Migration {
    public $filename = __FILE__;
    function __construct()
    {        parent::__construct();

    }
    public function up() {
        log_message('debug', 'Starting to run up on Version '.$this->filename);
        try{
            $this->mig_up();
        }catch (Exception $e){
            log_message('error', 'Error while trying to run up on Version '.$this->filename.' .Error was: '.$e->getMessage() );
        }
        log_message('debug', 'Finishing up on Version '.$this->filename);
    }

    public function mig_up(){

    }

    public function down(){
        log_message('debug', 'Starting to run down on Version '.$this->filename);
        try{
            $this->mig_down();
        }catch (Exception $e){
            log_message('error', 'Error while trying to run down on Version '.$this->filename.' .Error was: '.$e->getMessage() );
        }
        log_message('debug', 'Finishing down on Version '.$this->filename);
    }

    public function mig_down(){

    }
}
