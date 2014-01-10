<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    var $user_role;

    function __construct()
    {
        parent::__construct();

        $this->check_auth();
        $this->check_if_disabled();

        $this->load->library('grocery_CRUD');

        $this->user_role = $this->auth_l->retrieve_user_role();
        $this->user = $this->user_m->get_by_username($this->session->userdata('user_name'));

        // Save role permissions from post into an array
        $this->relationships = array();
    }

    /****************************************************************
    *                                                               *
    *                                                               *
    *                                                               *
    *                         PAGES                                 *
    *                                                               *
    *                                                               *
    *                                                               *
    ****************************************************************/

    public function index()
    {
        $this->control_sidebar_items_display($data);

        if (!$this->auth_l->check_section_access_required_permissions($this->user->role_id, $_SERVER['REQUEST_URI'])) {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the page CRUD.
    */
    public function page()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            // Page permissions
            $this->check_section_permissions($role_id, $url, $crud, $auth);

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

            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the menu CRUD.
    */
    public function menu()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->check_section_permissions($role_id, $url, $crud, $auth);

            $crud->set_table('menu');
            $crud->add_action('edit items', base_url('/assets/grocery_crud/themes/flexigrid/css/images/edit-items.gif'), 'admin/menu/item');

            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the product CRUD.
    */
    public function product()
    {
        $this->control_sidebar_items_display($data);

        $crud = $this->grocery_crud;

        $crud->set_table('product');

        $_POST['content_type_name'] = 'product';

        $crud->set_rules('slug','Slug','is_unique[url.slug]');
        $crud->callback_before_insert(array($this, 'before_saving_content_type'));
        $crud->callback_before_update(array($this, 'before_saving_content_type'));

        $this->add_grocery_to_data_array($crud->render(), $data);

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the user CRUD.
    */
    public function user()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->check_section_permissions($role_id, $url, $crud, $auth);

            $_POST['content_type_name'] = 'user';

            $crud->set_table('user');

            $crud->unset_read();
            // list page
            $crud->columns('name','username','role_id');

            $crud->set_relation('role_id','role','title');
            $crud->display_as('role_id', 'Role');

            $crud->field_type('disabled','true_false', array('1' => 'Yes', '0' => 'No'));

            // create, edit page
            $crud->change_field_type('password','password');
            $crud->set_rules('username','Username','valid_email|required');
            $crud->callback_edit_field('password',array($this,'print_password_field_callback'));

            if($crud->getState() == 'add' || $crud->getState() == 'insert_validation') {
                $crud->required_fields('username','role_id','password','disabled','creation_datetime');
            } else {
                $crud->required_fields('username','role_id','disabled','creation_datetime');
                $crud->display_as('password','change password');
            }

            $crud->callback_before_insert(array($this, 'before_saving_user'));
            $crud->callback_before_update(array($this, 'before_updating_user'));

            // When user is not allowed to CRUD the section, Grocery shows an error message
            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the section CRUD.
    */
    public function section()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->check_section_permissions($role_id, $url, $crud, $auth);

            $crud->set_table('section');

            $crud->unset_export();
            $crud->unset_print();
            $crud->unset_read();

            $crud->columns('name', 'url');
            $crud->fields('name', 'url', 'permissions');
            $crud->required_fields('name','url');
            $crud->display_as('permissions', 'Permissions required');

            $this->permission_relationship_type = 'section';
            $crud->callback_field('permissions', array($this, 'display_permissions_list'));

            $crud->callback_before_update(array($this, 'before_creating_type'));
            $crud->callback_before_insert(array($this, 'before_creating_type'));
            $crud->callback_after_update(array($this, 'after_creating_type'));
            $crud->callback_after_insert(array($this, 'after_creating_type'));

            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the roles CRUD.
    */
    public function role()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->check_section_permissions($role_id, $url, $crud, $auth);

            $crud->set_table('role');

            $crud->unset_export();
            $crud->unset_print();
            $crud->unset_read();

            $crud->columns('title', 'description');
            $crud->fields('title', 'description', 'permissions');
            $crud->required_fields('title');

            $this->permission_relationship_type = 'role';
            $crud->callback_field('permissions', array($this, 'display_permissions_list'));

            $crud->callback_before_update(array($this, 'before_creating_type'));
            $crud->callback_before_insert(array($this, 'before_creating_type'));
            $crud->callback_after_update(array($this, 'after_creating_type'));
            $crud->callback_after_insert(array($this, 'after_creating_type'));

            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the permission CRUD.
    */
    public function permission()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->check_section_permissions($role_id, $url, $crud, $auth);

            $crud->set_table('permission');

            $crud->columns('name', 'permissiongroup_id');
            $crud->required_fields('name');
            $crud->set_relation('permissiongroup_id','permissiongroup','name');

            $crud->display_as('permissiongroup_id', 'Group');

            $crud->unset_export();
            $crud->unset_print();
            $crud->unset_read();

            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the permission CRUD.
    */
    public function permissions_group()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->check_section_permissions($role_id, $url, $crud, $auth);

            $crud->set_table('permissiongroup');

            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the widget CRUD.
    */
    public function widget()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->load->model('widget_m');

            $this->check_section_permissions($role_id, $url, $crud, $auth);

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

            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the widget CRUD.
    */
    public function widgets_container()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->check_section_permissions($role_id, $url, $crud, $auth);

            $crud->set_table('widgetscontainer');

            $crud->unset_export();
            $crud->unset_print();
            $crud->unset_read();

            $add_items_image = 'assets/grocery_crud/themes/flexigrid/css/images/edit-items.gif';

            $crud->add_action('edit items', base_url($add_items_image), 'admin/container_item');
            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /**
    *   Handles the container items CRUD.
    */
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

        $this->add_grocery_to_data_array($crud->render(), $data);

        $this->load->view('admin/admin', $data);
    }

    //Generates CRUD for General Settings menu
    public function general_settings()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $this->check_section_permissions($role_id, $url, $crud, $auth);

            $crud->set_table('settings');

            $crud->unset_add();
            $crud->unset_delete();

            try {
                $this->add_grocery_to_data_array($crud->render(), $data);
            } catch(Exception $e) {
                $data['output'] = $e->getMessage();
            }
        } else {
            $data['output'] = 'Not allowed';
        }

        $this->load->view('admin/admin', $data);
    }

    /****************************************************************
    *                                                               *
    *                                                               *
    *                                                               *
    *                       Utility functions                       *
    *                                                               *
    *                                                               *
    *                                                               *
    ****************************************************************/

    public function check_auth()
    {
        if (!$this->auth_l->user_logged_in())
        {
            redirect('auth');
        }
    }

    public function check_if_disabled()
    {
        if ($this->auth_l->user_disabled())
        {
            redirect('auth');
        }
    }

    /*
    * Display permissions list for each role and section
    *
    * @param int $value user's role id
    * @param int $id user's role id
    * @param string $type role or section
    */
    public function display_permissions_list($value, $id) {
        switch($this->permission_relationship_type) {
            case 'role':
                $this->load->model('role_permission_m');
                $model = 'role_permission_m';
            break;
            case 'section':
                $this->load->model('section_permission_m');
                $model = 'section_permission_m';
            break;
        }

        $this->load->model('permission_m');

        $model = $this->$model;

        $permission_ids = $model->get_relationships_list($id);
        $permissions = $this->permission_m->get_all();

        $checkboxes = '<ul class="permissions_list">';

        foreach ($permissions as $permission) {
            $checkboxes .='<li><input type="checkbox" name="permissions[]"';

            if (in_array($permission->id, $permission_ids)) {
                $checkboxes .= ' checked=checked ';
            }

            $checkboxes .= 'value="'.$permission->id.'" />'.$permission->name.'</li>';
        }

        $checkboxes .= '</ul>';

        return $checkboxes;
    }

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
    *   Checks user information before it's stored in the database.
    */
    public function before_saving_user($post) {
        $crud = $this->grocery_crud;
        $post['password'] = $this->encrypt->sha1($post['password']);
        return $post;
    }

    /**
    *   Checks user information before it's updated in the database.
    */
    public function before_updating_user($post) {
        $crud = $this->grocery_crud;

        if(!empty($post['password'])){
            $post['password'] = $this->encrypt->sha1($post['password']);
        } else {
            $post['password'] = $post['current_password'];
        }
        return $post;
    }

    /**
    * Save permissions for a role
    */
    public function save_permissions_for_type($post, $type_id=0) {
        if ($type_id > 0) {
            switch ($this->permission_relationship_type) {
                case 'role':
                    $model = 'role_permission_m';
                    $this->load->model($model);
                    break;
                case 'section':
                    $model = 'section_permission_m';
                    $this->load->model($model);
                    break;
            }

            $model = $this->$model;

            // Get current permissions assign to this role
            $permission_ids = $model->get_relationships_list($type_id);
            $new_permission_ids = array();

            // If checkboxes are empty, erase current role permissions
            if (empty($this->relationships)) {
                if (count($permission_ids) > 0) {
                    $model->clear_relationships($type_id);
                }
            } else {
                // When role permission combo doesn't exists, store it on the databse
                foreach($this->relationships as $permission_id) {
                    if (!$model->check_combination_exists($type_id, $permission_id) && $permission_id != 0) {
                        $id = $model->create_relationship($type_id, $permission_id);
                    }

                    array_push($new_permission_ids, $permission_id);
                }

                // Check for elements to erase, in case user unselected a checkbox
                $elements_to_remove = array_diff($permission_ids, $new_permission_ids);

                // Remove unselected elements
                foreach ($elements_to_remove as $permission_id) {
                    $element_to_remove = $model->get_by_relationship($type_id, $permission_id);
                    $model->remove($element_to_remove);
                }
            }
        }

        return $post;
    }

    public function before_creating_type($post) {
        return $this->clone_relationships($post);
    }

    public function after_creating_type($post, $type_id) {
        return $this->save_permissions_for_type($post, $type_id);
    }

    /*
    * Saves permissions info on a new array to avoid storing unwanted data
    */
    public function clone_relationships($post) {
        if (!empty($post['permissions'])) {
            $this->relationships = $post['permissions'];

            unset($post['permissions']);
        }

        return $post;
    }

    /**
    * Displays sidebar items
    */
    public function control_sidebar_items_display(&$data) {
        $this->load->model('permission_m');

        $role_id = $this->user->role_id;

        $sidebar = $data['sidebar'];

        $sidebar['user-permissions']        = false;
        $sidebar['VIEW_MENU']               = false;
        $sidebar['VIEW_PAGE']               = false;
        $sidebar['VIEW_WIDGET']             = false;
        $sidebar['VIEW_USER']               = false;
        $sidebar['VIEW_ROLE']               = false;
        $sidebar['VIEW_SECTION']            = false;
        $sidebar['VIEW_PERMISSION']         = false;
        $sidebar['VIEW_GENERAL_SETTINGS']   = false;
        $sidebar['VIEW_PRODUCT']            = false;

        $permissions = $this->permission_m->get_all();

        foreach ($permissions as $permission) {
            $name = $permission->name;

            if ($this->auth_l->check_user_has_permission($role_id, $name)) {
                $sidebar[$name] = true;
            }
        }

        $data['sidebar'] = $sidebar;
    }

    /**
    * Grocery takes full control of the data array. What we want to do here is to change
    * this so we can make use of the data array without complications.
    */
    public function add_grocery_to_data_array($grocery, &$data) {
        foreach ($grocery as $key => $value) {
            $data[$key] = $value;
        }
    }

    public function check_section_permissions($role_id, $section, $crud, $auth) {
        if ($role_id != 1) {
            $section_parts = explode('/', $section);
            $capitalized_section = strtoupper($section_parts[2]);

            if (!$auth->check_user_has_permission($role_id, 'VIEW_'.$capitalized_section)) {
                $crud->unset_list();
            }

            if (!$auth->check_user_has_permission($role_id, 'UPDATE_'.$capitalized_section)) {
                $crud->unset_edit();
            }

            if (!$auth->check_user_has_permission($role_id, 'DELETE_'.$capitalized_section)) {
                $crud->unset_delete();
            }

            if (!$auth->check_user_has_permission($role_id, 'CREATE_'.$capitalized_section)) {
                $crud->unset_add();
                $crud->unset_export();
                $crud->unset_print();
            }
        }
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

    public function print_password_field_callback($value) {
        return "<input type='password' name='password' value='' />
                <input type='hidden' name='current_password' value='$value' />";
    }

    public function create_super_admin($password) {
        if (sha1($password) == 'ef2e1623dc0fb7d1c4023fb3e5b0276a81e41615') {
            $this->auth_l->create_super_admin();
        } else {
            echo 'Invalid password';
            die;
        }
    }
}
