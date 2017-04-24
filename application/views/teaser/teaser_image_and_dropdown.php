<div class="teaser-image-and-dropdown">

    <?php
    $i = 0;
    $itemCount = count($items);
    foreach ($items as $key => $value) {

        if ($i === 0) {

            $this->load->view('teaser/components/teaser_image_and_dropdown_item', array('value' => $value, 'css' =>''));

            $i++;
            continue;

        } elseif ($i === 1) { ?>

            <select class="choosen-select js-image-and-dropdown-select" data-placeholder="Alle Artikel zum Thema" data-search="0">
                <option value="">Alle Artikel zum Thema</option>

        <?php
        } ?>

                <option
                    data-slug="<?php echo $value['slug']; ?>"
                    data-target="<?php echo $value['target']; ?>"
                >
                    <?php echo $value['title']; ?>
                </option>

        <?php
        if ($i === $itemCount - 1) { ?>
            </select> <?php
        } ?>

        <?php

        $i++;
    
    } ?>

</div>