<div class="teaser-1-big-left-3-small-right flex-container">

<?php

$i = 0;

foreach ($items as $key => $value) {

    if ($i == 0) { ?>

        <div class="__main <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
            <div class="img _hover-mask">
                <?php
                $this->load->view('component/lazyimg', array(
                    'src' => $img_placeholder,
                    'datasrc' => !empty($value['image']) ? $value['image'] : '',
                    'alt' => $value['title']
                ));
                if (isset($value['page_commercial']) && $value['page_commercial'] == true) { ?>
                    <div class="__commercial">Anzeige</div> <?php
                } ?>
            </div>
            <span class="flex-container _column __bottom">
                <div class="__part __teaser-title">
                    <?php $this->load->view('component/link',
                        array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['title'])); ?>
                </div>
                <span class="__part __teaser-text flex"><?php echo $value['text']; ?></span>
                <div class="__part __teaser-more">
                    <?php echo $value['content_type'] == 'external' ? 'Jetzt downloaden' : 'Mehr erfahren'; ?>
                </div>
            </span>
        </div>

    <?php

    } elseif($i < 4) {

        if ($i == 1) { ?>
            <div class="__three flex"> <?php
        } ?>

                <div class="__small <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
                    <div class="flex-container _row">

                        <div class="__info flex">
                            <div class="__inner">
                                <div class="__title">
                                    <?php $this->load->view('component/link',
                                        array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['title'])); ?>
                                </div>
                                <div class="__text"><?php echo $value['text']; ?></div>
                                <div class="__cta">
                                    <?php echo $value['content_type'] == 'external' ? 'Jetzt downloaden' : 'Mehr erfahren'; ?>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="img _hover-mask">
                                <?php
                                $this->load->view('component/lazyimg', array(
                                    'src' => $img_placeholder,
                                    'datasrc' => !empty($value['image']) ? $value['image'] : '',
                                    'alt' => $value['title']
                                ));
                                if ($value['page_commercial']) { ?>
                                    <div class="__commercial">Anzeige</div> <?php
                                } ?>
                            </div>
                        </div>

                    </div>
                </div>

        <?php
        if ($i == 3) { ?>
            </div>
        <?php
        } ?>

    <?php
    }

    $i++;

} ?>

</div>