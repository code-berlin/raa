<?php
    foreach ($items as $key => $value) {

        $target = '_self';
        $image = null;
        $slug = null;

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
        } ?>

        <div class="teaser-main flex-container">
            <div class="__headline flex">
                <h1><?php echo $value['title']; ?></h1>
                <div class="__sub">
                    <?php echo $value['text']; ?>
                </div>
            </div>
            <div class="__img">
                <img class="lazy-img js-lazy-img" src="<?php echo $img_placeholder; ?>" data-src="<?php echo isset($image) ? $image : ''; ?>" alt="<?php echo $value['title']; ?>">

                <?php
                if (isset($slug)) { ?>
                    <div class="__link-wrap">
                        <a class="__link" href="<?php echo $slug; ?>" target="<?php echo $target; ?>">
                            Weiterlesen<i class="fa fa-chevron-right"></i>
                        </a>
                    </div>
                <?php
                } ?>

            </div>
        </div>
<?php
    }
?>