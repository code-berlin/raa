<?php
/**
 * DAO for pages
 *
 */
class Page_dao extends CI_Model{

	public function __construct(){
	    parent::__construct();

		$this->load->library('rb');

		$this->table = 'page';

		$this->object = new stdClass();
	}

	public function get_all() {

		return R::getAll("SELECT `child`.*, (SELECT `slug` FROM `page` as `parent` WHERE `parent`.`id` = `child`.`parent_id`) as `parent_slug` FROM `page` as `child` WHERE `published` = 1");

	}

	public function get_by_id($id) {
		$this->object = R::load($this->table, $id);

		$this->preload_template();

		return $this->object;
	}

	public function get_by_slug($slug) {

		#var_dump($slug);

		$qry = 'SELECT *, (SELECT `default_copyright_text` FROM `settings` LIMIT 1) as `default_copyright_text` FROM '.$this->table.' WHERE slug = :slug LIMIT 1;';

		$res = R::getAll($qry, [ 'slug' => $slug ]);
		$this->object = R::convertToBeans($this->table,$res);

		$this->preload_template();

		return $this->object;
	}

	public function preload_template() {
		if (!empty($this->object)) {
			R::preload($this->object, array('template')); // Related types
		}
	}

	public function create() {
		return R::dispense($this->table);
	}

	public function save($page) {
		return R::store($page);
	}

	public function delete($page) {
		return R::trash($page);
	}

	public function get_random_subpages($count) {
        return R::getAll('SELECT child.menu_title, child.slug, child.teaser_text, child.image, child.id,
        						 child.parent_id, parent.slug as parent_slug
        				  FROM '.$this->table.' as child
        				  LEFT JOIN '.$this->table.' as parent ON parent.id = child.parent_id
        				  WHERE (child.parent_id IS NOT NULL OR child.parent_id > 0)
        				  AND child.published = 1
        				  AND parent.published = 1
        				  ORDER BY RAND()
        				  LIMIT '.$count);
    }

    public function get_children($page_id) {
        return R::getAll('  SELECT child.menu_title, child.slug, child.teaser_text, child.image, child.id, child.parent_id,
        						   parent.slug as parent_slug, (
	                                SELECT position
	                                FROM menu_item
	                                WHERE id_menu = 1
	                                AND content_type = "page"
	                                AND contentId = child.id) as menu_position
                            FROM '.$this->table.' as child
                            LEFT JOIN '.$this->table.' as parent ON parent.id = child.parent_id
                            WHERE child.parent_id = '.$page_id.'
                            AND child.published = 1
                            AND parent.published = 1
                            ORDER BY menu_position, child.id ASC');
    }

    public function get_parent($page_id) {
        return R::getCell('SELECT parent_id FROM '.$this->table.' WHERE id = '.$page_id.' AND published = 1');
    }

    public function get_siblings($page_id) {
        return R::getAll('  SELECT child.menu_title, child.slug, child.teaser_text, child.image, child.id, child.parent_id,
        	                       parent.slug as parent_slug, (
	                                SELECT position
	                                FROM menu_item
	                                WHERE id_menu = 1
	                                AND content_type = "page"
	                                AND contentId = child.id
                                    LIMIT 1) as menu_position
                            FROM '.$this->table.' as child
                            LEFT JOIN '.$this->table.' as parent ON parent.id = child.parent_id
                            WHERE child.parent_id = (
                                SELECT parent_id FROM '.$this->table.'
                                WHERE id = '.$page_id.'
                                AND published = 1
                            )
                            AND child.published = 1
                            AND parent.published = 1
                            ORDER BY menu_position, child.id ASC');
    }

    public function get_articles_from_parent($page_id) {

        $query =   'SELECT page.menu_title, page.slug, page.teaser_text, page.image, page.id, page.slug, page.parent_id,
                        menu_item.id as menu_item_id, menu_item.contentId as menu_item_contentId,
                        menu_item.parent_id as menu_item_parent_id, menu_item.id_menu as menu_item_id_menu,
                        menu_item.position as menu_item_position, (
                            SELECT parent.slug
                            FROM page as parent
                            WHERE parent.id = page.parent_id
                            LIMIT 1
                        ) as parent_slug
                    FROM page
                    LEFT JOIN menu_item ON menu_item.contentId  = page.id
                    WHERE (
                        menu_item.contentId  = '.$page_id.'
                        OR
                        menu_item.parent_id = (SELECT id FROM menu_item WHERE contentId = '.$page_id.' AND id_menu = 1)
                    )
                    AND menu_item.id_menu = 1
                    AND page.published = 1
                    ORDER BY menu_item.parent_id, menu_item.position, page.id ASC';

        return R::getAll($query);
    }

    public function get_articles_from_child($page_id) {

        $query =   'SELECT page.menu_title, page.slug, page.teaser_text, page.image, page.id, page.slug, page.parent_id,
                        menu_item.id as menu_item_id, menu_item.contentId as menu_item_contentId,
                        menu_item.parent_id as menu_item_parent_id, menu_item.id_menu as menu_item_id_menu,
                        menu_item.position as menu_item_position, (
                            SELECT parent.slug
                            FROM page as parent
                            WHERE parent.id = page.parent_id
                            LIMIT 1
                        ) as parent_slug
                    FROM page
                    LEFT JOIN menu_item ON menu_item.contentId  = page.id
                    WHERE (
                        menu_item.parent_id = (
                            SELECT parent_id FROM menu_item
                            WHERE contentId = '.$page_id.'
                            AND id_menu = 1
                            AND published = 1
                        )
                        OR
                        page.id = (
                            SELECT parent_id
                            FROM page
                            WHERE id = '.$page_id.'
                            LIMIT 1
                        )
                    )
                    AND menu_item.id_menu = 1
                    AND page.published = 1
                    ORDER BY menu_item.parent_id, menu_item.position, page.id ASC';

        return R::getAll($query);
    }

}
