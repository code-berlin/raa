<div class="teaser-image-and-dropdown">

    <?php
    $i = 0;
    $itemCount = count($items);
    foreach ($items as $key => $value) {

        if ($i === 0) {

            $this->load->view('teaser/components/teaser_image_and_dropdown_item', array('value' => $value, 'css' =>'js-image-and-dropdown-switch')); ?>

            <select class="choosen-select js-image-and-dropdown-select" data-placeholder="Alle Artikel zum Thema" data-search="0">
                <option>Alle Artikel zum Thema</option>
        <?php
        } ?>
                <option
                    data-slug="<?php echo $value['slug']; ?>"
                    data-target="<?php echo $value['target']; ?>"
                    data-image="<?php echo isset($value['image']) ? $value['image'] : ''; ?>"
                    data-title="<?php echo $value['title']; ?>"
                    data-text="<?php echo $value['text']; ?>"
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