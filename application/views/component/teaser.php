<?php 
	if (!empty($teaser)) {
		foreach ($teaser as $key => $value) {

			if (isset($value['title'])) {

		?>

			<h2 class="home-h2"><?php echo $value['title']; ?></h2>

		<?php

			}

			$this->load->view('teaser/teaser_' . $value['type'], $value);
		
		}
	}
?>	

<!--
<h2 class="home-h2">Tinnitus-Wissen</h2>

<?php $this->load->view('teaser/teaser_main'); ?>

<h2 class="home-h2">Tinnitus-Wissen</h2>

<?php $this->load->view('teaser/teaser_1_big_left_4_small_right'); ?>

<h2 class="home-h2">Ursachen für Tinnitus</h2>

<?php $this->load->view('teaser/teaser_default_dummy'); ?>

<h2 class="home-h2">Symptome und Diagnose</h2>

<?php $this->load->view('teaser/teaser_1_big_top_6_small_bottom'); ?>

<h2 class="home-h2">Tinnitus-Behandlung</h2>

<?php $this->load->view('teaser/teaser_default_dummy'); ?>

-->