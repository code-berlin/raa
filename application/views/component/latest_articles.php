<div class="teaser-group js-teaser-collapsible">

    <div class="teaser-component-latest-articles">

        <h2 class="teaser-h2">Aktuell auf <?php echo explode('.', $this->config->item('name'))[0]; ?></h2>
        <?php
            $articles_limit = 5;
            $initial_shown = 3;
            $show_collapsible_button = false;
            $i = 0;

            $latest_articles = $this->page_m->get_latest_article($articles_limit);

            foreach ($latest_articles as $key => $value) {

                $image = !empty($value['image']) ? $value['image'] : null;
                $slug = base_url((!empty($value['parent_slug']) && !empty($value['parent_slug']) ? $value['parent_slug'] . '/' : '') . $value['slug']);
                $category = !empty($value['parent_menu_title']) ? $value['parent_menu_title'] : null;
        ?>

                <div class="component-latest-articles flex-container <?php echo !empty($slug) ? 'js-teaser-linked' : ''; ?> <?php echo ($i >= $initial_shown ? ' dn js-teaser-collapsible-closed' : ''); ?>">
                    <div class="__img">

                        <?php
                        $this->load->view('component/lazyimg', array(
                            'src' => $img_placeholder,
                            'datasrc' => !empty($image) ? $image : '',
                            'alt' => $value['teaser_title']
                        ));
                        ?>

                    </div>
                    <div class="__headline flex">
                        <?php
                        if (!empty($category)) { ?>
                            <div class="__category"><?php echo $category; ?></div>
                        <?php
                        } ?>
                        <h3>
                            <?php
                            if (!empty($slug)) {
                                $this->load->view('component/link',
                                    array('href' => $slug, 'target' => '_self', 'text' => $value['teaser_title']));
                            } else {
                                echo $value['teaser_title'];
                            } ?>
                        </h3>
                        <div class="__sub">
                            <?php echo $value['teaser_text']; ?>
                        </div>
                        <?php
                        if (!empty($slug)) { ?>
                            <div class="__read-more def-btn _action">Mehr erfahren</div> <?php
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
                    <div class="def-btn _action teaser-collapsible-btn js-teaser-collapsible-btn" >Weitere Inhalte anzeigen</div>
                </div>
        <?php
            }
        ?>

    </div>

</div>
