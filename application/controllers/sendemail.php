<?php
/**
 * Send email
 */
class Sendemail extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    /**
     * Send email from contact form
     */
    public function contact() {

        

        if(!$_POST){
            show_404();
        }

        $this->load->model('settings_m');

        $receiver = $this->settings_m->get_email();
        $sender_email = $this->input->post('email');
        $sender_name = $this->input->post('name');
        $message = $this->input->post('message');
        $url = $this->input->post('url');
        $subject = 'New message from the code-b website';
        
        // Check for the form with URL field (contact page)
        if (isset($url)) {
            if (!empty($url)) {
                $url = $url;
            } else {
                $url = "Not specified";
            }
            $message = $message."\n\nURL: ".$url;
        }

        // Email
        $this->email->from($sender_email, $sender_name);
        $this->email->to($receiver);
        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send()) {
            echo "Email sent";
        }

    }
}
