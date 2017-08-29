<div class="teaser-gallery">

    <div class="flexslider js-gallery images-unloaded">
        <ul class="slides">
        <?php
        $i = 0;
        foreach ($items as $key => $value) { ?>
            <li
                data-title="<?php echo $value['title']; ?>"
                data-text="<?php echo htmlspecialchars($value['text']); ?>"
            >
                <img
                    class="lazy-img transition-none js-appear-triggable"
                    src="<?php echo $img_placeholder; ?>"
                    data-src="<?php echo isset($value['external_image']) ? $value['external_image']: ''; ?>"
                    data-height="auto",
                />
            </li>
        <?php
            $i++;
        } ?>
        </ul>
    </div>

    <div class="js-gallery-title gallery-title">
        <?php echo $items[0]['title']; ?>
    </div>

    <div class="js-gallery-text gallery-text">
        <?php echo $items[0]['text']; ?>
    </div>

    <div class="gallery-nav js-gallery-nav cla">
        <div class="__back js-gallery-nav-btn" data-direction="prev"><i class="material-icons">&#xE408;</i><span>Vorheriges Bild</span></div>
        <div class="__next js-gallery-nav-btn" data-direction="next"><span>Nächstes Bild</span><i class="material-icons">&#xE409;</i></div>
    </div>

</div>
