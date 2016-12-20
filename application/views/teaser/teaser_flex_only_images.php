<div class="teaser-flex-only-images flex-container">

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
        } ?>

        <?php
        if (isset($slug)) { ?>
            <a href="<?php echo $slug; ?>" target="<?php echo $target; ?>" class="__item flex <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>">
        <?php
        } else { ?>
            <div class="__item flex <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>">
        <?php
        } ?>

            <div class="__img <?php echo isset($slug) ? '_hover-mask' : '' ?>">
                <img src="/image/preview/512/328/<?php echo isset($image) ? $image : ''; ?>" alt="<?php echo $value['title']; ?>"/>
            </div>

            <span class="__title">
                <?php echo $value['title']; ?>
            </span>

        <?php
        if (isset($slug)) { ?>
            </a>
        <?php
        } else { ?>
            </div>
        <?php
        }

        $i++;

    } ?>

</div>
