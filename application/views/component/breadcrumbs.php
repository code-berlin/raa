<div class="breadcrumbs">

    <?php
    foreach ($breadcrumbs as $key => $value) {

        if (!empty($value['url'])) { ?>

            <a href="<?php echo $value['url']; ?>" class="__inner"><?php echo $value['title']; ?></a>
            <div class="__inner __arrow"></div>

        <?php
        } else { ?>

            <div class="__inner __current"><?php echo $value['title']; ?></div>

        <?php
        }

    } ?>



</div>
