<div class="teaser-3-medium-2-extra-rows js-teaser-collapsible">

<?php

$columns = 3;
$i = 0;

$initial_shown = $columns;
$show_collapsible_button = false;

foreach ($items as $key => $value) {
    
    if ($i % $columns == 0) { ?>
        <div class="__minis flex-container flex<?php echo ($i >= $initial_shown ? ' dn js-teaser-collapsible-closed' : ''); ?>"> <?php
    } ?>

            <div class="__mini-item flex <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?> <?php echo $i+1 == sizeof($items) ? '_last' : ''; ?>">

                <div class="__img">
                    <?php
                    $this->load->view('component/lazyimg', array(
                        'src' => $img_placeholder,
                        'datasrc' => !empty($value['image']) ? $value['image'] : '',
                        'alt' => $value['title']
                    )); ?>
                </div>
                <div class="__inner"> 

                    <?php
                    if(!empty($value['parent_menu_title'])) { ?>
                        <div class="__category">
                            <?php echo $value['parent_menu_title']; ?>
                        </div>
                    <?php
                    }

                    if(!empty($value['text'])) { ?>
                        <div class="__title">
                            <?php
                            if (!empty($value['slug'])) {
                                $this->load->view('component/link',
                                    array('href' => $value['slug'], 'target' => $value['target'], 'text' => strip_tags($value['text'])));
                            } else {
                                echo strip_tags($value['text']);
                            } ?>
                        </div>
                    <?php
                    } ?>
                
                </div>
            </div>

    <?php
    if ($i > $initial_shown) $show_collapsible_button = true;
    $i++;
    if ($i > 1 && $i % $columns == 0) { ?>
        </div> <?php
    }
}

// build dummy items to fill line
while($i%$columns != 0) { ?>
    <div class="__mini-item _dummy flex"></div><?php
    $i++;
    if ($i%$columns == 0) { ?>
        </div> <?php
    }
}

if($show_collapsible_button == true) { ?>
    <div class="ta-c">
        <a href="" class="def-btn _action teaser-collapsible-btn js-teaser-collapsible-btn" >Weitere Inhalte anzeigen</a>
    </div> <?php
} ?>

</div>
