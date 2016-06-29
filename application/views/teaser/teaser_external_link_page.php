<div class="teaser-external-link-page">

    <?php

    $columns = 2;
    $i = 0;

    foreach ($items as $key => $value) {

        // open row
        if ($i%$columns == 0) { ?>
            <div class="flex-container __row"><?php
        }  ?>

            <a href="<?php echo $value['external_link']; ?>" class="flex flex-container __item" target="_blank">
                <div class="flex flex-container __img">
                    <img src="/assets/uploads/files/<?php echo $value['external_image']; ?>">
                </div>
                <div class="flex flex-container __btn"><?php echo $value['title']; ?></div>
            </a>

        <?php
        $i++;

        // close row
        if ($i > 1 && $i%$columns == 0) { ?>
            </div> <?php
        }

    }

    // build dummy items to fill line
    while($i%$columns != 0) { ?>
        <div class="__item _dummy flex"></div><?php
        $i++;
        if ($i%$columns == 0) { ?>
            </div> <?php
        }
    } ?>

</div>