<h1>gmap</h1>

type: <?php echo $type; ?>
<br /><br />
menu_title: <?php echo $page->menu_title; ?>
<br /><br />
headline: <?php echo $page->headline; ?>
<br /><br />
id: <?php echo $page->id; ?>
<br /><br />
text: <?php echo $page->text; ?>

<input class="js-map-embed-search-input" type="text">

<a href="" class="js-map-embed-search-btn">search</a>

<div class="js-map-embed-key" data-key="<?php echo $template_data['api_key']; ?>"></div>
<div class="js-map-embed-phrase" data-phrase="Apotheken near"></div>

<iframe width="600" height="450" frameborder="0" style="border:0" class="js-map-container"
src="" allowfullscreen></iframe>

