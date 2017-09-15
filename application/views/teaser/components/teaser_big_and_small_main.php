<?php $aRendered = false; ?>

<div class="__main flex-container flex <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
    <div class="__img">
        <?php
        $this->load->view('component/lazyimg', array(
            'src' => $img_placeholder,
            'datasrc' => !empty($value['image']) ? $value['image'] : '',
            'alt' => ''
        )); ?>
    </div>
    <div class="__info">
        
        <div class="__headline">
            <?php
            if (!empty($value['slug'])) {
                $this->load->view('component/link',
                    array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['title']));
                $aRendered = true;
            } else {
                echo $value['title'];
            } ?>
        </div>

        <div class="__text">
            <?php
            if (!empty($value['slug']) && !$aRendered) {
                $this->load->view('component/link',
                    array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['text']));
                $aRendered = true;
            } else {
                echo $value['text'];
            } ?>
        </div>

        <?php
        if (!empty($value['slug'])) { ?>
            <div class="__readmore">Weiterlesen</div>
        <?php
        }

        if (!empty($value['slug']) && !$aRendered) { ?>
            <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>" class="hidden"></a>
        <?php
        } ?>

    </div>
</div>

