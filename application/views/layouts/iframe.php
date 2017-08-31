<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans%7CNunito+Sans" media="all">
    <link href="/assets/css/min/main.min.css?<?php echo filemtime(FCPATH . 'assets/css/min/main.min.css'); ?>" rel="stylesheet">
</head>
<body>
<div>
    <?php
    echo $template_content; // A template specific for the current page (can be set in the backend's Page section)
    ?>
</div>
</body>

</html>