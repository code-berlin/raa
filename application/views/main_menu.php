<?php
    if (isset($menu['main']) && is_array($menu['main'])) {
?>
        <div id="mobnav-btn">
            <i class="fa fa-bars"></i>
        </div>
        <ul class="js-main-menu main-menu sf-menu cla">
            <?php
                foreach ($menu['main'] as $menu_item) {

                    $slug = ($menu_item['parent_slug'] != '' ? $menu_item['parent_slug'] . '/' : '') . $menu_item['slug'];

                    if ($slug == 'home') $slug = '';

                    // Set current menu item as active if child page is being displayed
                    $is_daddy = false;

                    foreach ($menu_item['children'] as $child) {
                        $child_slug = ($child['parent_slug'] != '' ? $child['parent_slug'] . '/' : '') . $child['slug'];
                        if ($child_slug == $menu['current_page']) {
                            $is_daddy = true;
                        }
                    }

                    if ($menu['current_page'] == '') {
                        $active = $menu['current_page'] == $slug && !isset($menu_item['jumpmark']);
                    } else {
                        $active = $menu['current_page'] == $slug;
                    }

            ?>
                    <li
                        id="<?php echo $slug == '' ? 'home' : $slug ?>-menu-item"
                        class="<?php echo $active || $is_daddy ? 'active' : '' ; ?>"
                    >

                    <?php
                    if (isset($menu_item['jumpmark'])) {
                        $slug = '#jumpmark_' . $menu_item['jumpmark'];
                    }
                    ?>

                        <a
                            href="<?php echo base_url($slug); ?>"
                            title="<?php echo $menu_item['menu_title'] ?>"
                            class="<?php echo isset($menu_item['jumpmark']) ? 'js-jumpmark' : '' ?>"
                        >
                            <?php echo $menu_item['menu_title'] ?>
                        </a>

                        <?php if (!empty($menu_item['children'])) { ?>
                            <div class="mobnav-subarrow"></div>
                            <ul>

                            <?php
                                foreach ($menu_item['children'] as $child) {
                                    $slug = ($child['parent_slug'] != '' ? $child['parent_slug'] . '/' : '') . $child['slug']
                            ?>
                                    <li>
                                        <a href="<?php echo base_url($slug); ?>">
                                            <?php echo $child['menu_title'] ?>
                                        </a>
                                    </li>
                            <?php } ?>

                            </ul>
                        <?php } ?>
                </li>
        <?php } ?>
    </ul>
<?php
    }
?>