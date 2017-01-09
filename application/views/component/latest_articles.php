<div class="teaser-group js-teaser-collapsible">
    <h2 class="teaser-h2">Aktuell auf DoktorDarm</h2>
    <?php
        $articles_limit = 5;
        $initial_shown = 3;
        $show_collapsible_button = false;
        $i = 0;

        $latest_articles = $this->page_m->get_latest_article($articles_limit);

        foreach ($latest_articles as $key => $value) {

            $image = isset($value['image']) ? $value['image'] : null;
            $slug = base_url((isset($value['parent_slug']) && !empty($value['parent_slug']) ? $value['parent_slug'] . '/' : '') . $value['slug']);
            $category = isset($value['parent_menu_title']) ? $value['parent_menu_title'] : null;
    ?>

            <div class="component-latest-articles flex-container <?php echo ($i >= $initial_shown ? ' dn js-teaser-collapsible-closed' : ''); ?>">
                <div class="__img">
                    <img class="lazy-img js-lazy-img" src="<?php echo $img_placeholder; ?>" data-src="<?php echo isset($image) ? $image : ''; ?>" alt="<?php echo $value['teaser_title']; ?>">

                    <?php
                    if (isset($slug)) { ?>
                        <div class="__addthis-wrap">
                            <a class="addthis_inline_share_toolbox" data-url="<?php echo $slug; ?>" data-title="<?php echo $value['teaser_title']; ?>"></a>
                        </div>
                    <?php
                    } ?>

                </div>
                <div class="__headline flex">
                    <?php
                    if (isset($category)) { ?>
                        <div class="__category"><?php echo $category; ?></div>
                    <?php
                    } ?>
                    <h1><?php echo $value['teaser_title']; ?></h1>
                    <div class="__sub">
                        <?php echo $value['teaser_text']; ?>
                    </div>
                    <?php
                    if (isset($slug)) { ?>
                        <a class="__read-more" href="<?php echo $slug; ?>" target="_self">
                            Weiterlesen<i class="fa fa-chevron-right"></i>
                        </a>
                    <?php
                    } ?>
                </div>
            </div>
    <?php
            if ($i > $initial_shown) $show_collapsible_button = true;

            $i++;
        }

        if($show_collapsible_button == true) {
    ?>
            <div class="ta-c">
                <a href="" class="def-btn teaser-collapsible-btn js-teaser-collapsible-btn" >Weitere Inhalte anzeigen</a>
            </div>
    <?php
        }
    ?>
</div>
