<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de" >
<head>
    
    <link charset="utf-8" href="<?php echo base_url('/application/css/main.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('../assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" media="screen" />
	<title>RAA CMS</title>
</head>  
<body>
    
    <h1>Login</h1>

    <?php echo form_open('/auth/login'); ?>

        <?php echo form_label('Username', 'user_name'); ?>
        <?php echo form_input('user_name', set_value('user_name'),'id="user_name"'); ?>

        <?php echo form_label('Password', 'user_password'); ?>
        <?php echo form_password('user_password', '', 'id="user_password"'); ?>

        <?php

            $submit_attributes = array(
            'class' => 'btn btn-default',
            'value' => 'Login'
            );

        ?>

        <div>
            <?php echo form_submit($submit_attributes, 'submit'); ?>
        </div>

    <?php echo form_close(); ?>

    <div class="errors" style="color: red;">
        <?php echo validation_errors(); ?>
    </div>
 
    <script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>
