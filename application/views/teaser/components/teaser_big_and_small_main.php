<?php $aRendered = false; ?>

<div class="__main flex-container flex <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
    <div class="__img">
        <img
            class="lazy-img js-lazy-img"
            src="<?php echo $img_placeholder; ?>"
            data-src="<?php echo !empty($value['image']) ? $value['image'] : ''; ?>"
            alt="<?php echo $value['title']; ?>">
    </div>
    <div class="__info">
        
        <div class="__headline">
            <?php
            if (!empty($value['slug'])) { ?>
                <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
            <?php
            }
                    echo $value['title'];

            if (!empty($value['slug'])) { ?>
                </a>
            <?php
                $aRendered = true;
            } ?>
        </div>

        <div class="__text">
            <?php
            if (!empty($value['slug']) && !$aRendered) { ?>
                <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
            <?php
            }
                    echo $value['text'];

            if (!empty($value['slug']) && !$aRendered) { ?>
                </a>
            <?php
            } ?>
        </div>

        <?php
        if (!empty($value['slug'])) { ?>
            <div class="__readmore">Weiterlesen</div>
        <?php
        }

        if (!empty($value['slug']) && !$aRendered) { ?>
            <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>" class="hidden"></a>
        <?php
        } ?>

    </div>
</div>

