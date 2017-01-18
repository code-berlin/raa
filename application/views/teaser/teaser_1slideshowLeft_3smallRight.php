<div class="teaser-1-slideshow-left-3-small-right flex-container">

    <div class="slideshow-container flex _2">
        
        <?php
        // placeholder is important, because "jumpmark" functionality (link from other page) doesnt work without this
        ?>
        <img class="ph js-lazy-slideshow-placeholder" src="<?php echo $img_placeholder; ?>">

        <div class="flexslider js-flexslider js-lazy-slideshow">
            <ul class="slides">

                <?php
                $i = 0;
                $total_items = count($items);
                $total_right = 3;
                $total_slideshow = $total_items - $total_right;

                if($total_slideshow <= 0) {
                  $total_slideshow = 1;
                }

                foreach ($items as $key => $value) {

                    if($i < $total_slideshow) {

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
                            data-thumb="<?php echo $img_placeholder; ?>"
                            data-title="<?php echo isset($value['title']) ? $value['title'] : ''; ?>"
                        >

                        <?php
                        if (isset($slug)) { ?>
                            <a href="<?php echo $slug; ?>" target="<?php echo $target; ?>">
                        <?php
                        }

                        if (isset($value['title'])) { ?>
                            <div class="__info">
                              <span class="__title"><?php echo $value['title']; ?></span>
                              <span class="__text"><?php echo $value['text']; ?></span>
                            </div>
                        <?php
                        } ?>

                            <img
                                class="lazy-img js-slideshow-lazy-img"
                                src="<?php echo $img_placeholder; ?>"
                                data-src="<?php echo isset($image) ? $image : ''; ?>"
                            />

                        <?php
                        if (isset($slug)) { ?>
                            </a>
                        <?php
                        } ?>

                        </li>

                    <?php

                        $i++;

                    }

                } ?>

            </ul>
        </div>
    </div>

    <div class="__minis flex">

        <?php
        $i = 1;

        foreach ($items as $key => $value) {

            if($i > $total_slideshow) {

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
                        <img class="lazy-img js-lazy-img" src="<?php echo $img_placeholder; ?>" data-src="<?php echo isset($image) ? $image : ''; ?>" alt="<?php echo $value['title']; ?>">
                    </div>

                    <div class="__text flex">
                      <span class="category"><?php echo $value['title']; ?></span>

                      <span class="title"><?php echo $value['text']; ?></span>
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
            }

            $i++;
        } ?>
    </div>

</div>
