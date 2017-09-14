<div class="teaser_sidebar_<?php echo $type; ?> <?php echo $hasUrl ? 'js-teaser-linked' : ''; ?>">
    
    <?php
    if ($hasImage) { ?>
        <img
            class="lazy-img js-lazy-img"
            src="/assets/images/themes/<?php echo $theme; ?>/ph.png"
            data-src="<?php echo $image?>"
            alt="<?php echo (isset($image_alt) && !empty($image_alt)) ? $image_alt : '' ?>"
        >
    <?php
    }

    if ($hasTitle || $hasText) { ?>
    
        <div class="__texts">
            <?php
            if ($hasTitle) { ?>
                <div class="__title">
                    <?php
                    if ($hasUrl) {
                        $this->load->view('component/link', array('href' => $url, 'target' =>$target, 'text' => $title));
                        $aRendered = true;
                    } else {
                        echo $title;
                    } ?>
                </div>
            <?php
            }

            if ($hasText) { ?>
                <div class="__text">
                    <?php
                    if ($hasUrl && !isset($aRendered)) {
                        $this->load->view('component/link', array('href' => $url, 'target' =>$target, 'text' => $text));
                        $aRendered = true;
                    } else {
                        echo $text;
                    } ?>
                </div>
            <?php
            } ?>
        </div>

    <?php
    }

    if ($hasUrl && !isset($aRendered)) { ?>
        <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="hidden"></a>
    <?php
    } ?>

</div>