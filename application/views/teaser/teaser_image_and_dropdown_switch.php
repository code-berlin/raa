<div class="teaser-image-and-dropdown">

    <?php
    $i = 0;
    $itemCount = count($items);
    foreach ($items as $key => $value) {

        $target = '_self';
        $image = '';
        $slug = '';

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

        if ($i === 0) {

            $this->load->view('teaser/components/teaser_image_and_dropdown_item',
                array('value' => $value, 'target' => $target, 'slug' => $slug, 'image' => $image, 'css' =>'js-image-and-dropdown-switch'));

        ?>

            <select class="choosen-select js-image-and-dropdown-select" data-placeholder="Alle Artikel zum Thema" data-search="0">
                <option>Alle Artikel zum Thema</option>
        <?php
        } ?>
                <option
                    data-slug="<?php echo $slug; ?>"
                    data-target="<?php echo $target; ?>"
                    data-image="<?php echo isset($image) ? $image : ''; ?>"
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