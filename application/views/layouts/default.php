<!DOCTYPE html>
<html>

  <?php $this->load->view('head'); ?>
  
  <body>
  	<?php
      $this->load->view('main_menu');
		  echo $template_content; // A template specific for the current page (can be set in the backend's Page section)
      $this->load->view('footer');
     	$this->load->view('scripts');
     	$this->load->view('facebook_scripts');
    ?>
  </body>

</html>