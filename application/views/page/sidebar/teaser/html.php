<?php
if ($commercial) {
    $this->load->view('page/sidebar/teaser/commercial');
}
if ($hasUrl) { ?>
    <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="teaser_sidebar_<?php echo $type; ?>">
<?php
} else { ?>
	<div class="teaser_sidebar_<?php echo $type; ?>">
<?php
} ?>
    <?php echo $html; ?>
<?php
if ($hasUrl) { ?>
    </a>
<?php
} else { ?>
	</div>
<?php
} ?>
