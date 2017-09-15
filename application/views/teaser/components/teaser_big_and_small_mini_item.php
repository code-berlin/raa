<?php
if (!empty($value['slug']) && empty($value['title'])) { ?>
    <a href="<?php echo $value['slug']; ?>" target="<?php echo $value['target']; ?>" class="__mini-item flex">
<?php
} else { ?>
    <div class="__mini-item flex <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
<?php
} ?>

        <div class="__img">
            <?php
            $this->load->view('component/lazyimg', array(
                'src' => $img_placeholder,
                'datasrc' => !empty($value['image']) ? $value['image'] : '',
                'alt' => ''
            )); ?>
        </div>
    
        <?php
        if (!empty($value['title'])) { ?>
            <span class="__title">
                <?php
                if (!empty($value['slug'])) {
                    $this->load->view('component/link',
                        array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['title']));
                } else {
                    echo $value['title'];
                } ?>
            </span>
        <?php
        }

        if (!empty($value['slug'])) { ?>
            <div class="__readmore"></div>
        <?php
        }

if (!empty($value['slug']) && empty($value['title'])) { ?>
    </a>
<?php
} else { ?>
    </div>
<?php
}