<div class="teaser-flex-only-images flex-container">

    <?php

    foreach ($items as $key => $value) {

        if (isset($value['slug'])) { ?>
            <a
                href="<?php echo $value['slug']; ?>"
                target="<?php echo $value['target']; ?>"
                class="__item flex"
            >
        <?php
        } else { ?>
            <div class="__item flex">
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

        <?php
        if (isset($value['slug'])) { ?>
            </a>
        <?php
        } else { ?>
            </div>
        <?php
        }

    } ?>

</div>
