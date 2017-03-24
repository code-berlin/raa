Headline:<br />
<h1><?php echo $page->headline; ?></h1>
Text:<br />
<?php echo $page->text; ?>

<?php if (!empty($page->image)) { ?>
    Image:<br />
    <img src="<?php echo '/' . $this->config->item('upload_folder') . '/' . $page->image; ?>" alt="<?php echo $page->image_alt; ?>"/>
<?php } ?>
