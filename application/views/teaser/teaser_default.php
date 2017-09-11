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
        } ?>

            <div class="__item flex js-teaser-linked <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>">

                <div class="img <?php echo $value['slug'] !== '' ? '_hover-mask' : '' ?>">
                    <img
                        class="lazy-img js-lazy-img"
                        src="<?php echo $img_placeholder; ?>"
                        data-src="<?php echo isset($value['image']) ? $value['image'] : ''; ?>"
                        alt="<?php echo $value['title']; ?>"
                    />
                </div>

                <span class="__info flex-container _column">

                    <div class="__part __teaser-title">
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

                    <span class="__part __teaser-text flex">
                        <?php echo $value['text']; ?>
                    </span>

                    <?php
                    if ($value['slug'] !== '') { ?>
                        <div class="__part __teaser-more">Weiterlesen</div>
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

        <div class="ta-c">
            <a href="" class="def-btn teaser-collapsible-btn js-teaser-collapsible-btn" >Weitere Inhalte anzeigen</a>
        </div>

    <?php

    }

    ?>

</div>