<div class="teaser-3-medium-2-extra-rows js-teaser-collapsible">

<?php

    $columns = 3;
    $i = 0;

    $initial_shown = $columns;
    $show_collapsible_button = false;

    foreach ($items as $key => $value) {
        
        if ($i % $columns == 0) { ?>

            <div class="__minis flex-container flex<?php echo ($i >= $initial_shown ? ' dn js-teaser-collapsible-closed' : ''); ?>">

        <?php
        }

        if ($value['slug'] !== '') { ?>

            <a
                href="<?php echo $value['slug']; ?>"
                target="<?php echo $value['target']; ?>"
                class="__mini-item flex <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>"
            >

        <?php
        } else { ?>

            <div class="__mini-item flex <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>">

        <?php
        } ?>

            <div class="__img">
                <img
                    class="lazy-img js-lazy-img"
                    src="<?php echo $img_placeholder; ?>"
                    data-src="<?php echo isset($value['image']) ? $value['image'] : ''; ?>"
                    alt="<?php echo $value['title']; ?>"
                />
            </div>
            <div class="__content">

                <div class="__inner"> 

                    <?php
                    if(isset($value['title'])) { ?>
                        <div class="__category">
                          <?php echo $value['parent_menu_title']; ?>
                        </div>
                    <?php
                    }

                    if(isset($value['text'])) { ?>
                        <div class="__title">
                            <?php echo strip_tags($value['text']); ?>
                        </div>
                    <?php
                    } ?>
                
                </div>

            </div>

            <?php
        if ($value['slug'] !== '') { ?>
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
            <a href="" class="def-btn _action teaser-collapsible-btn js-teaser-collapsible-btn" >Weitere Inhalte anzeigen</a>
        </div>

<?php
    } ?>

</div>
