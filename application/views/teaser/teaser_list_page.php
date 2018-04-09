<div class="teaser-default">

	<?php

	$columns = $lib_data['teaserColumns'];
	$i = 0;

	foreach ($lib_data['teaserItems'] as $key => $value) {

		// open row
		if ($i%$columns == 0) { ?>
			<div class="flex-container __teaser-row"><?php
		}

		$slug = base_url((isset($value['parent_slug']) && !empty($value['parent_slug']) ? $value['parent_slug'] . '/' : '') . $value['slug']);

		?>

		<div class="__item flex <?php echo $i+1 == sizeof($lib_data['teaserItems']) ? '_last' : ''; ?> js-teaser-linked">
			<div class="img _hover-mask">
				<?php
				if ($value['commercial']) { ?>
					<div class="__commercial">Anzeige</div> 
				<?php 
					}
                $this->load->view('component/lazyimg', array(
                    'src' => $img_placeholder,
                    'datasrc' => $value['image'],
                    'alt' => $value['image_alt']
                )); ?>
			</div>
			<span class="__info flex-container _column">
				<div class="__part __teaser-title">
					<?php $this->load->view('component/link',
                        array('href' =>  $slug, 'target' => '_self', 'text' => $value['menu_title'])); ?>
				</div>
				<span class="__part __teaser-text flex"><?php echo $value['teaser_text']; ?></span>
				<div class="__part __teaser-more">Weiterlesen</div>
			</span>
		</div>

	<?php

		$i++;

		// close row
		if ($i > 1 && $i%$columns == 0) { ?>
			</div> <?php
		}

	}

	// build dummy items to fill line
	while($i%$columns != 0) { 	
	?>
		<div class="__item _dummy flex"></div>
	<?php
		$i++;
		if ($i%$columns == 0) { ?>
			</div> 
	<?php
		}
	}

	?>

</div>
