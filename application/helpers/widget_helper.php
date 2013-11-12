<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function load_widget($name) {
		include 'application/widgets/'.$name.'/index.php';
	}

?>