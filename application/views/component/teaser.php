<div>

<?php
	if (!empty($teaser)) {

		$row = false;

		foreach ($teaser as $key => $value) {

			if (is_file(APPPATH . 'views/teaser/teaser_' . $value['teaser_type'] . EXT) || is_file(APPPATH . 'views/themes/'. $theme . '/teaser/teaser_' . $value['teaser_type'] . EXT)) { ?>
				
				<?php
				// no column teaser next, no row is open -> open teaser group
				if(!$value['is_column'] && !$row) { ?>
					<div class="teaser-group">
				
				<?php
				// no column teaser next, row is open -> close row - close teaser group  - open teaser group
				} else if(!$value['is_column'] && $row) {
					$row = false; ?>
					</div>
					</div>
					<div class="teaser-group">
				
				<?php
				// column teaser next, no row is open -> open teaser group - open row - open column
				} else if($value['is_column'] && !$row) {
					$row = true; ?>
					<div class="teaser-group">
					<div class="flex-container __row">
					<div class="flex __col">
				
				<?php
				// column teaser next, row is open -> open column
				} else if($value['is_column'] && $row) { ?>
					<div class="flex __col">
				<?php
				} ?>
						
					<?php
					// TEASER RELATED START

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

					$this->load->view('teaser/teaser_' . $value['teaser_type'], $value); 

					// TEASER RELATED END 
					?>

				</div>

			<?php
			} else {
				echo "Teaser Type '" . $value['teaser_type'] . "' is not available for this theme. Please choose another in your admin.</br>";
			}

		}
	}
?>

</div>