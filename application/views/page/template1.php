<h1><?php echo $page->title ?></h1>

<p><?php echo $page->text ?></p>

<img src="<?php echo '/' . $this->config->item('upload_folder') . '/' . $page->image ?>" />

<!-- Load predefined container -->
<?php load_widgets_container('Container'); ?>

<?php load_widget('example-widget'); ?>
