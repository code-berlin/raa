<a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="teaser_sidebar_<?php echo $type; ?>">
    
    <?php
    if (isset($image) && !empty($image)) { ?>
        <img
            class="lazy-img js-lazy-img"
            src="/assets/images/themes/<?php echo $theme; ?>/ph.png"
            data-src="<?php echo $image?>"
            alt="<?php echo (isset($image_alt) && !empty($image_alt)) ? $image_alt : '' ?>"
        >
    <?php
    }

    if ((isset($title) && !empty($title)) || (isset($text) && !empty($text))) { ?>
    
        <div class="__texts">
            <?php
            if (isset($title) && !empty($title)) { ?>
                <div class="__title"><?php echo $title; ?></div>
            <?php
            }
            if (isset($text) && !empty($text)) { ?>
                <div class="__text"><?php echo $text; ?></div>
            <?php
            } ?>
        </div>

    <?php
    } ?>

</a>