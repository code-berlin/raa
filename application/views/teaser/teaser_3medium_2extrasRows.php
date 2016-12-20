<div class="teaser-3-medium-2-extra-rows js-teaser-collapsible">

<?php

    $columns = 3;
    $i = 0;

    $initial_shown = $columns;
    $show_collapsible_button = false;

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
        if ($i % $columns == 0) { ?>

            <div class="__minis flex-container flex<?php echo ($i >= $initial_shown ? ' dn js-teaser-collapsible-closed' : ''); ?>">

        <?php
        }

        if (isset($slug)) { ?>

            <a href="<?php echo $slug; ?>" target="<?php echo $target; ?>" class="__mini-item flex <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>">

        <?php
        } else { ?>

            <div class="__mini-item flex <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>">

        <?php
        } ?>

            <div class="__img">
                <img class="lazy-img js-lazy-img" src="<?php echo $img_placeholder; ?>" data-src="<?php echo isset($image) ? $image : ''; ?>" alt="<?php echo $value['title']; ?>">
            </div>
            <div class="__content">
              <?php
              if(isset($value['title'])) { ?>
                  <span class="__category">
                    <?php echo $value['parent_menu_title']; ?>
                  </span><br />
              <?php
              }

              if(isset($value['text'])) { ?>
                  <span class="__title">
                    <?php echo strip_tags($value['text']); ?>
                  </span>
              <?php
              } ?>
            </div>

            <?php
            if (isset($slug)) { ?>
                <div class="__part __teaser-more">
                    Weiterlesen
                </div>
            <?php
            } ?>

            <?php
        if (isset($slug)) { ?>
            </a>
        <?php
        } else { ?>
            </div>
        <?php
        } ?>

        <?php
        if ($i > $initial_shown) $show_collapsible_button = true;

        $i++;

        if ($i > 1 && $i % $columns == 0) { ?>

            </div>

        <?php
        } ?>

<?php
    }
?>

<?php
    // build dummy items to fill line
    while($i%$columns != 0) { ?>
        <div class="__mini-item _dummy flex"></div><?php
        $i++;
        if ($i%$columns == 0) { ?>
            </div> <?php
        }
    }

    if($show_collapsible_button == true) { ?>

        <div class="ta-c">
            <a href="" class="def-btn teaser-collapsible-btn js-teaser-collapsible-btn" >Weitere Inhalte anzeigen</a>
        </div>

<?php
    } ?>

</div>
