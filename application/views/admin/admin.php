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
        
        <?php $this->load->view('admin/header');?>
       
       <div class="row-fluid">
       <?php $this->load->view('admin/left_navigation');?>   
        
       <div class="admin-right">
            <?php 
            if (isset($output)){
                echo $output; 
            } else {
                $this->load->view('admin/welcome');
            }
            ?>
       </div>
           
    </div>

        <?php $this->load->view('admin/footer');?>
 
    </div>    
  

 
    <script src="js/bootstrap.min.js"></script>    
</body>
</html>
