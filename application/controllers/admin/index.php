<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        if (!isset($_SESSION['user_name']))
        {
            redirect('admin/login');
        }

        $this->load->view('admin/admin');
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'required');

        if ($this->form_validation->run() !== false)
        {
            $this->load->model('admin_m');
            $result = $this
                ->admin_m
                ->verify_user(
                    $this
                    ->input
                    ->post('user_name'),
                    $this
                    ->input
                    ->post('user_password')
                    );

            if ($result !== false)
            {
                $_SESSION['user_name'] = $result->username;
                redirect('admin');
            }
        }

        $this->load->view('admin/login');
    }

    public function logout()
    {
        unset($_SESSION['user_name']);
        redirect('admin/login');
    }

    /**
    *   Handles the page CRUD.
    */
    public function page()
    {

        if (!isset($_SESSION['user_name']))
        {
            //redirect('admin/login');
        }

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
        if (!isset($_SESSION['user_name']))
        {
            redirect('admin/login');
        }

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
        $this->load->model('widget_m');

        $crud = $this->grocery_crud;

        $crud->set_table('widget');

        $this->widget_m->scan_for_widgets();

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
    public function link_page($slug) {
        return '<a href="'.site_url('/'.$slug).'" target="_blank">'.$slug.'</a>';
    }

    public function set_datetime() {
        return date('Y-m-d H:i:s');
    }

}
