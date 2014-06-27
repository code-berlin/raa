<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de" >
<head>
    <title>RAACMS</title>

    <link charset="utf-8" href="<?php echo base_url('/application/css/admin.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('../assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" media="screen" />
</head>
<body>
    <div class="login-container">
        <h1>RAACMS</h1>

        <?php echo form_open('/auth/login'); ?>

            <?php echo form_label('Email', 'email'); ?>
            <?php echo form_input('email', set_value('email'),'id="email"'); ?>

            <?php echo form_label('Password', 'user_password'); ?>
            <?php echo form_password('user_password', '', 'id="user_password"'); ?>

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

        <div class="errors" style="color: red;">
            <?php
                echo validation_errors();

                if (isset($disabled_message) && !empty($disabled_message))
                {
                    echo '<div class="alert alert-danger">' . $disabled_message . '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>
