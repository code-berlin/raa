<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <meta name="description" content="<?php echo $seo_meta_description ?>" /> 
        <meta name="keywords" content="<?php echo $seo_meta_keywords ?>" />
        <title><?php echo $seo_meta_title ?></title>

        <link rel="stylesheet" href="/css/main.css" type="text/css" />
      
    </head>
    <body>
      <h1>This is the proof we are now using templates</h1>
        <div class="row">
            <div>
                Main Menu <br />
                <?php load_menu(1, 'horizontal_1'); ?>
            </div>
        </div>
        <div id="pagewidth" >
              <?php echo $template_content ?>
        </div>

        <div id="footer"> 
          <div>
              Footer 
          </div>
          <div> 
            <?php echo $seo_footer_text ?>
          </div>
        </div>

    </body>
</html>