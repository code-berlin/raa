<?php load_widget('weather'); ?>

<h1><?php echo $page->title ?></h1>

<p><?php echo $page->text ?></p>

<img src="/assets/uploads/files/<?php echo $page->image ?>" />

<!-- LOAD PREDEFINED CONTAINER -->

<?php load_widget('widget1'); ?>

<?php load_widget('widget2'); ?>
