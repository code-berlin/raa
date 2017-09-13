<div class="teaser-1-big-top-6-small-bottom">

<?php
if (count($items) == 7) {

    $i = 0;
    foreach ($items as $key => $value) {    
        if ($i == 0) {
            // render main item
            $this->load->view('teaser/components/teaser_big_and_small_main', array('value' => $value));
        } else {
            // render mini items
            if ($i == 1) { ?>
                <div class="__minis flex-container">
                    <div class="flex-container __first flex"> <?php
            }
            if ($i >= 1 && $i <= 3) {
                        $this->load->view('teaser/components/teaser_big_and_small_mini_item', array('value' => $value));
            }
            if ($i == 4) { ?>
                    </div>
                    <div class="flex-container __second flex"> <?php
            }
            if ($i >= 4 && $i <= 6) {
                        $this->load->view('teaser/components/teaser_big_and_small_mini_item', array('value' => $value));
            }
            if ($i == 6) { ?>
                    </div>
                </div> <?php
            }
        }
        $i++;
    }

} else {
    echo 'Please add exact 7 Items to this Teaser Type (teaser_1bigTop_6smallBottom)';
}?>

</div>