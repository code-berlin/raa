<div class="teaser-slideshow js-teaser-slideshow">

    <?php
    // placeholder is important, because "jumpmark" functionality (link from other page) doesnt work without this
    ?>
    <img class="ph js-lazy-slideshow-placeholder" src="<?php echo $img_placeholder_slideshow; ?>">

    <div class="flexslider js-flexslider js-lazy-slideshow">
        <ul class="slides">

            <?php
            foreach ($items as $key => $value) {

                $target = '_self';
                $image = null;
                $slug = null;

                if ($value['content_type'] == 'external') {
                    $target = '_blank';
                }

                if (isset($value['external_image'])) {
                    $image = $value['external_image'];
                } else {
                    $image = $value['page_image'];
                }

                if (isset($value['external_link'])) {
                    $slug = $value['external_link'];
                } else if (isset($value['page_slug'])) {
                    $slug = base_url((isset($value['parent_slug']) && !empty($value['parent_slug']) ? $value['parent_slug'] . '/' : '') . $value['page_slug']);
                } ?>

                <li
                    data-thumb="<?php echo $img_placeholder_slideshow; ?>"
                    data-title="<?php echo isset($value['title']) ? $value['title'] : ''; ?>">

                <?php
                if (isset($slug)) { ?>
                    <a href="<?php echo $slug; ?>" target="<?php echo $target; ?>">
                <?php
                }

                    if (isset($value['title'])) { ?>
                        <div class="__title"><?php echo $value['title']; ?></div>
                    <?php
                    } ?>

                        <img
                            class="lazy-img js-slideshow-lazy-img"
                            src="<?php echo $img_placeholder_slideshow; ?>"
                            data-src="<?php echo isset($image) ? $image : ''; ?>" />

                <?php
                if (isset($slug)) { ?>
                        <span class="__readmore">
                            Zum Artikel
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </a>
                <?php
                } ?>

                </li>

            <?php
            } ?>

        </ul>
    </div>

</div>