<?php
	if (!empty($teaser)) {
		foreach ($teaser as $key => $value) {

			if (isset($value['title'])) {

		?>

			<h2 class="teaser-h2"><?php echo $value['title']; ?></h2>

		<?php

			}

			$this->load->view('teaser/teaser_' . $value['teaser_type'], $value);

		}
	}
?>