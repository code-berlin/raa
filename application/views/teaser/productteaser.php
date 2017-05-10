<div class="product-teaser">
	<div class="__commercial">Anzeige</div>
	<div class="flexslider js-productteaser">
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
						<div class="__img-wrapper">
							<div class="__img">
								<img src="/image/preview/auto/500/<?php echo $teaser['image']; ?>"/>
							</div>
							<?php
							if (isset($teaser['image_caption'])) { ?>
								<div class="__caption img-sub">
									<?php echo $teaser['image_caption']; ?>
								</div>
							<?php
							}
							if (isset($teaser['duty_text'])) { ?>
								<div class="duty-text-trigger js-duty-text-trigger">Pflichttext</div>
								<div class="duty-text-content js-duty-text-content">
									<div class="duty-text-close js-duty-text-close"><i class="material-icons">&#xE5CD;</i></div>
									<b>Pflichttext</b><br>
									<?php echo $teaser['duty_text']; ?>
								</div>
							<?php
							} ?>
						</div>
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