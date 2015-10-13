<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_New_Fields_To_Settings extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `address` TEXT;');
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `phone` VARCHAR(128);');
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `latitude` FLOAT(10,6);');
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `longitude` FLOAT(10,6);');
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `linkedin` VARCHAR(512);');
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `facebook` VARCHAR(512);');
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `gplus` VARCHAR(512);');
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `twitter` VARCHAR(512);');
        $this->db->query('ALTER TABLE `settings` ADD COLUMN `instagram` VARCHAR(512);');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `address`;');
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `phone`;');
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `latitude`;');
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `longitude`;');
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `linkedin`;');
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `facebook`;');
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `gplus`');
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `twitter`');
        $this->db->query('ALTER TABLE `settings` DROP COLUMN `instagram`');
    }
}