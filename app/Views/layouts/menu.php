<?php //$user = session()->get('user'); ?>
<?php //die(var_dump($user));?>
<div class="head-nav-mobile"><a class="menu-toggle" href="#" id="menu-toggle"></a>
    <ul class="dropdown-menu-mobile" id="dropdownMenuMobile">
        <li class="dropdown-menu-mobile__list"><a class="dropdown-menu-mobile__link" href="/">Главная</a></li>
        <? foreach ($menu_items as $menu_item) {
            if (key_exists('childs', $menu_item)) { ?>
                <li class="dropdown-menu-mobile__list"><a class="dropdown-menu-mobile__link dropdown-menu-mobile__link-arrow" href="<?=$menu_item['link']?>"><?=$menu_item['title']?></a>
                    <div class="dropdown-menu-mobile__submenu">
                        <?
                        foreach ($menu_item['childs'] as $child) { ?>
                            <a class="dropdown-menu-mobile__link" href="<?= site_url($child['link'])?>"><?=$child['title']?></a>
                            <?
                        } ?>
                    </div>
                </li>
            <? } else { ?>
                <li class="dropdown-menu-mobile__list"><a class="dropdown-menu-mobile__link" href="<?= site_url($menu_item['link'])?>"><?=$menu_item['title']?></a></li>
            <? }
         }
//         $user = session()->get('user');
//         if($user) { ?>
<!--             <li class="dropdown-menu-mobile__list">-->
<!--                 <a class="dropdown-menu-mobile__link" href="--><?//= site_url(route_to('user_main'))?><!--">-->
<!--                     --><?php
//                     $avatar = $user["avatar"] ?? "noavatar.png";
//                     ?>
<!--                     <img src="--><?//=site_url("/avatars/" . $user["avatar"])?><!--" style="margin-right: 10px; height: 32px; width: 32px;border-radius: 16px;">-->
<!---->
<!--                     --><?//=$user['firstname']?>
<!--                 </a></li>-->
<!--         --><?// } else { ?>
<!--             <li class="dropdown-menu-mobile__list"><a class="dropdown-menu-mobile__link" href="--><?//= site_url('login')?><!--">Личный кабинет</a></li>-->
<!--         --><?// } ?>
    </ul>
    <div class="lower-nav"><a class="lower-nav__button" href="https://mirotvorets72.com/#calculator">расчет стоимости<div class="lower-nav__button-bg lower-nav__button-bg--calculator"></div></a><a class="lower-nav__button" href="/#order">оформить заказ<div class="lower-nav__button-bg lower-nav__button-bg--order"></div></a>
        <div class="break break--show-before-width-690 break--height-6"></div><a class="lower-nav__button" href="tel:88006007131">8 800 600 71 31<div class="lower-nav__button-bg lower-nav__button-bg--phone"></div></a><a class="lower-nav__button lower-nav__button--special" href="/pages/pallets">поддоны<div class="lower-nav__button-bg lower-nav__button-bg--bush"></div></a>
    </div>
</div>
<a class="index-page-link" href="/">
    <div class="sticker sticker--mobile-show">
        <div class="sticker__content"><img class="sticker-logo__picture" src="assets/img/nav/logo.png" alt="логитип" /></div>
    </div>
</a>

<div class="container">
    <div class="head-nav-desktop">
        <ul class="head-nav" itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList">
            <?
            $i = 0;
            foreach ($this->data['menu_items'] as $menu_item) {
                if ($i != 0) { ?>
                    <div class="head-nav__delimiter"><img src="assets/img/nav/delimiter-small.png" alt="разделитель"/>
                    </div>
                <? }
                if (key_exists('childs', $menu_item)) { ?>
                    <li class="head-nav__list" itemprop="itemListElement" itemscope="itemscope"
                        itemtype="http://schema.org/ListItem"><a class="head-nav__link head-nav__link-dropdown"
                                                                 href="#"><?= $menu_item['title'] ?></a>
                        <div class="pop-up-submenu">
                            <?
                            $u = 1;
                            foreach ($menu_item['childs'] as $child) { ?>
                                <a class="pop-up-submenu__link" href="<?= site_url($child['link'])?>" itemprop="item">
                                    <span itemprop="name"><?=$child['title']?></span>
                                </a>
                                <meta itemprop="position" content="<?=$u?>"/>
                                <?
                            $u++;
                            } ?>
                        </div>
                    </li>
                <? } else { ?>
                    <li class="head-nav__list" itemprop="itemListElement" itemscope="itemscope"
                        itemtype="http://schema.org/ListItem"><a class="head-nav__link" href="<?= site_url($menu_item['link']) ?>" itemprop="item"><span
                                    itemprop="name"><?= $menu_item['title'] ?></span></a>
                        <meta itemprop="position" content="<?=$i?>"/>
                    </li>
                <? }
                $i++;
            } ?>
<!--            <div class="head-nav__delimiter"><img src="assets/img/nav/delimiter-small.png" alt="разделитель"/>-->
<!--            </div>-->
<!--            --><?// if($user) { ?>
<!--                <li class="head-nav__list" itemprop="itemListElement" itemscope="itemscope"-->
<!--                    itemtype="http://schema.org/ListItem"><a class="head-nav__link head-nav__link-dropdown" href="--><?//= site_url('/') ?><!--" itemprop="item">-->
<!--                        --><?php
//                        $avatar = $user["avatar"] ?? "noavatar.png";
//                        ?>
<!--                        <img src="--><?//=site_url("/avatars/" . $user["avatar"])?><!--" style="margin-right: 10px; height: 32px; width: 32px;border-radius: 16px;">-->
<!--                        <span itemprop="name">--><?//= $user['firstname'] ?><!--</span>-->
<!--                    </a>-->
<!--                    <meta itemprop="position" content="--><?//=$i?><!--"/>-->
<!--                    <div class="pop-up-submenu" style="right: -35px;left: unset;">-->
<!--                        --><?php
//                        if(session()->get('isAdmin')) { ?>
<!--                            <a class="pop-up-submenu__link" href="--><?//= site_url('admin')?><!--" itemprop="item">-->
<!--                                <span itemprop="name">Панель администратора</span>-->
<!--                            </a>-->
<!--                        --><?// } ?>
<!--                        <a class="pop-up-submenu__link" href="--><?//= route_to('user_main')?><!--" itemprop="item">-->
<!--                            <span itemprop="name">Личный кабинет</span>-->
<!--                        </a>-->
<!--                        <a class="pop-up-submenu__link" href="--><?//= route_to('logout')?><!--" itemprop="item">-->
<!--                            <span itemprop="name">Выход</span>-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </li>-->
<!--            --><?// } else { ?>
<!--                <li class="head-nav__list" itemprop="itemListElement" itemscope="itemscope"-->
<!--                    itemtype="http://schema.org/ListItem"><a class="head-nav__link" href="--><?//= site_url('login') ?><!--" itemprop="item"><span-->
<!--                                itemprop="name">Личный кабинет</span></a>-->
<!--                    <meta itemprop="position" content="--><?//=$i?><!--"/>-->
<!--                </li>-->
<!--            --><?// } ?>
        </ul>
        <a class="index-page-link" href="/">
            <div class="sticker">
                <div class="sticker__content"><img class="sticker-logo__picture" src="assets/img/nav/logo.png"
                                                   alt="логитип"/></div>
            </div>
        </a>
        <div class="lower-nav">
            <a class="lower-nav__button" href="<?= site_url('/#calculator') ?>">
                расчет стоимости
                <div class="lower-nav__button-bg lower-nav__button-bg--calculator"></div>
            </a>
            <a class="lower-nav__button" href="<?= site_url('/#order') ?>">
                оформить заказ
                <div class="lower-nav__button-bg lower-nav__button-bg--order"></div>
            </a>
            <a class="lower-nav__button" href="tel:88006007131">
                8 800 600 71 31
                <div class="lower-nav__button-bg lower-nav__button-bg--phone"></div>
            </a>
            <a class="lower-nav__button lower-nav__button--special" href="<?= site_url("/pages/pallets") ?>">
                поддоны
                <div class="lower-nav__button-bg lower-nav__button-bg--bush"></div>
            </a>
        </div>
    </div>
</div>
