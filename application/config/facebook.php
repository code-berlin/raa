<?php

$config['facebook']['app_id'] = '';
$config['facebook']['app_secret'] = '';
$config['facebook']['app_path'] = ''; // like: https://apps.facebook.com/[name_of_the_app]

// Usually we need one extra permission at the beginning of any project: email.
// If more permissions are needed, they should be added below as comma-separated values.
$config['facebook']['permissions'] = 'email';