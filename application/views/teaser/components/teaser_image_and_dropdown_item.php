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
        <?php
        $this->load->view('component/lazyimg', array(
            'css' => 'js-image-and-dropdown-img',
            'src' => $img_placeholder,
            'datasrc' => !empty($value['image']) ? $value['image'] : '',
            'alt' => ''
        )); ?>
    </div>
    <div class="js-image-and-dropdown-text"><?php echo $value['text']; ?></div>
    <div class="__btn def-btn _action">Weiterlesen</div>
</div>