<div class="teaser-list-with-filter js-teaser-list-with-filter">
    
    <div class="__filters-headline">
        Thema wählen:
    </div>

    <div class="__filters cla">
        
        <?php
        $articleGroups = [];
        $i = 0;
        foreach ($items as $key => $value) {

            $articleGroupId = $value['article_group_id'];

            if (isset($articleGroupId) && !in_array($articleGroupId, $articleGroups)) { ?>
                
                <div
                    class="__filter def-btn js-teaser-list-with-filter-button <?php echo $i === 0 ? '_active' : ''?>"
                    data-article-group-id="<?php echo $value['article_group_id']; ?>"
                >
                    <?php echo $value['article_group_name']; ?>
                </div>
            
                <?php
                array_push($articleGroups, $articleGroupId);

            }

            $i++;

        } ?>

    </div>

    <div class="__items">

        <?php
        foreach ($items as $key => $value) {

            $articleGroupId = $value['article_group_id']; ?>

            <div
                class="__item flex-container js-teaser-list-with-filter-item <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>"
                <?php
                echo isset($articleGroupId) ? 'data-article-group-id="'.$articleGroupId.'"' : '';
                echo (count($articleGroups) > 0 && $articleGroupId !== $articleGroups[0]) ? 'style="display:none"' : '';
                ?>
            >

                <div class="__img">
                    <img
                        class="lazy-img js-lazy-img js-appear-triggable"
                        src="<?php echo $img_placeholder; ?>"
                        data-src="<?php echo !empty($value['image']) ? $value['image'] : ''; ?>"
                        alt="<?php echo $value['title']; ?>"
                    />
                </div>
                <div class="__info flex">
                    <div class="__title">
                        <?php
                        if (!empty($value['slug'])) {
                            $this->load->view('component/link',
                                array('href' => $value['slug'], 'target' => '_self', 'text' => $value['title']));
                        } else {
                            echo $value['title'];
                        } ?>
                    </div>
                    <div class="__date">
                        Zuletzt aktualisiert am: <?php echo $value['datestring']; ?>
                    </div>
                    <div class="__text">
                        <?php echo $value['text']; ?>
                    </div>
                    <?php
                    if (!empty($value['slug'])) { ?>
                        <div class="__read-more def-btn _action">Mehr erfahren</div> <?php
                    } ?>
                </div>
            </div>
            
        <?php
        } ?>

    </div>

</div>