<div class="teaser-default js-teaser-collapsible">

    <?php

    $columns = 4;
    $initial_shown = 7;
    $show_collapsible_button = false;
    $i = 0;

    foreach ($items as $key => $value) {

        // open row
        if ($i%$columns == 0) { ?>
            <div class="flex-container __teaser-row<?php echo ($i > $initial_shown ? ' dn js-teaser-collapsible-closed' : '');?>"><?php
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

        <div class="__item flex <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>">

            <?php
            if (isset($slug)) { ?>
                <a href="<?php echo $slug; ?>" target="<?php echo $target; ?>" class="img _hover-mask">
            <?php
            } ?>

                <img class="lazy-img js-lazy-img" src="/assets/images/themes/<?php echo $theme; ?>/ph.png" data-src="<?php echo isset($image) ? $image : ''; ?>" class="_teaser-img" />

            <?php
            if (isset($slug)) { ?>
                </a>
            <?php
            } ?>

            <span class="flex-container _column">

                <?php
                if (isset($slug)) { ?>
                    <a href="<?php echo isset($slug) ? $slug: '#' ; ?>" target="<?php echo $target; ?>" class="__part __teaser-title">
                <?php
                } else { ?>
                    <div class="__part __teaser-title">
                <?php
                }

                    echo $value['title'];

                if (isset($slug)) { ?>
                    </a>
                <?php
                } else { ?>
                    </div>
                <?php
                } ?>

                <span class="__part __teaser-text flex"><?php echo $value['text']; ?></span>

                <?php
                if (isset($slug)) { ?>
                    <a href="<?php echo isset($slug) ? $slug: '#' ; ?>" target="<?php echo $target; ?>" class="__part __teaser-more">
                        Weiterlesen
                    </a>
                <?php
                } ?>

            </span>
        </div>

    <?php

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

        <div class="teaser-collapsible-box">

            <a href="" class="teaser-collapsible-btn js-teaser-collapsible-btn" >Weitere Inhalte anzeigen</a>

        </div>

    <?php

    }

    ?>

</div>