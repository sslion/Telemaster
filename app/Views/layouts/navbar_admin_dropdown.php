<?
if(!empty($user["isAdmin"])) {
    $menu_mdl = new \App\Models\MenuModel();
    $menus = $menu_mdl->getMenus();
    ?>
    <li class="nav-item dropdown d-none d-sm-inline-block">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link dropdown-toggle">Интерфейс</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow dropdown-menu-right" style="left: 0px; right: inherit;">
            <? foreach ($menus as $item) { ?>
                <li><a href="#" class="dropdown-item"><?=$item["title"]?></a></li>
            <? } ?>
        </ul>
    </li>
<? } ?>