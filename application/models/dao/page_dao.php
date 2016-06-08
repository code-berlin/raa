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

		$qry = 'SELECT `child`.*,
                (SELECT `slug` FROM `page` as `parent` WHERE `parent`.`id` = `child`.`parent_id`) as `parent_slug`,
                (SELECT `menu_title` FROM `page` as `parent` WHERE `parent`.`id` = `child`.`parent_id`) as `parent_menu_title`,
                (SELECT `default_copyright_text` FROM `settings` LIMIT 1) as `default_copyright_text`
                FROM `page` as `child`
                WHERE slug = :slug
                LIMIT 1;';

		$res = R::getAll($qry, [ 'slug' => $slug ]);
		$this->object = R::convertToBeans($this->table,$res);

		$this->preload_template();

		return $this->object;
	}

    public function get_by_slug_and_template_id($slug, $template_id) {

        $qry = 'SELECT *, (SELECT `default_copyright_text` FROM `settings` LIMIT 1) as `default_copyright_text` FROM '.$this->table.' WHERE slug = :slug AND template_id = :template_id LIMIT 1;';

        $res = R::getAll($qry, [ 'slug' => $slug , 'template_id' => $template_id]);
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
	                                FROM menuitem
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

    function get_children_ordered_by_menu_title($page_id) {
        return R::getAll('  SELECT child.menu_title, child.slug, child.teaser_text, child.image, child.id, child.parent_id,
                                   parent.slug as parent_slug, (
                                    SELECT position
                                    FROM menuitem
                                    WHERE id_menu = 1
                                    AND content_type = "page"
                                    AND contentId = child.id) as menu_position
                            FROM '.$this->table.' as child
                            LEFT JOIN '.$this->table.' as parent ON parent.id = child.parent_id
                            WHERE child.parent_id = '.$page_id.'
                            AND child.published = 1
                            AND parent.published = 1
                            ORDER BY child.menu_title ASC');
    }

    public function get_parent($page_id) {
        return R::getCell('SELECT parent_id FROM '.$this->table.' WHERE id = '.$page_id.' AND published = 1');
    }

    /*
     * get all siblings of an article, ordered by index in sidebar menu
     */
    public function get_siblings($page_id) {
        return R::getAll('  SELECT child.menu_title, child.slug, child.teaser_text, child.image, child.id, child.parent_id,
        	                       parent.slug as parent_slug, (
	                                SELECT position
	                                FROM menuitem
	                                WHERE id_menu = 3
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

    public function get_articles_by_page_id_and_menu_id($page_id, $menu_id) {

        $query =   'SELECT page.menu_title, page.slug, page.teaser_text, page.image, page.id, page.slug, page.parent_id,
                         menuitem.id as menu_item_id, menuitem.contentId as menu_item_contentId,
                         menuitem.parent_id as menu_item_parent_id, menuitem.id_menu as menu_item_id_menu,
                         menuitem.position as menu_item_position, (
                             SELECT parent.slug
                             FROM page as parent
                             WHERE parent.id = page.parent_id
                             LIMIT 1
                         ) as parent_slug
                     FROM page
                     LEFT JOIN menuitem ON menuitem.contentId  = page.id
                     WHERE (
                         menuitem.contentId  = ' . $page_id . '
                        OR
                         menuitem.parent_id = (SELECT id FROM menuitem WHERE contentId = ' . $page_id . ' AND id_menu = ' . $menu_id . ')
                        OR
                         menuitem.parent_id = (
                             SELECT parent_id FROM menuitem
                             WHERE contentId = ' . $page_id . '
                             AND id_menu = ' . $menu_id . '
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
                     AND menuitem.id_menu = ' . $menu_id . '
                     AND page.published = 1
                     ORDER BY menuitem.parent_id, menuitem.position, page.id ASC';

        return R::getAll($query);

    }

    function get_sidebar_teaser() {
        return R::find('sidebarteaser', 'published = 1 AND alternative = 0');
    }

    function get_sidebar_teaser_alt() {
        return R::findOne('sidebarteaser', 'published = 1 AND alternative = 1');
    }

    function get_grouped_articles($page_id, $actualpage, $order){

        $mysql_actualpage = ' AND page.id != ' . $page_id;
        $mysql_order = ' ORDER BY ISNULL(position) ASC, position ASC';

        if ($actualpage) {
            $mysql_actualpage = ' ';
        }

        if ($order == 'random') {
            $mysql_order = ' ORDER BY RAND() LIMIT 8';
        }

        $query =   'SELECT
                        page.id,
                        page.parent_id,
                        page.menu_title,
                        page.image,
                        page.slug,
                        (
                            SELECT parent.slug
                            FROM page as parent
                            WHERE parent.id = page.parent_id
                            LIMIT 1
                        ) as parent_slug,
                        (
                            SELECT parent.menu_title
                            FROM page as parent
                            WHERE parent.id = page.parent_id
                            LIMIT 1
                        ) as parent_menu_title,
                        articlegroupitem.position as position,
                        articlegroupitem.contentId as articlegroupitem_contentId,
                        articlegroupitem.articlegroupId as articlegroupitem_articlegroupId
                    FROM page
                    LEFT JOIN articlegroupitem ON articlegroupitem.contentId  = page.id
                    WHERE articlegroupitem.articlegroupId =
                       (SELECT articlegroupId
                        FROM articlegroupitem
                        WHERE contentId = '. $page_id .')'
                    . $mysql_actualpage
                    . $mysql_order;

        return R::getAll($query);

    }

    function get_top_articles($page_id){

        $query =   'SELECT
                        page.id,
                        page.parent_id,
                        page.menu_title,
                        page.image,
                        page.slug,
                        (
                            SELECT parent.slug
                            FROM page as parent
                            WHERE parent.id = page.parent_id
                            LIMIT 1
                        ) as parent_slug,
                        (
                            SELECT parent.menu_title
                            FROM page as parent
                            WHERE parent.id = page.parent_id
                            LIMIT 1
                        ) as parent_menu_title,
                        toparticle.position as position,
                        toparticle.contentId as toparticle_contentId
                    FROM page
                    LEFT JOIN toparticle ON toparticle.contentId  = page.id
                    WHERE toparticle.contentId IS NOT NULL
                    AND page.id != ' . $page_id . '
                    ORDER BY RAND() LIMIT 8';

        return R::getAll($query);

    }

}
