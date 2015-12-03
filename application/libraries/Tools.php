<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
Library with useful tools for the development process:
   T                                    \`.    T
   |    T     .--------------.___________) \   |    T
   !    |     |////TOOLS/////_________[ ]   !  T |
        !     `--------------'           ) (      | !
                                         '-'      !
*/

class Tools {
    private $ci;

    public function __construct(){
        $this->ci =& get_instance();
    }

    /*
    * Debugs content with style ;)
    */
    public function d($content) {
        echo '<pre>';
        var_dump($content);
        echo '</pre>';
    }

    /**
    * Provides basic CI functionality for picture uploads.
    * This should be adapted for another type of files as well.
    *
    * @return array upload info
    */
    public function upload_image() {
        // Upload class config
        $config['upload_path'] = './assets/uploads/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 3000000;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;

        // CI upload class
        $this->ci->load->library('upload', $config);

        // Attempt to upload an image
        if (!$this->ci->upload->do_upload()) {
            $result['message'] = $this->ci->upload->display_errors();
            $this->ci->session->set_flashdata('response', $result);
            return $result['message'];
        }

        return $this->ci->upload->data();
    }

    public function get_language_value() {
        $session = $this->ci->session->userdata('language');

        $language = (!empty($session)) ? $session : $this->ci->config->item('language_abbr');

        return $language;
    }

    public function set_language_value($language) {
        $ci = $this->ci;
        $cleansed_language = $ci->security->xss_clean($language);
        $ci->session->set_userdata('language', $cleansed_language);
    }

    public function show_not_implemented_page() {
        header('HTTP/1.0 501 Not Implemented');

        return $this->ci->layout->view('errors/501');
    }
}