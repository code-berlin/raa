<?php
class Image extends CI_Controller {

    function __construct() {
        parent::__construct();     
    }

    function preview($x, $y, $image, $refresh = false) {

    	// fetch parameter via get, thus . in directory names is forbidden by CI
    	$sixe_x =  $x;
	    $sixe_y =  $y;

    	// image structure of raa is $this->config->item('upload_folder') /20a04-behandlung.jpg
    	if (isset($x) && isset($y) && isset($image)) {

	    	$media_FS_path = FCPATH . $this->config->item('upload_folder') . '/';
	    	$thumb_FS_path = FCPATH . 'assets/uploads/thumbs/';

			$thumb_FS = $thumb_FS_path . $sixe_x . '-' . $sixe_y . '-' . $image;
	    	$img_FS = $media_FS_path . $image;
	    	
	    	if (!file_exists($thumb_FS) || $refresh == 'true') {

	    		if (file_exists($img_FS) && !is_dir($img_FS)) {

	    			$config['image_library'] = 'gd2';
	    			$config['source_image']	= $img_FS;
	    			$config['new_image'] = $thumb_FS;
	        		$config['width'] = $sixe_x;
	        		$config['height'] = $sixe_y;
	        		$config['create_thumb'] = FALSE;
	       	 		$config['maintain_ratio'] = false;

	    			$this->load->library('image_lib', $config);

	    			if (!$this->image_lib->resize()) {
					    echo $this->image_lib->display_errors();
					    exit;
					}

	    		}

	    	}



	    	if (file_exists($thumb_FS)) {	

	    		$imginfo = getimagesize($thumb_FS);
				header("Content-type: " . $imginfo['mime']);
				readfile($thumb_FS);
				exit;

	    	} 

    	} 
    		
    	// no thumb available, send empty 1x1 px png
    	header('Content-Type: image/png');
		echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');

    }    

}