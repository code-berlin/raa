<?php $CI =& get_instance();?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de" >
<head>

        <link charset='utf-8' href='<?php echo base_url('/application/css/main.css')?>' rel='stylesheet' type='text/css' />
	<title>RAA CMS FRONTEND</title>
</head>
<body>
    <div class="row">
        <div>
            RAA CMS FRONTEND
        </div>
        <div>
            Main Menu <br />
            <?php $CI->load_menu(1, 'horizontal_1'); ?>
        </div>
    </div>
    <div id="main-content">

    </div>
    <div class="row">
        <div>
            Future home of RAA
        </div>
        <div>
            Sidebar <br />
            <?php $CI->load_menu(2, 'sidebar_1'); ?>
        </div>
    </div>
    <div>
        Footer
    </div>
</body>
</html>