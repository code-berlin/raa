<div class="teaser-ordered-list">
    <div class="__inner">
        <?php
        foreach ($items as $firstchar => $group) { ?>
            <div class="__firstchar"><?php echo $firstchar; ?></div>
            <?php
            foreach ($group as $key => $value) { ?>
                <div class="__title">
                    <a href="<?php echo $value['slug']; ?>"><?php echo $value['title']; ?></a>
                </div>
            <?php
            }
        } ?>
    </div>
</div>