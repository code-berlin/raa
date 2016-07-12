<div class="teaser-default js-teaser-collapsible">

    <?php

    $columns = 4;

    if (!empty($lib_data['teaserDefaultColumns'])) {
        $columns = $lib_data['teaserDefaultColumns'];
    }

    $initial_shown = $columns * 2;
    $show_collapsible_button = false;
    $i = 0;

    foreach ($items as $key => $value) {

        // open row
        if ($i%$columns == 0) { ?>
            <div class="flex-container __teaser-row<?php echo ($i >= $initial_shown ? ' dn js-teaser-collapsible-closed' : '');?>"><?php
        }

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

            <div class="img <?php echo isset($slug) ? '_hover-mask' : '' ?>">
                <img class="lazy-img js-lazy-img" src="/assets/images/themes/<?php echo $theme; ?>/ph.png" data-src="<?php echo isset($image) ? $image : ''; ?>" alt="<?php echo $value['title']; ?>"/>
            </div>

            <span class="__info flex-container _column">

                <div class="__part __teaser-title">
                    <?php echo $value['title']; ?>
                </div>

                <span class="__part __teaser-text flex"><?php echo $value['text']; ?></span>

                <?php
                if (isset($slug)) { ?>
                    <div class="__part __teaser-more">
                        Weiterlesen
                    </div>
                <?php
                } ?>

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

        // close row
        if ($i > 1 && $i%$columns == 0) { ?>
            </div> <?php
        }

    }

    if ($i > $initial_shown) $show_collapsible_button = true;

    // build dummy items to fill line
    while($i%$columns != 0) { ?>
        <div class="__item _dummy flex"></div><?php
        $i++;
        if ($i%$columns == 0) { ?>
            </div> <?php
        }
    }

    if ($show_collapsible_button == true) {

    ?>

        <div class="ta-c">
            <a href="" class="def-btn teaser-collapsible-btn js-teaser-collapsible-btn" >Weitere Inhalte anzeigen</a>
        </div>

    <?php

    }

    ?>

</div>