<h1><?php echo $product->title ?></h1>

<p><?php echo $product->text ?></p>

<img src="<?php echo '/' . $this->config->item('upload_folder') . '/' . $product->image ?>" />