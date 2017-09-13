<div class="teaser-1-big-left-4-small-right flex-container">

<?php
if (count($items) == 5) {

    $i = 0;
    foreach ($items as $key => $value) {
        if ($i == 0) {
            // render main item
            $this->load->view('teaser/components/teaser_big_and_small_main', array('value' => $value));
        } else {
            // render mini items
            if ($i == 1) { ?>
                <div class="__minis flex-container _column"> <?php
            }

            if ($i % 2 == 1) { ?>
                    <div class="flex-container __row"> <?php
            }
                        $this->load->view('teaser/components/teaser_big_and_small_mini_item', array('value' => $value));
            
            if ($i % 2 == 0) { ?>
                    </div> <?php
            }

            if ($i == 4) { ?>
                </div> <?php
            }

        }
        $i++;
    }
    
} else {
    echo 'Please add exact 5 Items to this Teaser Type (teaser_1bigLeft_4smallRight)';
} ?>


</div>