<?php
$channels = (new \App\Entities\ChannelEntity)->getAllChannels();

$user = session()->get('user');
$img = "";
if($user && !$user['avatar']) {
    $img =site_url(settings('AVATARS_DIRECTORY') . 'noavatar.png');
} elseif($user && $user['avatar']) {
    $img = site_url(settings('AVATARS_DIRECTORY') . $user['avatar']);
} else {
    $img = site_url(settings('AVATARS_DIRECTORY') . 'noavatar.png');
} ?>

<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <img src="<?=$img?>" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline">Пупкин В.</span>
    </a>

    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

        <li class="user-header bg-primary" style="height: 150px;">
            <img src="<?=$img?>" class="img-circle elevation-2" alt="User Image">
            <p>
                Пупкин В.
            </p>
        </li>

        <li class="user-body" style="border-bottom: 1px solid #ddd;">
            <?php
            foreach ($channels as $channel) { ?>
                <a>
                    <div class="row">
                        <div class="col-12 dropdown-channel-item ">
                            <img src="<?=$channel['image']?>">
                            <span><?=$channel['title']?></span>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </li>

        <li class="user-footer">
            <a href="<?= route_to("user_profile")?>" class="btn btn-default btn-flat">Профиль</a>
            <a href="<?= route_to("logout")?>" class="btn btn-default btn-flat float-right">Выход</a>
        </li>
    </ul>
</li>
<style>
    .dropdown-channel-item {
        padding: 5px;
        border: 1px solid #ccc;
        width: 100%;
        margin-bottom: 10px;
        cursor: pointer;

        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        span {
            margin-left: 5px;
            font-weight: bolder;
        }
    }
    .dropdown-channel-item:hover {
        background-color: #e3e0ff;
    }
    .user-body > a:last-child  > .row> .dropdown-channel-item{
        margin-bottom: 0;
    }

</style>