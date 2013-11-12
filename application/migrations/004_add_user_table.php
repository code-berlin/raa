<?php
class Migration_Add_User_Table extends CI_Migration {
    public function up() {
      $this->db->query('CREATE TABLE IF NOT EXISTS `user` (
      `id` INT(2) NOT NULL AUTO_INCREMENT,
      `username` VARCHAR(128) NOT NULL,
      `password` VARCHAR(128) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE INDEX `username_UNIQUE` (`username` ASC))
        ENGINE = InnoDB;');

      $this->db->query("INSERT INTO `user` (`id`, `username`, `password`) VALUES (NULL, 'admin@code-b.com', 'b5edbafd026b773a7eb36d9b42b1bd6a952ddfdd');");
    }

    public function down() {
        $this->dbforge->drop_table('user');
    }
}
