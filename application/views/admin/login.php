<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de" >
<head>
    <title>RAACMS</title>

    <link charset="utf-8" href="<?php echo base_url('/assets/css/admin.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="login-container">
        <h1>RAACMS</h1>

        <?php echo form_open('/auth/login'); ?>

            <?php echo form_label('Email', 'username'); ?>
            <?php echo form_input('username', set_value('username'),'id="username"'); ?>

            <?php echo form_label('Password', 'password'); ?>
            <?php echo form_password('password', '', 'id="password"'); ?>

            <?php
                $submit_attributes = array(
                    'class' => 'btn btn-info',
                    'value' => 'Login'
                );
            ?>

            <div>
                <?php echo form_submit($submit_attributes, 'submit'); ?>
            </div>

        <?php echo form_close(); ?>

        <?php $validation_errors = validation_errors(); ?>
        <?php if (!empty($validation_errors) || !empty($disabled_message) || !empty($wrong_credentials)) { ?>
            <div class="alert alert-danger">
                <?php
                    if (isset($validation_errors) && !empty($validation_errors)) {
                        echo $validation_errors;
                    }

                    if (isset($disabled_message) && !empty($disabled_message)) {
                        echo $disabled_message;
                    }

                    if (isset($wrong_credentials) && !empty($wrong_credentials)) {
                        echo $wrong_credentials;
                    }
                ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>
