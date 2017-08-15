<a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="teaser_sidebar_<?php echo $type; ?>">
    <img
        class="lazy-img js-lazy-img"
        src="/assets/images/themes/<?php echo $theme; ?>/ph.png"
        data-src="<?php echo $image?>"
        alt="<?php echo (isset($image_alt) && !empty($image_alt)) ? $image_alt : ''; ?>"
    >
</a>