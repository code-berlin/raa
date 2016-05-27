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

    <?php
    if (isset($slug)) { ?>
        <a href="<?php echo $slug; ?>" target="<?php echo $target; ?>" class="teaser-royal">
    <?php
    } else { ?>
        <div class="teaser-royal">
    <?php
    } ?>

            <img class="lazy-img js-lazy-img" src="/assets/images/themes/<?php echo $theme; ?>/ph.png" data-src="<?php echo isset($image) ? $image : ''; ?>" alt="<?php echo $value['title']; ?>">
            <div class="__info">
                <h1><?php echo $value['title']; ?></h1>
                <div class="__text">
                    <?php echo $value['text']; ?>
                </div>

                <?php
                if (isset($slug)) { ?>
                    <div class="__link-wrap">
                        <div class="__link">Weiterlesen</div>
                    </div>
                <?php
                } ?>

            </div>

    <?php
    if (isset($slug)) { ?>
        </a>
    <?php
    } else { ?>
        </div>
    <?php
    } ?>

<?php
}
?>