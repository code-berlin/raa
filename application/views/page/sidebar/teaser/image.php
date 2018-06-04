<?php
if ($commercial) {
    $this->load->view('page/sidebar/teaser/commercial');
} ?>
<a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="teaser_sidebar_<?php echo $type; ?>">
	<?php
    $this->load->view('component/lazyimg', array(
        'src' => $img_placeholder,
        'datasrc' => $image,
        'alt' => isset($image_alt) && !empty($image_alt) ? $image_alt : ''
    )); ?>
</a>