<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Add_Parent_Id_Field_To_Pages extends Basic_migration {
    private $field;
    private $page;

    function __construct()
    {
        parent::__construct();
        $this->filename =  __FILE__;
        $this->field = 'parent_id';
        $this->table = 'page';
    }
    public function mig_up() {
        $this->db->query('ALTER TABLE `'.$this->table.'` ADD COLUMN `'.$this->field.'` int(11) AFTER template_id;');
    }

    public function mig_down() {
    $this->db->query('ALTER TABLE `'.$this->table.'` DROP COLUMN `'.$this->field.'`;');
    }
}