<div class="teaser-1-slideshow-left-3-small-right flex-container">

    <div class="slideshow-container">
        
        <?php
        // placeholder is important, because "jumpmark" functionality (link from other page) doesnt work without this
        ?>
        <img class="ph js-lazy-slideshow-placeholder" src="<?php echo $img_placeholder; ?>">

        <div class="flexslider js-flexslider js-lazy-slideshow">
            <ul class="slides">

                <?php
                $i = 0;
                $total_items = count($items);
                $total_right = 3;
                $total_slideshow = $total_items - $total_right;

                if($total_slideshow <= 0) {
                  $total_slideshow = 1;
                }

                foreach ($items as $key => $value) {

                    if($i < $total_slideshow) { ?>

                        <li
                            data-thumb="<?php echo $img_placeholder; ?>"
                            data-title="<?php echo isset($value['title']) ? $value['title'] : ''; ?>"
                            class="<?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>"
                        >
                                
                            <img
                                class="lazy-img js-slideshow-lazy-img"
                                src="<?php echo $img_placeholder; ?>"
                                data-src="<?php echo isset($value['image']) ? $value['image'] : ''; ?>"
                            />

                        <?php
                        if (isset($value['title']) || isset($value['text'])) { ?>
                            <div class="__info">
                                <div class="__inner">
                                    <div class="__title">
                                        <?php echo $value['title']; ?>
                                    </div>
                                    <div class="__text">
                                        <?php
                                        if (!empty($value['slug'])) {
                                            $this->load->view('component/link',
                                                array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['text']));
                                        } else {
                                            echo $value['text'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>

                        </li>
                    <?php
                        $i++;
                    }

                } ?>

            </ul>
        </div>
    </div>

    <div class="__minis flex flex-container _column">
        
        <div class="__headline">Top Themen</div>

        <?php
        $i = 1;

        foreach ($items as $key => $value) {

            if($i > $total_slideshow) { ?>

                <div class="__mini-item flex-container <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
                    <div class="__img">
                        <img
                            class="lazy-img js-lazy-img"
                            src="<?php echo $img_placeholder; ?>"
                            data-src="<?php echo isset($value['image']) ? $value['image'] : ''; ?>"
                            alt="<?php echo $value['title']; ?>"
                        />
                     </div>                
                    <div class="__info flex">
                        <div class="__title">
                            <?php echo $value['title']; ?>
                        </div>
                        <div class="__text">
                            <?php
                            if (!empty($value['slug'])) {
                                $this->load->view('component/link',
                                    array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['text']));
                            } else {
                                echo $value['text'];
                            } ?>
                        </div>
                    </div>
                </div>

                <?php
            }

            $i++;
        } ?>
    </div>

</div>
