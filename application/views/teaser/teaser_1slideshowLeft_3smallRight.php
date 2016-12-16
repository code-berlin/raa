<div class="teaser-1-slideshow-left-3-small-right">

    <?php
    // placeholder is important, because "jumpmark" functionality (link from other page) doesnt work without this
    ?>
    <img class="ph js-lazy-slideshow-placeholder" src="<?php echo $img_placeholder_teaser_slideshow_left; ?>">

    <div class="slideshow-container">
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
                        data-thumb="<?php echo $img_placeholder_teaser_slideshow_left; ?>"
                        data-title="<?php echo isset($value['title']) ? $value['title'] : ''; ?>"
                    >

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
                            src="<?php echo $img_placeholder_teaser_slideshow_left; ?>"
                            data-src="<?php echo isset($image) ? $image : ''; ?>"
                        />

                    </li>

                <?php
                } ?>

            </ul>
        </div>
    </div>

    <div class="__minis">

        <?php
        $i = 0;

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
            }

            ?>
                <?php
                if (isset($slug)) { ?>
                    <a href="<?php echo $slug; ?>" class="__mini-item flex-container" target="<?php echo $target; ?>">
                <?php
                } else { ?>
                    <div class="__mini-item flex-container">
                <?php
                } ?>

                <div class="__img">
                    <img class="lazy-img js-lazy-img" src="<?php echo $img_placeholder_teaser_smalls_right; ?>" data-src="<?php echo isset($image) ? $image : ''; ?>" alt="<?php echo $value['title']; ?>">
                </div>

                <div class="__text">
                  <span class="category">Category Name</span>

                  <span class="title"><?php echo $value['title']; ?></span>
                </div>

                <?php
                if (isset($slug)) { ?>
                    </a>
                <?php
                } else { ?>
                    </div>
                <?php
                } ?>

            <?php
            $i++;
        } ?>
    </div>

</div>
