<?php
	if (!empty($teaser)) {
		foreach ($teaser as $key => $value) {

			if (isset($value['jumpmark'])) { ?>
				<span id="jumpmark_<?php echo $value['jumpmark']; ?>"></span>
			<?php
			}

			if (isset($value['title'])) { ?>
				<h2 class="teaser-h2"><?php echo $value['title']; ?></h2>
			<?php
			}

			if (isset($value['text'])) { ?>
				<h3 class="teaser-h3"><?php echo $value['text']; ?></h3>
			<?php
			}

			$this->load->view('teaser/teaser_' . $value['teaser_type'], $value);

		}
	}
?>