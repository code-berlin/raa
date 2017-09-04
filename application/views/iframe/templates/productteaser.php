<div class="product-teaser-h2 js-product-teaser-height js-product-teaser-h2"><i class="fa fa-thumbs-up"></i>Unsere Produktempfehlung</div>
<div class="product-teaser js-product-teaser-height">
    <div class="__commercial js-product-teaser-commercial">Anzeige</div>
    <div class="flexslider js-productteaser">
        <ul class="slides">
            <?php
            $order = explode(',', $page->productteaser_order);
            foreach ($order as $key => $value) {
                if (!isset($page->productteaser[$value])) continue;
                $teaser = $page->productteaser[$value]; ?>
                <li class="__item">
                    <a href="<?php echo $teaser['link']; ?>" target="_top" id="jsProductTeaserSlide-<?php echo $key; ?>">
                        <div class="flex-container __info">
                            <div class="__img-wrapper">
                                <div class="__img">
                                    <img src="/image/preview/auto/500/<?php echo $teaser['image']; ?>"/>
                                </div>
                                <?php
                                if (isset($teaser['image_caption'])) { ?>
                                    <div class="img-sub __caption">
                                        <?php echo $teaser['image_caption']; ?>
                                    </div>
                                    <?php
                                }
                                if (isset($teaser['duty_text'])) { ?>
                                    <div class="duty-text-trigger js-duty-text-trigger">Pflichttext</div>
                                    <div class="duty-text-content js-duty-text-content">
                                        <div class="duty-text-close js-duty-text-close"><i class="material-icons">&#xE5CD;</i></div>
                                        <b>Pflichttext</b><br>
                                        <?php echo $teaser['duty_text']; ?>
                                    </div>
                                    <?php
                                } ?>
                            </div>
                            <div class="flex-container _column __texts">
                                <div class="__minheight">
                                    <div class="__title"><?php echo $teaser['teaser_title']; ?></div>
                                    <div class="__text"><?php echo $teaser['teaser_text']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <?php
            } ?>
        </ul>
    </div>
    <a href="" class="__cta def-btn _action js-productteaser-cta" target="_top">Zum Preisvergleich</a>
</div>