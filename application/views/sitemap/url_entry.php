<url>
	<loc><?= $loc ?></loc>
	<?php if(isset($lastmod)){ ?>
		<lastmod><?= $lastmod ?></lastmod>
	<?php } ?>
	<?php if(isset($changefreq)){ ?>
		<changefreq><?= $changefreq ?></changefreq>
	<?php } ?>
	<?php if(isset($priority)){ ?>
		<priority><?= $priority ?></priority>
	<?php } ?>
</url>