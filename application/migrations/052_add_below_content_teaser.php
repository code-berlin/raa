<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Below_Content_Teaser extends Basic_migration {
    
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query("INSERT INTO `teaser_types` (`name`, `field_amount`) VALUES
                            ('1bigLeft_3smallRight', 4),
                            ('royal', 1);");
	}

    public function mig_down() {

    	$this->db->query("DELETE FROM `teaser_item` WHERE `teaser_instanceId` = (SELECT `id` FROM `teaser_instance` WHERE `teaser_types_id` = (SELECT `id` FROM `teaser_types` WHERE `name` = '1bigLeft_3smallRight'));");

    	$this->db->query("DELETE FROM `teaser_instance` WHERE `teaser_types_id` = (SELECT `id` FROM `teaser_types` WHERE `name` = '1bigLeft_3smallRight');");

    	$this->db->query("DELETE FROM `teaser_types` WHERE `name` = '1bigLeft_3smallRight'");

    	$this->db->query("DELETE FROM `teaser_item` WHERE `teaser_instanceId` = (SELECT `id` FROM `teaser_instance` WHERE `teaser_types_id` = (SELECT `id` FROM `teaser_types` WHERE `name` = 'royal'));");

    	$this->db->query("DELETE FROM `teaser_instance` WHERE `teaser_types_id` = (SELECT `id` FROM `teaser_types` WHERE `name` = 'royal');");

    	$this->db->query("DELETE FROM `teaser_types` WHERE `name` = 'royal'");

	}

}