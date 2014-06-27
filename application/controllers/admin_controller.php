<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require('main_admin_controller.php');

class Admin_Controller extends Main_Admin_Controller {
    function __construct()
    {
        parent::__construct();

        $this->load->library('grocery_CRUD');
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
    *   Handles the facebook app CRUD.
    */
    public function facebook_app()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            // Facebook post on page test
            /*$facebook = $this->facebook_api;

            $facebook->update_facebook_config(array(
                'appId' => 792724064078078,
                'secret' => 'a71ac94ecb76cf4c928538bc2261b921',
                'cookie' => true
            ));

            $facebook->update_facebook_object();

            $user = $facebook->check_facebook_user();

            if ($user > 0) {
                $facebook->load_user_pages();
                $user_pages = $facebook->get_user_pages();

                foreach($user_pages as $id => $page) {
                    $message = 'This is a test message from RAACMS.';
                    //$facebook->post_on_page($id, $message, $page['access_token']);
                }
            } else {
                $this->get_log_url($user);
                die;
            }*/
            // Facebook post on page test

            $crud->set_table('facebookapp');

            // Fields to show on the list
            $crud->columns('app_name','app_id','status');
            $crud->display_as('app_name', 'Facebook app Name');
            $crud->display_as('app_id', 'Facebook app ID');
            $crud->display_as('app_secret', 'Facebook app secret');
            $crud->display_as('user_id', 'Related user');

            $crud->set_relation('user_id','user','name');

            $crud->add_action('Check credentials', base_url('/assets/grocery_crud/themes/flexigrid/css/images/load.png'), 'admin/check_facebook_credentials');

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
    *   Handles the facebook pages CRUD.
    */
    public function facebook_page()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            $crud->set_table('facebookpage');

            // Fields to show on the list
            $crud->columns('page_name','page_id','facebookapp_id');
            $crud->fields('page_name','page_id','facebookapp_id', 'user_id', 'page_image', 'status');

            $crud->display_as('page_name', 'Facebook page Name');
            $crud->display_as('page_id', 'Facebook page ID');
            $crud->display_as('page_image', 'Image');
            $crud->display_as('user_id', 'Related user');
            $crud->display_as('facebookapp_id', 'Facebook app name');

            $crud->set_relation('facebookapp_id','facebookapp','app_name');
            $crud->set_relation('user_id','user','name');

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
    * User profile
    */
    public function profile() {
        $this->check_section_permissions();

        $this->load->model('user_m');
        $this->load->model('language_m');
        $this->load->model('role_m');

        $data['left_navigation'] = $this->admin_navigation->getSidebarMenu();

        $data['user'] = $this->user;
        $data['language'] = $this->language_m->get_by_id($this->user->language_id);
        $data['role'] = $this->role_m->get_by_id($this->user->role_id);
        $data['is_edit_section'] = false;
        $data['user_can_edit_profile'] = $this->role_m->can_edit_profile($this->user->role_id);

        $this->load->view('admin/custom_user', $data);
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

            $crud->unset_export();
            $crud->unset_print();
            $crud->unset_read();

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
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {

            $crud = $this->grocery_crud;

            $crud->set_table('widgetscontainersrelation');

            $crud->columns('widget_id', 'widget_position');

            $crud->where('widgets_container_id', $id);

            $crud->set_relation('widget_id','widget','widgetname');
            $crud->display_as('widget_id','Widget');
            $crud->display_as('widget_position','Position');


            $crud->field_type('widgets_container_id', 'hidden');

            $_POST['widgets_container_id'] = $id;

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

            $crud->display_as('page_id','Homepage');
            $crud->set_relation('page_id','page','title');

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
}
