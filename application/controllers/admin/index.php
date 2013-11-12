<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->check_auth();
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
        $crud->edit_fields('template_id', 'slug', 'title', 'text', 'date', 'image', 'published');
        $crud->field_type('date', 'hidden');

        // Set relations using foreign keys
        $crud->set_relation('template_id','template','name');
        $crud->set_field_upload('image','assets/uploads/files');

        $crud->display_as('template_id','Template');

        // Fields sanitation
        $crud->callback_column('slug', array($this, 'link_page'));
        $crud->callback_before_insert(array($this, 'before_saving_page'));
        $crud->callback_before_update(array($this, 'before_saving_page'));

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
    *   Handles the widget CRUD.
    */
    public function widget()
    {
        $crud = $this->grocery_crud;

        $crud->set_table('widget');

        // Fields to show on the list
        //$crud->columns('title','text','image','slug');

        // Fields to show when editing
        $crud->edit_fields('widgetname', 'activated', 'created');
        $crud->field_type('created', 'hidden');

        $crud->display_as('widgetname','Name');

        $crud->callback_before_insert(array($this, 'before_saving_widget'));
        $crud->callback_before_update(array($this, 'before_saving_widget'));

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
        $this->load->model('url_m');

        $post['slug'] = $this->url_m->sluggify($post['slug']);
        $post['date'] = $this->set_datetime();

        $this->url_m->save_slug('page', $post['slug']);

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
    public function link_page($slug)
    {
        return '<a href="'.site_url('/'.$slug).'" target="_blank">'.$slug.'</a>';
    }

    public function set_datetime() {
        return date('Y-m-d H:i:s');
    }

}
