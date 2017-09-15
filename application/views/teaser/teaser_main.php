<?php
    foreach ($items as $key => $value) { ?>

        <div class="teaser-main flex-container <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
            <div class="__headline flex">
                <h1>
                    <?php
                    if (!empty($value['slug'])) {
                        $this->load->view('component/link',
                            array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['title']));
                    } else {
                        echo $value['title'];
                    } ?>
                </h1>
                <div class="__sub">
                    <?php echo $value['text']; ?>
                </div>
            </div>
            <div class="__img">
                <img
                    class="lazy-img js-lazy-img"
                    src="<?php echo $img_placeholder; ?>"
                    data-src="<?php echo !empty($value['image']) ? $value['image'] : ''; ?>"
                    alt="<?php echo $value['title']; ?>">

                <?php
                if (!empty($value['slug'])) { ?>
                    <div class="__link-wrap">
                        <div class="__link">
                            Weiterlesen<i class="fa fa-chevron-right"></i>
                        </div>
                    </div>
                <?php
                } ?>

            </div>
        </div>
<?php
    }
?>