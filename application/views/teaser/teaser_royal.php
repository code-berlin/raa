<?php
foreach ($items as $key => $value) {  ?>

    <div class="teaser-royal <?php echo !empty($value['slug']) ? 'js-teaser-linked' : ''; ?>">
        
        <?php
        $this->load->view('component/lazyimg', array(
            'src' => $img_placeholder,
            'datasrc' => !empty($value['image']) ? $value['image'] : '',
            'alt' => $value['title']
        )); ?>

        <div class="__info">
            <h1>
                <?php
                if (!empty($value['slug'])) {
                    $this->load->view('component/link',
                        array('href' => $value['slug'], 'target' => $value['target'], 'text' => $value['title']));
                } else {
                    echo $value['title'];
                } ?>
            </h1>
            <div class="__text">
                <?php echo $value['text']; ?>
            </div>

            <?php
            if (!empty($value['slug'])) { ?>
                <div class="__link-wrap">
                    <div class="__link">Weiterlesen</div>
                </div>
            <?php
            } ?>

        </div>

    </div>

<?php
}
?>