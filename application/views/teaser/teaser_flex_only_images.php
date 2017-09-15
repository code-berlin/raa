<div class="teaser-flex-only-images flex-container">

    <?php

    foreach ($items as $key => $value) {

        if (isset($value['slug'])) { ?>
            <a
                href="<?php echo $value['slug']; ?>"
                target="<?php echo $value['target']; ?>"
                class="__item flex"
            >
        <?php
        } else { ?>
            <div class="__item flex">
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
        if (isset($value['slug'])) { ?>
            </a>
        <?php
        } else { ?>
            </div>
        <?php
        }

    } ?>

</div>
