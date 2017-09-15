<div class="__teaser <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?> <?php echo $css; ?>">
    <div class="__title">
        <?php
        if (!empty($value['slug'])) {
            $this->load->view('component/link',
                array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['title']));
        } else {
            echo $value['title'];
        } ?>
    </div>
    <div class="__img">
        <img
            class="lazy-img js-lazy-img js-image-and-dropdown-img"
            src="<?php echo $img_placeholder; ?>"
            data-src="<?php echo isset($value['image']) ? $value['image'] : ''; ?>"
            alt="<?php echo $value['title']; ?>"
        />
    </div>
    <div class="js-image-and-dropdown-text"><?php echo $value['text']; ?></div>
    <div class="__btn def-btn _action">Weiterlesen</div>
</div>