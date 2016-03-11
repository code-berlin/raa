<div class="admin-left">
    <?php if (isset($sidebar)) { ?>
        <ul class="left-navigation-items nav nav-list">

            <?php if ($sidebar['VIEW_USER']) { ?>
                <li class="nav-header">Users / Permissions</li>
                <li>
                    <a href='<?php echo site_url('admin/user'); ?>'>Users</a>
                </li>
            <?php } ?>
            <li>
                <a href='<?php echo site_url('admin/profile'); ?>'>Profile</a>
            </li>
            <?php if ($sidebar['VIEW_ROLE']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/role'); ?>'>Roles</a>
                </li>
            <?php } ?>
            <?php if ($sidebar['VIEW_SECTION']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/section'); ?>'>Sections</a>
                </li>
            <?php } ?>
            <?php if ($sidebar['VIEW_PERMISSION']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/permission'); ?>'>Permissions</a>
                </li>
                <li>
                    <a href='<?php echo site_url('admin/permissions_group'); ?>'>Group of permissions </a>
                </li>
            <?php } ?>

            <li class="nav-header">Pages</li>
            <?php if ($sidebar['VIEW_PAGE']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/page'); ?>'>Pages</a>
                </li>
            <?php } ?>

            <li>
                <a href='<?php echo site_url('admin/facebook_app'); ?>'>Facebook Apps</a>
            </li>

            <li>
                <a href='<?php echo site_url('admin/facebook_page'); ?>'>Facebook Pages</a>
            </li>

            <?php if ($sidebar['VIEW_PRODUCT']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/product'); ?>'>Products</a>
                </li>
            <?php } ?>

            <li class="nav-header">Menu</li>
            <?php if ($sidebar['VIEW_MENU']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/menu'); ?>'>Menus</a>
                </li>
            <?php } ?>


            <li class="nav-header">Author</li>
            <?php if ($sidebar['VIEW_PAGE']) { ?>
                <li>
                    <a href='<?php echo site_url('admin/author'); ?>'>Author</a>
                </li>
            <?php } ?>

            <?php if ($sidebar['VIEW_WIDGETS']) { ?>
                <li class="nav-header">Widgets</li>
                <li>
                    <a href='<?php echo site_url('admin/widgets_container'); ?>'>Container</a>
                </li>
                <li>
                    <a href='<?php echo site_url('admin/widget'); ?>'>Widget</a>
                </li>
            <?php } ?>

            <?php if ($sidebar['EDIT_SIDEBAR_TEASER']) { ?>
                <li class="nav-header">Sidebar Teaser</li>
                <li>
                    <a href='<?php echo site_url('admin/sidebar_teaser'); ?>'>Sidebar Teaser</a>
                </li>
            <?php } ?>

            <?php if ($sidebar['VIEW_GENERAL_SETTINGS']) { ?>
                <li class="nav-header">Settings</li>
                <li>
                    <a href='<?php echo site_url('admin/general_settings'); ?>'>General Settings</a>
                </li>
            <?php } ?>

            <?php if ($sidebar['TRANSLATE_CONTENT']) { ?>
                <li class="nav-header">Language</li>
                <li>
                    <a href='<?php echo site_url('admin/language'); ?>'>CMS Languages</a>
                </li>
            <?php } ?>

        </ul>
    <?php } ?>
</div>

