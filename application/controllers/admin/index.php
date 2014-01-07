<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->check_auth();
        $this->load->library('grocery_CRUD');
    }

    public function check_auth()
    {
        if (!$this->auth_l->user_logged_in())
        {
            redirect('auth');
        }
    }

    public function index()
    {
        $this->load->view('admin/admin');
    }

    /**
    *   Handles the page CRUD.
    */
    public function page()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('page');

        // Fields to show on the list
        $crud->columns('title','text','image','slug');

        // Fields to show when editing
        $crud->edit_fields('template_id', 'title', 'text', 'date', 'image', 'slug', 'published', 'id', 'seo_meta_keywords', 'seo_meta_title', 'seo_meta_description', 'seo_footer_text');

        $crud->field_type('id', 'hidden');
        $crud->field_type('date', 'hidden');

        // Set relations using foreign keys
        $crud->set_relation('template_id','template','name');
        $crud->set_field_upload('image','assets/uploads/files');

        $crud->display_as('template_id','Template');

        // Fields sanitation
        $crud->callback_column('slug', array($this, 'link_page'));

        $crud->callback_before_insert(array($this, 'before_saving_page'));
        $crud->callback_before_update(array($this, 'before_saving_page'));
        $crud->callback_before_delete(array($this, 'before_deleting_page'));

        $this->load->view('admin/admin', $crud->render());
    }

    /**
    *   Handles the menu CRUD.
    */
    public function menu()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('menu');
        $crud->add_action('edit items', base_url('/assets/grocery_crud/themes/flexigrid/css/images/edit-items.gif'), 'admin/menu/item');

        $this->load->view('admin/admin', $crud->render());
    }

    /**
    *   Handles the product CRUD.
    */
    public function product()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('product');

        $_POST['content_type_name'] = 'product';

        $crud->set_rules('slug','Slug','is_unique[url.slug]');
        $crud->callback_before_insert(array($this, 'before_saving_content_type'));
        $crud->callback_before_update(array($this, 'before_saving_content_type'));

        $this->load->view('admin/admin', $crud->render());
    }


    /**
    *   Handles the user CRUD.
    */
    public function user()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('user');
        $crud->columns('username','role_id');
        $crud->set_relation('role_id','role','title');

        $_POST['content_type_name'] = 'user';

        $crud->set_rules('email','Email','is_unique[user.email]');
        $crud->callback_before_insert(array($this, 'before_saving_content_type'));
        $crud->callback_before_update(array($this, 'before_saving_content_type'));

        $this->load->view('admin/admin', $crud->render());
    }


    /**
    *   Handles the widget CRUD.
    */
    public function widget()
    {
        $this->load->model('widget_m');
        $crud = $this->grocery_crud;

        $crud->set_table('widget');

        $crud->unset_add();
        $crud->unset_delete();
        $crud->unset_export();
        $crud->unset_print();
        $crud->unset_read();

        $this->widget_m->scan_for_widgets();

        // Fields to show on the list
        $crud->columns('widgetname','activated');
        $crud->display_as('widgetname','Name');

        // Fields to show when editing
        $crud->edit_fields('activated', 'created');
        $crud->field_type('created', 'hidden');

        $crud->callback_before_insert(array($this, 'before_saving_widget'));
        $crud->callback_before_update(array($this, 'before_saving_widget'));

        $this->load->view('admin/admin', $crud->render());
    }

    /**
    *   Handles the widget CRUD.
    */
    public function widgets_container()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('widgetscontainer');

        $crud->unset_export();
        $crud->unset_print();
        $crud->unset_read();

        $add_items_image = 'assets/grocery_crud/themes/flexigrid/css/images/edit-items.gif';

        $crud->add_action('edit items', base_url($add_items_image), 'admin/container_item');

        $this->load->view('admin/admin', $crud->render());
    }

    public function container_item($id)
    {
        $crud = $this->grocery_crud;

        $crud->set_table('widgetscontainersrelation');

        $crud->columns('widget_id', 'widget_position');

        $crud->where('widgets_container_id', $id);

        $crud->set_relation('widget_id','widget','widgetname');
        $crud->display_as('widget_id','Widget');
        $crud->display_as('widget_position','Position');


        $crud->field_type('widgets_container_id', 'hidden');

        $_POST['widgets_container_id'] = $id;

        $this->load->view('admin/admin', $crud->render());
    }

    //Generates CRUD for General Settings menu
    public function general_settings()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('settings');

        $crud->unset_add();
        $crud->unset_delete();

        $this->load->view('admin/admin', $crud->render());
    }

    // Utility functions for Grocery CRUD

    /**
    *   Checks page information before it's stored in the database.
    *
    *   It should be made for both update and insert actions.
    *   This is GroceryCRUD specific. Maybe there's a cleanest way
    *   to do it.
    */
    public function before_saving_page($post) {
        $this->load->model('type_m');
        $this->load->model('url_m');
        $this->load->model('page_m');

        // Transform special characters on dashes
        $post['slug'] = $this->url_m->sluggify($post['slug']);

        // If we are editing, search for other pages with same slug
        if (!empty($post['id'])) {
            $page_id = $post['id'];

            $page = $this->page_m->get_by_slug($post['slug']);
        } else {
            $page_id = 0;
        }

        // Check if current slug exists
        $slugs = $this->url_m->get_by_slug($post['slug']);

        // When current slug exists and is not the one on our page, make it unique
        if ($slugs != NULL) {
            if (empty($post['id']) || (!empty($post['id']) && !empty($page->id) && $page->id != $post['id'])) {
                $post['slug'] = $post['slug'].'-'.uniqid();
            }
        }

        $post['date'] = $this->set_datetime();

        $this->type_m->save_slug('page', $post['slug'], $page_id);

        return $post;
    }

    public function before_deleting_page($id) {
        /*
        * Remove slug from list when deleting page
        */
        $this->load->model('url_m');
        $this->load->model('page_m');

        $page = $this->page_m->get_by_id($id);

        $slug = $this->url_m->get_by_slug($page->slug);

        $this->url_m->remove($slug);
    }

    /**
    *   Checks page information before it's stored in the database.
    *
    *   It should be made for both update and insert actions.
    *   This is GroceryCRUD specific. Maybe there's a cleanest way
    *   to do it.
    */
    public function before_saving_content_type($post) {
        $this->load->model('type_m');
        $this->load->model('url_m');

        $post['slug'] = $this->url_m->sluggify($post['slug']);
        $post['date'] = $this->set_datetime();
        $content_type_name = $post['content_type_name'];

        $page_id = (!empty($post['id'])) ? $post['id'] : 0;

        $this->type_m->save_slug($content_type_name, $post['slug'], $page_id);

        return $post;
    }


    /**
    *   Checks widget information before it's stored in the database.
    */
    public function before_saving_widget($post) {
        $post['created'] = $this->set_datetime();

        return $post;
    }

    /**
    *   Makes pages slugs into links
    */
    public function link_page($slug) {
        return '<a href="'.site_url('/'.$slug).'" target="_blank">'.$slug.'</a>';
    }

    public function set_datetime() {
        return date('Y-m-d H:i:s');
    }

}
