<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de" >
<head>

    <?php
    // css & js for grocery
    if(isset($css_files)){
        foreach($css_files as $file){ ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php }
    }
    if(isset($js_files)){
        foreach($js_files as $file){ ?>
            <script src="<?php echo $file; ?>"></script>
        <?php }
    }?>

    <link charset="utf-8" href="<?php echo base_url('/application/css/main.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('../assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" media="screen" />
    <title>RAA CMS</title>
</head>
<body>

<div class="container-fluid fill">

   <?php echo $migration_string; ?>

   <?php $this->load->view('admin/footer');?>

</div>

<script src="https://code.jquery.com/jquery.js"></script>
<script src="<?php echo base_url('../assets/bootstrap/js/bootstrap.min.js')?>"></script>
</body>
</html>