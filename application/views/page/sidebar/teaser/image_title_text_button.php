<?php
if ($commercial) {
    $this->load->view('page/sidebar/teaser/commercial');
} ?>
<div class="teaser_sidebar_<?php echo $type; ?> <?php echo $hasUrl ? 'js-teaser-linked' : ''; ?>">
    
    <?php
    if ($hasImage) {
        $this->load->view('component/lazyimg', array(
            'src' => $img_placeholder,
            'datasrc' => $image,
            'alt' => isset($image_alt) && !empty($image_alt) ? $image_alt : ''
        ));
    } ?>

    <?php
    if ($hasTitle) { ?>
        <div class="__title">
            <?php
            if ($hasUrl) {
                $this->load->view('component/link', array('href' => $url, 'target' =>$target, 'text' => $title));
                $aRendered = true;
            } else {
                echo $title;
            } ?>
        </div>
    <?php
    } ?>

    <?php
    if ($hasText) { ?>
        <div class="__text">
            <?php
            if ($hasUrl && !isset($aRendered)) {
                $this->load->view('component/link', array('href' => $url, 'target' =>$target, 'text' => $text));
                $aRendered = true;
            } else {
                echo $text;
            } ?>
        </div>
    <?php
    } ?>

    <div class="__bottom">
        <?php echo $external == '1' ? 'Jetzt downloaden' : 'Mehr erfahren'; ?>
    </div>

    <?php
    if ($hasUrl && !isset($aRendered)) { ?>
        <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="hidden"></a>
    <?php
    } ?>

</div>