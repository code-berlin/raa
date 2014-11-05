<nav>
    <ul>
        <?php
            foreach ($menu_items as $menu_item) {
                $slug = $menu_item['slug'];

                if ($slug == 'home') $slug = '';

                $url = ($menu_item['main_category'] != 1) ? '/'.$slug : '#';

                // Set current menu item as active if child page is being displayed
                $is_daddy = false;
                foreach ($menu_item['children'] as $child) {
                    $child_slug = $child['slug'];
                    if ($child_slug == $current_page) {
                        $is_daddy = true;
                    }
                }

        ?>
                <li id="<?php echo $slug == '' ? 'home' : $slug ?>-menu-item" class="main-menu-item <?php echo $current_page == $slug || $is_daddy ? 'active' : '' ; ?>">
                    <a href="<?php echo $url ?>" class="parent-link">
                        <?php echo $menu_item['menu_title'] ?>
                    </a>

                    <?php if (!empty($menu_item['children'])) { ?>
                        <ul class="submenu">

                        <?php
                            foreach ($menu_item['children'] as $child) {
                                $slug = $child['slug'];
                        ?>
                                <li>
                                    <a href="/<?php echo $slug ?>" class="child-link">
                                        <?php echo $child['menu_title'] ?>
                                    </a>
                                </li>
                        <?php } ?>

                        </ul>
                    <?php } ?>
                </li>
        <?php } ?>
    </ul>
</nav>