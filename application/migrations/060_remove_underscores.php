<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_remove_underscores extends Basic_migration {

	 function __construct() {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	$this->db->query('RENAME TABLE menu_item TO menuitem, 
    						sidebar_teaser TO sidebarteaser,
    						teaser_instance TO teaserinstance,
    						teaser_item TO teaseritem,
    						teaser_types TO teasertypes');
    }

    public function mig_down() {
    	$this->db->query('RENAME TABLE menu_item TO menuitem, 
    						sidebarteaser TO sidebar_teaser,
    						teaserinstance TO teaser_instance,
    						teaseritem TO teaser_item,
    						teasertypes TO teaser_types');
	}

}