<?php
class Migration_General_Settings extends CI_Migration {
    public function up() {
      $this->db->query("INSERT INTO `settings` (`id`, `blog_title`, `email`)
        VALUES (35, 'Default blog title', 'default@email-address.de');");
    }

    public function down() {
      $this->db->query("TRUNCATE `settings`");
    }
}
