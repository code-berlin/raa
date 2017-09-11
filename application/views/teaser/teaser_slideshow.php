<div class="teaser-slideshow js-teaser-slideshow">

    <?php
    // placeholder is important, because "jumpmark" functionality (link from other page) doesnt work without this
    ?>
    <img class="ph js-lazy-slideshow-placeholder" src="<?php echo $img_placeholder_slideshow; ?>">

    <div class="flexslider js-flexslider js-lazy-slideshow">
        <ul class="slides">

            <?php
            foreach ($items as $key => $value) { ?>
                
                <li
                    data-thumb="<?php echo $img_placeholder_slideshow; ?>"
                    data-title="<?php echo isset($value['title']) ? $value['title'] : ''; ?>">

                    <div class="__inner js-teaser-linked">
                    
                    <?php
                    if (isset($value['title'])) { ?>
                        <div class="__title">
                            <?php
                            if ($value['slug'] !== '') { ?>
                                <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
                            <?php
                            }
                                    echo $value['title'];

                            if ($value['slug'] !== '') { ?>
                                </a>
                            <?php
                            } ?>
                        </div>
                    <?php
                    } ?>

                        <img
                            class="lazy-img js-slideshow-lazy-img"
                            src="<?php echo $img_placeholder_slideshow; ?>"
                            data-src="<?php echo isset($value['image']) ? $value['image'] : ''; ?>" />

                    <?php
                    if ($value['slug'] !== '') { ?>
                        <span class="__readmore">
                            Zum Artikel
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    <?php
                    } ?>

                    </div>

                </li>

            <?php
            } ?>

        </ul>
    </div>

</div>