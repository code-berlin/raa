<?php
if (!empty($value['slug']) && empty($value['title'])) { ?>
    <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>" class="__mini-item flex">
<?php
} else { ?>
    <div class="__mini-item flex <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
<?php
} ?>

        <div class="__img">
            <img
                class="lazy-img js-lazy-img"
                src="<?php echo $img_placeholder; ?>"
                data-src="<?php echo !empty($value['image']) ? $value['image'] : ''; ?>"
                alt="<?php echo $value['title']; ?>"
            >
        </div>
    
        <?php
        if (!empty($value['title'])) { ?>
            <span class="__title">
                <?php
                if (!empty($value['slug'])) { ?>
                    <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
                <?php
                }
                        echo $value['title'];

                if (!empty($value['slug'])) { ?>
                    </a>
                <?php
                } ?>
            </span>
        <?php
        }

        if (!empty($value['slug'])) { ?>
            <div class="__readmore"></div>
        <?php
        }

if (!empty($value['slug']) && empty($value['title'])) { ?>
    </a>
<?php
} else { ?>
    </div>
<?php
}