<div>

<?php
	if (!empty($teaser)) {

		$i = 0;
		$teaserCopy = $teaser;

		foreach ($teaser as $key => $value) {

			if (is_file(APPPATH . 'views/teaser/teaser_' . $value['teaser_type'] . EXT) || is_file(APPPATH . 'views/themes/'. $theme . '/teaser/teaser_' . $value['teaser_type'] . EXT)) { ?>
				
				<?php
				// GET PREV TEASER INSTANCE
				$_prev = false;
				if ($i > 0) {
					$_prev = prev($teaserCopy);
					next($teaserCopy);
				}

				// GET NEXT TEASER INSTANCE
				$_next = false;
				if ($i < (count($teaserCopy)-1)) {
					$_next = next($teaserCopy);
					prev($teaserCopy);
				}

				// OPEN GROUP IF ACTUAL TEASER IS NOT A COLUMN
				if(!$value['is_column']) { ?>
						<div class="teaser-group"> <?php
				} else {
					// OPEN ROW IF ACTUAL TEASER IS A COLUMN AND PREVIOUS NOT
					if(!$_prev['is_column']) { ?>
						<div class="teaser-group">
						<div class="flex-container __row"> <?php
					} 
						// OPEN COL IF ACTUAL TEASER IS A COLUMN ?>
						<div class="flex __col"> <?php
				} ?>

						<?php
						// RENDER TEASER CONTENT

						if (isset($value['jumpmark'])) { ?>
							<a name="jumpmark_<?php echo $value['jumpmark']; ?>"></a>
						<?php
						}

						if (isset($value['title'])) { ?>
							<h2 class="teaser-h2 teaser-h2-<?php echo $value['teaser_type']; ?>">
								<?php echo $value['title']; ?>
							</h2>
						<?php
						}

						if (isset($value['text'])) { ?>
							<h3 class="teaser-h3 teaser-h3-<?php echo $value['teaser_type']; ?>">
								<?php echo $value['text']; ?>
							</h3>
						<?php
						}

						$this->load->view('teaser/teaser_' . $value['teaser_type'], $value); 

						?>
							
						</div>
				
				<?php
				// CLOSE ROW IF ACTUAL TEASER IS COLUMN AND NEXT NOT
				if($value['is_column'] && !$_next['is_column']) { ?>
						</div>
						</div>
				<?php
				} ?>
					

			<?php
			} else {
				echo "Teaser Type '" . $value['teaser_type'] . "' is not available for this theme. Please choose another in your admin.</br>";
			}

			$i++;
			next($teaserCopy);

		} // foreach

	} // if 
?>

</div>