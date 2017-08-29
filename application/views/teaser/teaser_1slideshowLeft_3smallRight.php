<div class="teaser-1-slideshow-left-3-small-right flex-container">

    <div class="slideshow-container">
        
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

                    if($i < $total_slideshow) { ?>

                        <li
                            data-thumb="<?php echo $img_placeholder; ?>"
                            data-title="<?php echo isset($value['title']) ? $value['title'] : ''; ?>"
                        >

                        <?php
                        if ($value['slug'] !== '') { ?>
                            <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
                        <?php
                        } ?>
                                
                                <img
                                    class="lazy-img js-slideshow-lazy-img"
                                    src="<?php echo $img_placeholder; ?>"
                                    data-src="<?php echo isset($value['image']) ? $value['image'] : ''; ?>"
                                />

                            <?php
                            if (isset($value['title'])) { ?>
                                <div class="__info">
                                    <div class="__inner">
                                        <div class="__title"><?php echo $value['title']; ?></div>
                                        <div class="__text"><?php echo $value['text']; ?></div>
                                    </div>
                                </div>
                            <?php
                            } ?>

                        <?php
                        if ($value['slug'] !== '') { ?>
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

    <div class="__minis flex flex-container _column">
        
        <div class="__headline">Top Themen</div>

        <?php
        $i = 1;

        foreach ($items as $key => $value) {

            if($i > $total_slideshow) {

                if ($value['slug'] !== '') { ?>
                    <a href="<?php echo $value['slug']; ?>" class="__mini-item flex-container" target="<?php echo $value['target']; ?>">
                <?php
                } else { ?>
                    <div class="__mini-item flex-container">
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
                        <div class="__info flex">
                          <div class="__title"><?php echo $value['title']; ?></div>
                          <div class="__text"><?php echo $value['text']; ?></div>
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
            }

            $i++;
        } ?>
    </div>

</div>
