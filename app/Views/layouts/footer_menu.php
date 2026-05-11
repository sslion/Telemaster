<?php $user = session()->get('user'); ?>
<nav class="footer-nav-bg">
    <div class="container pos-rel">
        <ul class="foot-nav" >
            <? $i = 0;
             foreach ($menu_items as $menu_item) {

                if (key_exists('childs', $menu_item)) { ?>
                    <li class="foot-nav__list">
                        <a class="foot-nav__link foot-nav__link-dropdown" href="<?= site_url($menu_item['link']) ?>"><?=$menu_item['title']?></a>
                        <div class="pop-up-submenu-footer">
                            <?
                            $u = 1;
                            foreach ($menu_item['childs'] as $child) { ?>
                                <a class="pop-up-submenu__link" href="<?= site_url($child['link']) ?>"><?=$child['title']?></a>
                                <?
                                $u++;
                            } ?>
                        </div>
                    </li>
                <? } else { ?>
                    <li class="foot-nav__list"><a class="foot-nav__link" href="<?= site_url($menu_item['link']) ?>"><?=$menu_item['title']?></a></li>
                <? }
                $i++;
                 if($i != 0) { ?>
                     <div class="head-nav__delimiter"><img src="assets/img/nav/delimiter-small.png" alt="разделитель" /></div>
                 <? }
             } ?>
<!--            --><?// if($user) { ?>
<!--                <li class="foot-nav__list" >-->
<!--                    <a class="foot-nav__link foot-nav__link-dropdown" href="--><?//= site_url('/') ?><!--">-->
<!--                        --><?php
//                        $avatar = $user["avatar"] ?? "noavatar.png";
//                        ?>
<!--                        <img src="--><?//=site_url("/avatars/" . $user["avatar"])?><!--" style="margin-right: 10px; height: 32px; width: 32px;">-->
<!--                        <span itemprop="name">--><?//= $user['firstname'] ?><!--</span>-->
<!--                    </a>-->
<!--                    <div class="pop-up-submenu-footer" style="right: -35px; left: unset;">-->
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
<!--                <li class="foot-nav__list" itemprop="itemListElement" itemscope="itemscope"-->
<!--                    itemtype="http://schema.org/ListItem"><a class="foot-nav__link" href="--><?//= site_url('login') ?><!--" itemprop="item"><span-->
<!--                                itemprop="name">Личный кабинет</span></a>-->
<!--                    <meta itemprop="position" content="--><?//=$i?><!--"/>-->
<!--                </li>-->
<!--            --><?// } ?>
        </ul>
    </div>
</nav>