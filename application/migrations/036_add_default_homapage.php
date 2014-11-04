<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Default_Homapage extends Basic_migration {
    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
    }
    public function mig_up() {
        $this->db->query("INSERT INTO `page` (
                `id`, 
                `template_id`, 
                `menu_order`,
                `title`,
                `text`, 
                `image`, 
                `slug`, 
                `date`, 
                `published`, 
                `seo_meta_keywords`, 
                `seo_meta_title`, 
                `seo_meta_description`, 
                `seo_footer_text`
                ) VALUES (1, 1, 1, 'Home', NULL, NULL, 'home', '2014-11-04 17:41:17', 1, NULL, 'RAA CMS', NULL, NULL);"
            );
        
        $this->db->query("INSERT INTO `url` (`id`, `slug`, `type_id`) VALUES (NULL, 'home', 1);");
    }

    public function mig_down() {
        $this->db->query("DELETE FROM `page` WHERE `slug` = 'home'");
        $this->db->query("DELETE FROM `url` WHERE `slug` = 'home'");
    }
}