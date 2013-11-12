<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function load_widget($name) {
		if (file_exists('application/widgets/'.$name.'/index.php')) {
			include 'application/widgets/'.$name.'/index.php';
		}
	}

?>