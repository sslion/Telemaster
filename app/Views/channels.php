<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php
            foreach ($channels as $channel) {
                $channel["description"] = str_replace("\n", "<br>", $channel["description"]);
                ?>
            <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title"><?= $channel["title"] ?></h2>
                            <div class="card-tools">
                                <div class="btn-group buttons">
                                    <button data-channel_id="<?=$channel["id"]?>" type="button" class="btn btn-default edit-channel"><i class="fa fa-edit" style="font-size: 1.1rem;margin: 5px;"></i></button>
                                    <button data-channel_id="<?=$channel["id"]?>" type="button" class="btn btn-default delete-channel"><i class="fa fa-trash" style="font-size: 1.1rem; color: red;"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body-content">
                                <?php $src = ($channel["image"]) ? $channel["image"] : "images/channelNoPhoto.png"; ?>
                                <div class="card-image">
                                    <img src="<?=$src?>" alt="<?=$channel["title"]?>" class="brand-image img-circle elevation-1"
                                         style="background-color: white; padding: 3px;width: 120px; height: 120px; margin: 10px;">
                                    <span class="channel-username"><?=$channel["username"]?></span><br>
                                </div>
                                <div class="channel-info">
                                    <span class="channel-description"><?=$channel["description"]?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-footer-info float-left">
                               <span class="channel-subscribers"><i class="fa fa-users"></i> <?=$channel["subscribers"]?></span>
                                <?php
                                if (!empty($channel["error"])) { ?>
                                <span class="channel-error" data-messge="<?=$channel["error"]["message"]?>"><i class="fa fa-exclamation-triangle"></i> <?=$channel["error"]["message"]?></span>

                                <?php } ?>
                            </div>
                            <div class="card-footer-buttons float-right">
                                <button data-channel_id="<?=$channel["id"]?>" class="btn btn-sm btn-info new-post">Новый пост</button>
                            </div>
                        </div>
                    </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<style>
    .card-body-content {
        display: flex;
    }
    .card-image {
        display: inline-block;
        text-align: center;
    }
    .brand-image {
        display: block;
    }

    .channel-info {
        display: inline-block;
    }
    .channel-title {
        font-weight: 500;
        font-size: 18px;
    }
    .channel-username {
        font-size: 14px;
        color: grey;
    }
    .channel-description {
        font-weight: 500;
        font-size: 18px;
    }
    .channel-error {
        color: red;
    }

    .buttons {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
    }
    .card-footer-info {
        font-size: 1.2rem;
    }
</style>
<script>
    window.onload = function () {
        $(".edit-channel").click(function (e) {
            e.preventDefault();
            let channel = $(e.currentTarget).data("channel_id");
            window.location = "<?=route_to("admin_editChannel") . "/?channel="?>" + channel;
        });

        $('.new-post').click(function (e) {
            e.preventDefault()
            let channel = $(e.currentTarget).data("channel_id");
            window.location = "<?=route_to("admin_newPost") . "/?channel="?>" + channel;
        });

        $('.edit-channel').each(function () {
            tippy(this, {
                content: "Редактировать канал",
                // allowHTML: true,
                // followCursor: 'horizontal',
            });
        });

        $('.channel-error').each(function (el) {
            console.log("Добавили тип");
            console.log(el);
            tippy(this, {
                content: $(this).data("message"),
                allowHTML: true,
                followCursor: 'horizontal',
            });
        });

        $('.delete-channel').each(function () {
            tippy(this, {
                content: "Удалить канал",
                allowHTML: true,
                followCursor: 'horizontal',
            });
        });

        $('.channel-subscribers').each(function () {
            tippy(this, {
                content: "Количество подписчиков",
                allowHTML: true,
                followCursor: 'horizontal',
            });
        });

        $('.new-post').each(function () {
            tippy(this, {
                content: "Добавить новый пост",
                allowHTML: true,
                followCursor: 'horizontal',
            });
        });
    }
</script>