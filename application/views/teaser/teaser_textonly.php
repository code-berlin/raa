<div class="teaser-textonly">
	<?php	
	foreach ($items as $key => $value) { ?>
		<div class="__item">
			<div class="__title"><?php echo $value['title']; ?></div>
			<div class="__text"><?php echo $value['text']; ?></div>
		</div>
	<?php
	} ?>
</div>

