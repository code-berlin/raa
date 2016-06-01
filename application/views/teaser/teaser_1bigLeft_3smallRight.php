<div class="teaser-1-big-left-3-small-right flex-container mt25">

<?php

$i = 0;

foreach ($items as $key => $value) {

    $target = '_self';
    $image = null;
    $slug = null;
    $external = false;

    if ($value['content_type'] == 'external') {
        $target = '_blank';
        $external = true;
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

    if ($i == 0) { ?>

        <div class="__main">
            <a href="<?php echo isset($slug) ? $slug : '#' ; ?>" target="<?php echo $target; ?>">
                <div class="img _hover-mask">
                    <img class="lazy-img js-lazy-img" src="/assets/images/themes/<?php echo $theme; ?>/ph.png" data-src="<?php echo isset($image) ? $image : '' ; ?>" class="_teaser-img" alt="<?php echo $value['title']; ?>" />
                    <?php
                    if ($value['page_commercial']) { ?>
                        <div class="__commercial">Anzeige</div> <?php
                    } ?>
                </div>
                <span class="flex-container _column __bottom">
                    <div class="__part __teaser-title"><?php echo $value['title']; ?></div>
                    <span class="__part __teaser-text flex"><?php echo $value['text']; ?></span>
                    <div class="__part __teaser-more">
                        <?php echo $external ? 'Jetzt downloaden' : 'Mehr erfahren'; ?>
                    </div>
                </span>
            </a>
        </div>

    <?php

    } elseif($i < 4) {

        if ($i == 1) { ?>
            <div class="__three flex"> <?php
        } ?>

                <div class="__small">
                    <a href="<?php echo isset($slug) ? $slug : '#' ; ?>" target="<?php echo $target; ?>">

                        <div class="flex-container _row">

                            <div class="__info flex">
                                <div class="__inner">
                                    <div class="__title"><?php echo $value['title']; ?></div>
                                    <div class="__text"><?php echo $value['text']; ?></div>
                                </div>
                            </div>

                            <div>
                                <div class="img _hover-mask">
                                    <img src="/assets/images/themes/<?php echo $theme; ?>/ph.png" data-src="<?php echo isset($image) ? $image : '' ; ?>" class="lazy-img js-lazy-img _teaser-img" alt="<?php echo $value['title']; ?>">
                                    <?php
                                    if ($value['page_commercial']) { ?>
                                        <div class="__commercial">Anzeige</div> <?php
                                    } ?>
                                </div>
                            </div>

                        </div>
                        <div class="ta-c">
                            <div class="__cta"><?php echo $external ? 'Jetzt downloaden' : 'Mehr erfahren'; ?></div>
                        </div>

                    </a>
                </div>

        <?php
        if ($i == 3) { ?>
            </div>
        <?php
        } ?>

    <?php
    }

    $i++;

} ?>

</div>