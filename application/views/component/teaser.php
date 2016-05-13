<div>

<?php
	if (!empty($teaser)) {
		foreach ($teaser as $key => $value) {

			if (is_file(APPPATH . 'views/teaser/teaser_' . $value['teaser_type'] . EXT) || is_file(APPPATH . 'views/themes/'. $theme . '/teaser/teaser_' . $value['teaser_type'] . EXT)) { ?>

				<div class="teaser-group">

					<?php
					if (isset($value['jumpmark'])) { ?>
						<a name="jumpmark_<?php echo $value['jumpmark']; ?>"></a>
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

					$this->load->view('teaser/teaser_' . $value['teaser_type'], $value); ?>

				</div>

			<?php
			} else {
				echo "Teaser Type '" . $value['teaser_type'] . "' is not available for this theme. Please choose another in your admin.";
			}

		}
	}
?>

</div>