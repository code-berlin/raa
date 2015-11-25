<?php if ($page): ?>

<h1><?php echo $page->title ?></h1>

<p><?php echo $page->text ?></p>

<img src="<?php echo '/' . $this->config->item('upload_folder') . '/' . echo $page->image ?>" />

<?php endif; ?>