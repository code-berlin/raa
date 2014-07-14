<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Admin_Controller extends CI_Controller {
    protected $user;

    function __construct()
    {
        parent::__construct();

        $this->load->model('user_m');
        $this->load->model('role_permission_m');

        $this->load->library('auth_l');

        $this->check_auth();
        $this->check_if_disabled();

        $this->user = $this->user_m->get_by_username($this->session->userdata('user_name'));
        $this->role_id = $this->user->role_id;
        $this->url = $_SERVER['REQUEST_URI'];

        // Save role permissions from post into an array
        $this->relationships = array();
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

    public function update_facebook_app_config($application_internal_id=0) {
        $this->facebook_api->update_facebook_config(array(
            'appId' => 792724064078078,
            'secret' => 'a71ac94ecb76cf4c928538bc2261b921',
            'cookie' => true
        ));

        $this->facebook_api->update_facebook_object();
    }

    public function check_facebook_credentials($application_internal_id=0) {
        $this->update_facebook_app_config();

        $this->facebook_api->check_credentials();
    }

    public function get_log_url($user) {
        $url = $this->facebook_api->get_status_url($user);

        header('Location: '.$url);
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
        $sidebar['VIEW_WIDGETS']             = false;
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

    public function check_section_permissions($crud = null) {
        // If user is not superadmin, check permissions.
        if ($this->role_id != SUPERADMIN_ID) {
            $section_parts = explode('/', $this->url);
            $capitalized_section = strtoupper($section_parts[2]);

            if (!$this->auth_l->check_user_has_permission($this->role_id, 'VIEW_' . $capitalized_section)) {
                if ($crud) {
                    $crud->unset_list();
                }
            }

            if (!$this->auth_l->check_user_has_permission($this->role_id, 'UPDATE_' . $capitalized_section)) {
                if ($crud) {
                    $crud->unset_edit();
                }
            }

            if (!$this->auth_l->check_user_has_permission($this->role_id, 'DELETE_' . $capitalized_section)) {
                if ($crud) {
                    $crud->unset_delete();
                }
            }

            if (!$this->auth_l->check_user_has_permission($this->role_id, 'CREATE_' . $capitalized_section)) {
                if ($crud) {
                    $crud->unset_add();
                    $crud->unset_export();
                    $crud->unset_print();
                }
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
        if (sha1($password) == '0dd24ff18c4158eef0bd06e148088bf679cd415d') {
            $this->auth_l->create_super_admin();
        } else {
            echo 'Invalid password';
            die;
        }
    }


    /**
    * Saves the user profile
    */
    public function save_user_profile() {
        $this->load->model('user_m');
        $this->load->model('role_m');

        $this->load->library('form_validation');

        $redirection_url = '/admin/profile';

        $post = $this->input->post();
        $id = $post['id'];
        $can_edit = $this->role_m->can_edit_profile($this->user->role_id);

        if ($id == $this->user->id && $can_edit) {
            $user = (!empty($id) && $id > 0) ? $this->user_m->get_by_id($id) : $this->user_m->create();

            $this->form_validation->set_rules('name', 'name', 'required|xss_clean');
            $this->form_validation->set_rules('surname', 'surname', 'required|xss_clean');
            $this->form_validation->set_rules('nickname', 'nickname', 'xss_clean');
            $this->form_validation->set_rules('email', 'email', 'required|xss_clean|valid_email|callback_check_email_is_unique');

            if (!empty($post['password'])) {
                if ($post['password'] == $post['confirm_password']) {
                    $user->password = sha1($post['password']);
                } else {
                    $this->session->set_flashdata('passwords_match', "Passwords don't match");
                    $redirection_url = '/admin/profile/edit';
                }
            }

            if ($this->form_validation->run()) {
                $excluded_fields = array('password', 'confirm_password', 'delete_image');

                // Set user profile
                foreach ($post as $field => $value) {
                    if (!in_array($field, $excluded_fields)) {
                        $user->{$field} = $value;
                    }
                }

                // Upload image
                $this->load->library('upload', array(
                    'upload_path' => './assets/uploads/',
                    'allowed_types' => 'gif|jpg|png',
                    'max_size' => '10000'
                ));

                if ($this->upload->do_upload()) {
                    $uploaded_file = $this->upload->data();

                    $user->image = $uploaded_file['file_name'];
                }

                // Delete image
                if ($post['delete_image'] > 0) {
                    $user->image = '';
                }

                $this->user_m->save($user);

                // Set language.
                // Change email value in session, otherwise everything will crash.

                $this->session->set_userdata(array(
                    'email' => $post['email']
                ));
            } else {
                $this->session->set_flashdata('errors', $this->form_validation->error_array());
                $redirection_url = '/admin/profile/edit';
            }
        }

        redirect($redirection_url);
    }
}
