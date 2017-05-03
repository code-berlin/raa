<a class="__teaser <?php echo $css; ?>" href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>">
    <div class="js-image-and-dropdown-title __title"><?php echo $value['title']; ?></div>
    <div class="__img">
        <img
            class="lazy-img js-lazy-img js-image-and-dropdown-img"
            src="<?php echo $img_placeholder; ?>"
            data-src="<?php echo isset($value['image']) ? $value['image'] : ''; ?>"
            alt="<?php echo $value['title']; ?>"
        />
    </div>
    <div class="js-image-and-dropdown-text"><?php echo $value['text']; ?></div>
    <div class="__btn def-btn">Weiterlesen</div>
</a>