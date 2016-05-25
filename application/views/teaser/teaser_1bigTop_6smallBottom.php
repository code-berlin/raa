<div class="teaser-1-big-top-6-small-bottom">

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

        if ($i == 0) {

            if (isset($slug)) { ?>
                <a class="__main flex-container flex" href="<?php echo $slug; ?>">
            <?php
            } else { ?>
                <div class="__main flex-container flex">
            <?php
            } ?>

                <div class="__img">
                    <img class="lazy-img js-lazy-img" src="/assets/images/themes/<?php echo $theme; ?>/ph.png" data-src="<?php echo isset($image) ? $image : ''; ?>">
                </div>

                <div class="flex __info">

                    <div class="__headline"><?php echo $value['title']; ?></div>

                        <div class="__text">
                            <?php echo $value['text']; ?>
                        </div>

                    <?php
                    if (isset($slug)) { ?>
                        <div class="__readmore">Weiterlesen</div>
                    <?php
                    } ?>

                </div>

            <?php
            if (isset($slug)) { ?>
                </a>
            <?php
            } else { ?>
                </div>
            <?php
            } ?>

            <div class="__minis flex-container">

        <?php
        } else {

            if ($i == 1) { ?>

                <div class="flex-container __first flex">

            <?php
            } elseif ($i == 4) { ?>

                </div>

                <div class="flex-container __second flex">

            <?php
            }

            if (isset($slug)) { ?>
                <a href="<?php echo $slug; ?>" target="<?php echo $target; ?>" class="__mini-item flex">
            <?php
            } else { ?>
                <div class="__mini-item flex">
            <?php
            } ?>

                <div class="__img">
                    <img class="lazy-img js-lazy-img" src="/assets/images/themes/<?php echo $theme; ?>/ph.png" data-src="<?php echo isset($image) ? $image : ''; ?>">
                </div>
                <span class="__title"><?php echo $value['title']; ?></span>

                <?php
                if (isset($slug)) { ?>
                    <div class="__readmore"></div>
                <?php
                }

            if (isset($slug)) { ?>
                </a>
            <?php
            } else { ?>
                </div>
            <?php
            }

        }

        $i++;

    }
?>
                </div>

         </div>

</div>