<a class="__teaser <?php echo $css; ?>" href="<?php echo $slug; ?>" target="<?php echo $target; ?>">
    <div class="js-image-and-dropdown-title"><?php echo $value['title']; ?></div>
        <div class="__img">
            <img
                class="lazy-img js-lazy-img js-image-and-dropdown-img"
                src="<?php echo $img_placeholder; ?>"
                data-src="<?php echo isset($image) ? $image : ''; ?>"
                alt="<?php echo $value['title']; ?>"
            />
        </div>
    <div class="js-image-and-dropdown-text"><?php echo $value['text']; ?></div>
</a>