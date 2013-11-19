<?php $CI =& get_instance();?>
<div class="row">
    <div>
        RAA CMS FRONTEND
    </div>
    <div>
        Main Menu <br />
        <?php $CI->load_menu(1, 'horizontal_1'); ?>
    </div>
</div>
<div class="row">
    <div>
        Future home of RAA
    </div>
    <div>
        Sidebar <br />
        <?php $CI->load_menu(2, 'sidebar_1'); ?>
    </div>
</div>