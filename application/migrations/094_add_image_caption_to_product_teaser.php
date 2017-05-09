<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Image_Caption_To_Product_Teaser extends Basic_migration {

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
        $this->db->query('ALTER TABLE  `productteaser` ADD  `image_caption` VARCHAR(255) DEFAULT NULL AFTER  `image`;');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `productteaser` DROP `image_caption`;');
    }

}
