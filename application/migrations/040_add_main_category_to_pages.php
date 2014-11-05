<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Main_Category_To_Pages extends Basic_migration {
    private $field;
    private $page;

    public function __construct() {
        parent::__construct();

        $this->filename =  __FILE__;

        $this->table = 'page';
        $this->field = 'main_category';
    }
    public function mig_up() {
        $this->db->query('ALTER TABLE `'.$this->table.'` ADD COLUMN `'.$this->field.'` tinyint(1) AFTER template_id;');
    }

    public function mig_down() {
        $this->db->query('ALTER TABLE `'.$this->table.'` DROP COLUMN `'.$this->field.'`;');
    }
}