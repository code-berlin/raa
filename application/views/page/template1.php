<h1><?php echo $page->title ?></h1>

<p><?php echo $page->text ?></p>

<img src="/assets/uploads/files/<?php echo $page->image ?>" />

<!-- LOAD PREDEFINED CONTAINER -->
<?php widgets_container_load_container('Container #2'); ?>