<div class="product-teaser">
	<div class="flexslider js-flexslider">
		<ul class="slides">

		<?php
		$order = explode(',', $page->productteaser_order);

		foreach ($order as $key => $value) {
			if (!isset($page->productteaser[$value])) continue; ?>
			<?php
			$teaser = $page->productteaser[$value]; ?>
			<li class="__item">
				<a href="<?php echo $teaser['link']; ?>">
					<div class="flex-container __info">
						<?php /*
						<div class="__img"><img src="/assets/uploads/files/<?php echo $teaser['image']; ?>"/></div>
						*/ ?>
						<div class="__img"><img src="/image/preview/auto/500/<?php echo $teaser['image']; ?>"/></div>


						<div class="flex __texts">
							<div class="__title"><?php echo $teaser['teaser_title']; ?></div>
							<div class="__text"><?php echo $teaser['teaser_text']; ?></div>
						</div>
					</div>
					<div class="__cta">
						<div class="def-btn _action">Zum Preisvergleich</div>
					</div>
				</a>
			 </li>
		<?php
		} ?>
		
		</ul>
	</div>
</div>