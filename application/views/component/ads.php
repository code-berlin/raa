<?php if (isset($ad_tag)) { ?>
    <div id="cis<?php echo $ad_id ?>_box" class="cis_container" data-dfpname="/75836183/<?php echo $ad_name; ?>">
        <div class="cis_head"><?= lang('ad') ?></div>
        <div class="cis_box">
            <div id='<?php echo $ad_tag; ?>' class="cis_content" data-slot="<?php echo $ad_tag; ?>" data-name="<?php echo $ad_name; ?>" data-map="<?php echo $ad_map; ?>"> 
            </div>
        </div>
    </div>
<?php } ?>