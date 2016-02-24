<?php
require_once(APPPATH . 'migrations/basic_migration.php');

class Migration_Mediathek extends Basic_migration {

	 function __construct() {
        parent::__construct();
        $this->filename =  __FILE__;
    }

    public function mig_up() {
    	
        $this->db->query("CREATE TABLE IF NOT EXISTS `mediathek` (
                              `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                              `path` VARCHAR(512) NOT NULL,
                              `filename` VARCHAR(128) NOT NULL,
                              `name` VARCHAR(64) NOT NULL,
                              `MIME` VARCHAR(64) NOT NULL,
                              `uploaded_at` DATETIME NOT NULL,
                              `user_id` INT(2) NOT NULL,
                              `licence` VARCHAR(1024) NULL,
                              `alt_text` VARCHAR(200) NULL,
                              PRIMARY KEY (`id`),
                              INDEX `fk_mediathek_user1_idx` (`user_id` ASC),
                              CONSTRAINT `fk_mediathek_user1`
                                FOREIGN KEY (`user_id`)
                                REFERENCES `user` (`id`)
                                ON DELETE NO ACTION
                                ON UPDATE NO ACTION)
                            ENGINE = InnoDB;");

        $this->db->query("ALTER TABLE `sidebarteaser` ADD
                            `mediathek_id` INT(10) UNSIGNED NULL AFTER image,
                            ADD INDEX `fk_sidebar_teaser_mediathek1_idx` (`mediathek_id` ASC),
                            ADD CONSTRAINT `fk_sidebar_teaser_mediathek1`
                            FOREIGN KEY (`mediathek_id`)
                            REFERENCES `mediathek` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION;");

        $this->db->query("ALTER TABLE `page` ADD
                            `mediathek_id` INT(10) UNSIGNED NULL AFTER image,
                            ADD INDEX `fk_page_mediathek1_idx` (`mediathek_id` ASC),
                            ADD CONSTRAINT `fk_page_mediathek1`
                            FOREIGN KEY (`mediathek_id`)
                            REFERENCES `mediathek` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION;");

        $this->db->query("ALTER TABLE `product` ADD
                            `mediathek_id` INT(10) UNSIGNED NULL AFTER image,
                            ADD INDEX `fk_product_mediathek1_idx` (`mediathek_id` ASC),
                            ADD CONSTRAINT `fk_product_mediathek1`
                            FOREIGN KEY (`mediathek_id`)
                            REFERENCES `mediathek` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION;");

        $this->db->query("ALTER TABLE `author` ADD
                            `mediathek_id` INT(10) UNSIGNED NULL AFTER image,
                            ADD INDEX `fk_author_mediathek1_idx` (`mediathek_id` ASC),
                            ADD CONSTRAINT `fk_author_mediathek1`
                            FOREIGN KEY (`mediathek_id`)
                            REFERENCES `mediathek` (`id`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION;");

        $this->load->model('mediathek_m');

        $this->load->model('user_m');

        $user = $this->user_m->get_by_username($this->config->item("superadmin")["username"]);

        $this->load->model('sidebar_teaser_m');

        $this->transfer_image($this->sidebar_teaser_m, $user);

        $this->db->query("ALTER TABLE `author` DROP `image`;");

        $this->load->model('author_m');

        $this->transfer_image($this->author_m, $user);

        $this->db->query("ALTER TABLE `product` DROP `image`;");

        $this->load->model('product_m');

        $this->transfer_image($this->product_m, $user);

        $this->db->query("ALTER TABLE `sidebarteaser` DROP `image`;");

        $this->load->model('page_m');

        $this->transfer_image($this->page_m, $user);

        $this->db->query("ALTER TABLE `page` DROP `image`;");

        $this->db->query("INSERT INTO `permission` (`name`) VALUES
                            ('EDIT_MEDIATHEK');");

        $id = $this->db->insert_id();

        $this->db->query("INSERT INTO `rolepermission` (`role_id`, `permission_id`) VALUES
                            (1, " . $id . ");");

    }

    public function mig_down() {
        
        $this->db->query("ALTER TABLE `sidebarteaser` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
        $this->db->query("UPDATE `sidebarteaser` SET `image` = (SELECT `filename` FROM `mediathek` WHERE `id` = `mediathek_id`);");
        $this->db->query("ALTER TABLE `sidebarteaser` DROP FOREIGN KEY `fk_sidebar_teaser_mediathek1`");
        $this->db->query("ALTER TABLE `sidebarteaser` DROP INDEX `fk_sidebar_teaser_mediathek1_idx`");
        $this->db->query("ALTER TABLE `sidebarteaser` DROP `mediathek_id`;");
        
        $this->db->query("ALTER TABLE `page` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");
        $this->db->query("UPDATE `page` SET `image` = (SELECT `filename` FROM `mediathek` WHERE `id` = `mediathek_id`);");
        $this->db->query("ALTER TABLE `page` DROP FOREIGN KEY `fk_page_mediathek1`");
        $this->db->query("ALTER TABLE `page` DROP INDEX `fk_page_mediathek1_idx`");
        $this->db->query("ALTER TABLE `page` DROP `mediathek_id`;");
        
        $this->db->query("ALTER TABLE `product` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");
        $this->db->query("UPDATE `product` SET `image` = (SELECT `filename` FROM `mediathek` WHERE `id` = `mediathek_id`);");
        $this->db->query("ALTER TABLE `product` DROP FOREIGN KEY `fk_product_mediathek1`");
        $this->db->query("ALTER TABLE `product` DROP INDEX `fk_product_mediathek1_idx`");
        $this->db->query("ALTER TABLE `product` DROP `mediathek_id`;");
        
        $this->db->query("ALTER TABLE `author` ADD `image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;");
        $this->db->query("UPDATE `author` SET `image` = (SELECT `filename` FROM `mediathek` WHERE `id` = `mediathek_id`);");
        $this->db->query("ALTER TABLE `author` DROP FOREIGN KEY `fk_author_mediathek1`");
        $this->db->query("ALTER TABLE `author` DROP INDEX `fk_author_mediathek1_idx`");
        $this->db->query("ALTER TABLE `author` DROP `mediathek_id`;");        
        
        $this->db->query("DROP TABLE `mediathek`;");

        $sql = $this->db->query("SELECT id FROM permission WHERE `name` = 'EDIT_MEDIATHEK';");
        
        if (isset($sql->row()->id) && $sql->row()->id > 0) {
            $this->db->query("DELETE FROM `rolepermission` WHERE `permission_id` = " . $sql->row()->id . ";");
        }

        $this->db->query("DELETE FROM `permission` WHERE `name` = 'EDIT_MEDIATHEK';");

	}

    public function transfer_image($orig_model, $user) {

        $items = $orig_model->get_all();        

        foreach ($items as $res) {

            if (empty($res['image'])) continue;

            $asset = $this->mediathek_m->create();

            $asset->path = $this->config->item('upload_folder');

            $orig_file = FCPATH . $this->config->item('upload_folder') . '/' . $res['image'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $asset->MIME = finfo_file($finfo, $orig_file);
            finfo_close($finfo);

            $asset->filename = $res['image'];

            $ext = pathinfo($orig_file, PATHINFO_EXTENSION);

            $name = basename($orig_file, ".".$ext);

            $asset->name = $name;

            $asset->uploaded_at = date('c', filectime($orig_file));

            $asset->user_id = $user->id;
            
            $asset->licence = '';
            
            $asset->alt_text = $name;

            $mediathek_id = $this->mediathek_m->save($asset);

            $item = $orig_model->create();

            $item->id = $res['id'];

            $item->mediathek_id = $mediathek_id;

            $orig_model->save($item);

        }

        return true;

    }

}