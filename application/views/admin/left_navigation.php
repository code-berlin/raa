<div class="admin-left">
    <?php if (isset($sidebar)) { ?>
        <ul class="left-navigation-items nav nav-list">

            <?php if ($sidebar['VIEW_USERS']) { ?>
                <li class="nav-header">Users / Permissions</li>
                <li>
                    <a href='<?php echo site_url('admin/user')?>'>Users</a>
                </li>
            <?php } ?>
            <?php if ($sidebar['VIEW_ROLES']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/role')?>'>Roles</a>
                </li>
            <?php } ?>
            <?php if ($sidebar['VIEW_SECTIONS']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/section')?>'>Sections</a>
                </li>
            <?php } ?>
            <?php if ($sidebar['VIEW_PERMISSIONS']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/permission')?>'>Permissions</a>
                </li>
            <?php } ?>

            <li class="nav-header">Pages</li>
            <?php if ($sidebar['VIEW_PAGE']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/page')?>'>Pages</a>
                </li>
            <?php } ?>

            <?php if ($sidebar['VIEW_PRODUCT']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/product')?>'>Products</a>
                </li>
            <?php } ?>

            <?php if ($sidebar['VIEW_MENU']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/menu')?>'>Menus</a>
                </li>
            <?php } ?>

            <?php if ($sidebar['VIEW_WIDGETS']) { ?>
                <li class="nav-header">Widgets</li>
                <li>
                    <a href='<?php echo site_url('admin/widgets_container')?>'>Container</a>
                </li>
                <li>
                    <a href='<?php echo site_url('admin/widget')?>'>Widget</a>
                </li>
            <?php } ?>

            <?php if ($sidebar['VIEW_SETTINGS']) { ?>
                <li class="nav-header">Settings</li>
                <li>
                    <a href='<?php echo site_url('admin/general_settings')?>'>General Settings</a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>

