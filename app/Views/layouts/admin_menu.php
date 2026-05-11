<?php
$cur_menu = ($cur_menu == '') ? 'dashboard' : $cur_menu;
$menu_items = (new \App\Models\MenuModel())->getAdminMenu();

if(count($menu_items)) { ?>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <?php
    foreach ($menu_items as $key => $menu_item) {
        if (key_exists('childs', $menu_item)) {
            $open = $active = '';
            if($cur_menu == $menu_item["code"]) {
                $open = 'menu-open';
                $active = 'active';
                }
            ?>
        <li class="nav-item has-treeview <?= $open?>">
            <a href="#" class="nav-link <?= $active?>">
                <i class="<?= $menu_item['icon'] ?>"></i>
                    <?php if (key_exists('item_id', $menu_item)) {
                        echo "<p id='{$menu_item['item_id']}'>";
                        } else {
                        echo "<p>";
                        }
                    ?>
                    <?= $menu_item['title'] ?>
                    <i class="right fa fa-angle-right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="background-color: rgb(67, 76, 84);">
                    <?php
                    foreach ($menu_item['childs'] as $sub_key => $child) {
                        $active = '';
                        //echo "cur_sub_menu: $cur_menu, sub_key:$sub_key";
                        if($cur_sub_menu == $child["code"]) {
                            $active = 'active';
                            }
                        ?>
                <li class="nav-item" style="font-size: .9rem; padding-left: 10px;">
                        <a href="<?= $child['link'] ?>" class="nav-link  <?= $active ?>">
                            <i class="<?= $child['icon'] ?>"></i>
                            <?php if (key_exists('item_id', $menu_item)) {
                                    echo "<p id='{$menu_item['item_id']}'>";
                                } else {
                                    echo "<p>";
                                } ?>
                            <?= $child['title'] ?></p>
                        </a>
                </li>
                        <?
                    } ?>
            </ul>
        </li>
        <?php
        } else {
            $active = '';
            if($cur_menu == $menu_item["code"]) {
                $active = 'active';
            }
        ?>
            <li class="nav-item">
                <a href="<?= $menu_item['link'] ?>" class="nav-link  <?= $active ?>">
                    <i class="<?= $menu_item['icon'] ?>"></i>
                     <?php
                     if (key_exists('item_id', $menu_item)) {
                        echo "<p id='{$menu_item['item_id']}'>";
                    } else {
                        echo "<p>";
                    } ?>
                      <?= $menu_item['title']  ?></p>
                </a>
            </li>
        <? }
    }
} ?>