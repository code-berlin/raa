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
            $this->check_section_permissions($crud);

            $crud->set_table('page');

            // Fields to show on the list
            $crud->columns('menu_title', 'slug', 'menu_order', 'published');

            // Fields to show when editing
            $crud->edit_fields('template_id', 'parent_id','main_category', 'menu_order', 'menu_title', 'teaser_text', 'text', 'date', 'image', 'slug', 'published', 'id', 'seo_meta_keywords', 'seo_meta_title', 'seo_meta_description', 'seo_footer_text');

            $crud->field_type('id', 'hidden');
            $crud->field_type('date', 'hidden');

            // Set relations using foreign keys
            $crud->set_relation('template_id','template','name');
            $crud->set_field_upload('image','assets/uploads/files');

            $crud->display_as('template_id','Template');
            $crud->display_as('main_category','Is parent');

            $crud->set_relation('parent_id','page','slug');
            $crud->display_as('parent_id','Parent section');

            if ($auth->check_user_has_permission($role_id, 'EDIT_TEASER')) {
                $crud->add_action('Teaser Verwaltung --- Icons made by Freepik from www.flaticon.com is licensed by CC BY 3.0', '/assets/images/screen114.png', site_url('admin/teaser_instance') . '/');
            }

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

            $this->check_section_permissions($crud);

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

            $this->check_section_permissions($crud);

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
            $crud->set_rules('username','Username','required');
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

        $this->control_sidebar_items_display($data);

        $this->load->model('user_m');
        //$this->load->model('language_m');
        $this->load->model('role_m');

        $data['user'] = $this->user;
        $data['role'] = $this->role_m->get_by_id($this->user->role_id);
        $data['is_edit_section'] = false;
        $data['user_can_edit_profile'] = $this->role_m->can_edit_profile($this->user->role_id);

        $this->load->view('admin/custom_user', $data);
    }

    /**
    * Edits the profile info.
    */
    public function profile_edit() {
        $this->check_section_permissions();

        $this->control_sidebar_items_display($data);

        $this->load->model('user_m');
        //$this->load->model('language_m');

        $data['user'] = $this->user;
        $data['is_edit_section'] = true;
        $data['errors'] = $this->session->flashdata('errors');

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

            $this->check_section_permissions($crud);

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

            $this->check_section_permissions($crud);

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

            $this->check_section_permissions($crud);

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

            $this->check_section_permissions($crud);

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

            $this->check_section_permissions($crud);

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

            $this->check_section_permissions($crud);

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

            $this->check_section_permissions($crud);

            $crud->set_table('settings');

            $crud->display_as('page_id','Homepage');
            $crud->set_relation('page_id','page','menu_title');

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

    /**
    *   Handles the page CRUD.
    */
    public function teaser_instance($page_id)
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            // Page permissions
            $this->check_section_permissions($crud);

            $crud->set_table('teaser_instance');

            $crud->where('page_id', $page_id);

            // Fields to show on the list
            $crud->columns('title', 'text', 'position', 'published');

            $crud->add_action('Teaser Item Verwaltung --- Icons made by Freepik from www.flaticon.com is licensed by CC BY 3.0', '/assets/images/tabs.png', site_url('admin/teaser_item') . '/');

            $crud->add_fields('id', 'page_id', 'teaser_types_id', 'title', 'text', 'position', 'published');
            $crud->edit_fields('id', 'page_id', 'teaser_types_id', 'title', 'text', 'position', 'published');

            // add page relation
            $this->load->model('teaser_m');
            $teaser_types = $this->teaser_m->get_all_teaser_types();
            $teaser_types_array = array();
            foreach ($teaser_types as $key => $value) {
                $teaser_types_array[$value['id']] = $value['name'];
            }

            $crud->field_type('teaser_types_id','dropdown',
                $teaser_types_array);

            $crud->field_type('published','true_false', array('1' => 'Yes', '0' => 'No'));
            $crud->field_type('page_id', 'hidden', $page_id);
            $crud->field_type('id', 'hidden');

            $crud->set_rules('teaser_types_id','Teaser Type','required');

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
    *   Handles the page CRUD.
    */
    public function teaser_item($teaser_instance_id)
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            // Page permissions
            $this->check_section_permissions($crud);

            $crud->set_table('teaser_item');

            $crud->where('teaser_instanceId', $teaser_instance_id);

            // Fields to show on the list
            $crud->columns('title', 'text', 'position', 'published');

            // add page relation
            $this->load->model('page_m');
            $pages = $this->page_m->get_all();
            $pages_array = array();
            foreach ($pages as $key => $value) {
                $pages_array[$value['id']] = $value['menu_title'];
            }

            $crud->field_type('contentId','dropdown',
                $pages_array);

            // add page relation
            $this->load->model('teaser_m');
            $teaser_instance = $this->teaser_m->get_teaser_instance_by_id($teaser_instance_id);

            $teaser_type = $this->teaser_m->get_teaser_type_by_id($teaser_instance['teaser_types_id']);

            if ($teaser_type['field_amount'] > 0) {
                $teaser_items_count = $this->teaser_m->count_teaser_items($teaser_instance_id);
                if ($teaser_items_count >= $teaser_type['field_amount']) {
                   $crud->unset_add();
               }
            }

            $crud->field_type('id', 'hidden');
            $crud->field_type('teaser_instanceId', 'hidden', $teaser_instance_id);
            $crud->field_type('content_type', 'hidden', 'page');

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
    *   Handles the page CRUD.
    */
    public function sidebar_teaser()
    {
        $this->control_sidebar_items_display($data);

        $auth = $this->auth_l;
        $role_id = $this->user->role_id;
        $url = $_SERVER['REQUEST_URI'];

        if ($auth->check_section_access_required_permissions($role_id, $url)) {
            $crud = $this->grocery_crud;

            // Page permissions
            $this->check_section_permissions($crud);

            $crud->set_table('sidebar_teaser');

            // Fields to show on the list
            $crud->columns('id', 'text', 'image', 'url', 'published');           

            $crud->field_type('id', 'hidden');

            $crud->field_type('published','true_false', array('1' => 'Yes', '0' => 'No'));

            $crud->set_field_upload('image','assets/uploads/files');

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
