<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF -8" />

    <title>RAA CMS</title>

    <?php
        if(isset($css_files)) {
            foreach($css_files as $file){
    ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php
            }
        }
    ?>

    <link href="<?php echo base_url('/assets/css/min/admin.min.css')?>" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container-fluid fill">
        <?php $this->load->view('admin/header');?>

        <div class="row-fluid">
            <?php $this->load->view('admin/left_navigation');?>

            <div class="admin-right">
            <?php
                if (isset($output)) {
                    echo $output;
                } else {
                    $this->load->view('admin/welcome');
                }
            ?>
            </div>
        </div>

        <?php $this->load->view('admin/footer');?>
    </div>

    <script src="<?php echo base_url('/assets/js/lib/jquery-1.11.0.min.js')?>"></script>
    <script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.min.js')?>"></script>

    <?php
        if(isset($js_files)){
            foreach($js_files as $file){
    ?>
                <script src="<?php echo $file; ?>"></script>
    <?php
            }
        }
    ?>
</body>
</html>
