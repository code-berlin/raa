<?php

class Basic_migration  extends CI_Migration {
    public $filename = __FILE__;
    function __construct()
    {        parent::__construct();
             $this->load->library('rb_loader');

    }
    public function up() {
        log_message('debug', 'Starting to run up on Version '.$this->filename);
        try{
            //migrate up on current database, switch to test database migrate up there and then switch back
            $this->mig_up();
            $db = $this->config->config['stage'] . '_test';
            $this->db = $this->load->database($db,TRUE);
            $this->rb_loader->reload_connection();
            $this->mig_up();
            $db = $this->config->config['stage'];
            $this->db = $this->load->database($db,TRUE);
            $this->rb_loader->reload_connection();
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
            //migrate down on current database, switch to test database migrate down there and then switch back
            $this->mig_down();
            $db = $this->config->config['stage'] . '_test';
            $this->db = $this->load->database($db,TRUE);
            $this->rb_loader->reload_connection();
            $this->mig_down();
            $db = $this->config->config['stage'];
            $this->db = $this->load->database($db,TRUE);
            $this->rb_loader->reload_connection();
        }catch (Exception $e){
            log_message('error', 'Error while trying to run down on Version '.$this->filename.' .Error was: '.$e->getMessage() );
        }
        log_message('debug', 'Finishing down on Version '.$this->filename);
    }

    public function mig_down(){

    }

    /**
     * checks if a given column exists in a given table
     * @param $table the tablename
     * @param $column the columnname
     * @return bool returns true if the column exists, false otherwise
     */
    public function check_if_column_exist($table, $column){
        $result = $this->db->query("SHOW COLUMNS FROM `".$table."` LIKE '".$column."'");

        return (!empty($result->num_rows));
    }

    /**
     * adds a column to a given table. if the column already exists nothing will happen
     * @param $table the tablename
     * @param $column the columnname
     * @param $type the type string including length (e.g. VARCHAR (255) );
     * @param bool $null true if the value can be NULL, false if NOT NULL is desired
     * @param string $after_column column name after which the new column is inserted, if left empty the column will be added at the end
     * @param string $default_value if a default value is desired it can be entered here
     */
    public function add_column($table, $column, $type, $null=true, $after_column = '', $default_value=''){
        if (!$this->check_if_column_exist($table, $column)){
            $query = "ALTER TABLE `".$table."` ADD COLUMN `".$column."` ".$type." ";
            if ($null){
                $query .="NULL";
            }else{
                $query .="NOT NULL";
            }

            if (!empty($default_value)){
                $query.= " DEFAULT '".$default_value."'";
            }

            if (!empty($after_column)){
                $query.= " AFTER `".$after_column."`";
            }

            $this->db->query($query);
        }
    }

    /**
     * function to remove a column from a table, if the column doesn't exist nothing happens
     * @param $table the tablename
     * @param $column the columnname
     */
    public function drop_column($table, $column){
        if ($this->check_if_column_exist($table, $column)){
            $query = "ALTER TABLE `".$table."` DROP COLUMN `".$column."`";
            $this->db->query($query);
        }
    }


}
