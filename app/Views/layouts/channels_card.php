<div class="buttons-wrapper" style="margin-bottom: 15px;">
    <button id="newChannel" class="btn btn-info add-channel" >
        <i class="fa fa-plus"></i> Добавить канал
    </button>
</div>

<div class="card">
    <div class="card-body p-0">
        <ul class="channels clearfix">
            <?php
            foreach ($channels as $channel) {
                $src = ($channel["image"]) ? $channel["image"] : "images/channelNoPhoto.png";
                ?>
            <li>
                <div class="card-image">
                    <img src="<?=$src?>" alt="<?=$channel["title"]?>" class="brand-image img-circle elevation-1"
                         style="background-color: white; padding: 3px;width: 80px; height: 80px; margin: 10px;">
                </div>
                <div class="channel-title" ><?=$channel["title"]?><br>
                    <a target="_blank" href="http://t.me/<?=str_replace("@", "", $channel["username"])?>"> <span class="channel-username"><?=$channel["username"]?></span></a>
                </div>

                <div class="btn-group channel-dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                        <a href="#" class="dropdown-item"><i class="fa fa-info"></i>&nbsp;&nbsp;Информация о канале</a>
                        <a href="#" class="dropdown-item" style="color: red"><i class="fa fa-trash"></i>&nbsp;&nbsp;Удалить канал</a>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>

<div style="display:none;padding: 3px; background-color: #d4e9ff; width: 600px;" id="newChannelModal">
    <div>
        <div class="fancydialog-title">Добавить канал</div>
        <form class="fancyinner" id="modal_form">
            <div class="form_row">
                <input class="form-input_text" type="text" id="channelName" value="" placeholder="Введите ID канала">
                <button class="search-btn"><i class="fa fa-search"></i></button>
            </div>

            <div class="channel-preview" style="margin-bottom: 10px">
                <div class="preview-image-circle">&nbsp;</div>
                <div class="preview-info-wrapper">
                    <div class="preview-title">&nbsp;</div>
                    <div class="preview-description">&nbsp;</div>
                </div>
            </div>

            <div class="channel-view" style="display:none; margin-bottom: 10px">
                <img class="view-image-circle">
                <div class="view-info-wrapper">
                    <div class="view-title">&nbsp;</div>
                    <div class="view-description">&nbsp;</div>
                </div>
            </div>

            <div class="form_row buttons-wrapper">
                <button type="button" class="btn btn-info" id="save_item" style="margin-right: 10px;">
                    Сохранить
                </button>
                <button type="reset" class="btn btn-warning" id="reset_form">
                    Отмена
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    :root {
        --radius: 12px;
    }

    .search-btn {
        height: 36px;
        width: 36px;
        line-height: 34px;
        padding: 0;
        margin-left: 10px;
        border-radius: 50%;
        border: 1px solid #969696;
        background-color: white;
        color: #575757;
    }
    .buttons-wrapper {
        display: flex;
        justify-content: flex-end;
        /*padding: 10px 10px 0 0;*/
        /*margin-bottom: 15px;*/
    }

    .fancybox-content {
        background-image: unset;
        background-size: unset;
        overflow: unset;
        border-radius: var(--radius);
    }
    .fancybox-content > div {
        background-image: url(/templates/adminlte/dist/img/form_bg2.png);
        background-size: cover;
        padding: 0px;
        overflow: unset;
        border-radius: var(--radius);
    }
    .fancydialog-title {
        border-radius: var(--radius) var(--radius) 0 0;
    }
    .card-image {
        display: inline-block;
        text-align: center;
    }
    .channels {
        list-style: none;
        padding: 15px 15px 0 15px;

        li {
            border: 1px solid #ddd;
            margin-bottom: 15px;
            border-radius: 18px;
            background-color: rgb(250, 250, 255);
            position: relative;
        }
        li:hover {
            background-color: rgb(245, 245, 245);
        }
    }
    .channel-title {
        font-size: 1.1rem;
        display: inline-block;
        margin: 0 0 0 10px;
        vertical-align: middle;
    }
    .channel-username {
        font-size: 0.9rem;
    }
    .channel-dropdown {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .channel-preview, .channel-view {
        background-color: white;
        padding: 10px;
        display: flex;
    }
    .preview-image-circle, .view-image-circle {
        background-color: #eee;
        border-radius: 50%;
        height: 80px;
        width: 80px;
        min-width: 80px;
        margin-right: 15px;
        box-shadow: 1px 1px;
        border: 1px solid #bbb;
    }
    .preview-info-wrapper, .view-info-wrapper {
        display: flex;
        width: 100%;
        flex-direction: column;
    }
    .preview-title {
        background-color: #eee;
        height: 18px;
        width: 65%;
        margin-bottom: 5px;
    }
    .preview-description {
        background-color: #eee;
        height: 100%;
    }
    .view-title {
        margin-bottom: 5px;
        font-weight: 600;
    }
    .view-description {
        height: 100%;
    }
    .gradient  {
        background-image: repeating-linear-gradient(-45deg, #c9c9c9 16%, #ffffff 36%, #ffffff 14%, #c9c9c9 48%);
        background-size: 300% 100%;
        animation: gradient 10s linear infinite;
    }

    @keyframes gradient {
        100% {
            background-position: 100% 100%;
        }
    }
</style>
<script>
    $(function () {
        $("#newChannel").click(function () {
            $.fancybox.open($('#newChannelModal'), {
                animationDuration: 500,
                animationEffect: "zoom-in-out",
            });
        });

        $(".search-btn").click(function (e) {
            e.preventDefault();
            let channelName = $('#channelName').val();

            if(channelName === "" || channelName.length < 3 || channelName.length > 50) {
                toastr.warning("Имя канала должно быть от 3 до 50 символов", 'Внимание');
                return;
            }

            $('.preview-image-circle,  .preview-title, .preview-description').addClass('gradient');
            $('.channel-preview').show();
            $('.channel-view').hide();

            let data = {
                channelName: channelName
            };

            APP.post(data, "<?=route_to("admin_checkChannel")?>", function (resp) {
                if(resp.status == 'success') {
                    $('.preview-image-circle,  .preview-title, .preview-description').removeClass('gradient');
                    $('.channel-preview').hide();
                    $('.channel-view').show();

                    $('.view-title').text(resp.data.title);
                    $('.view-description').html(resp.data.description);
                    $('.view-image-circle').attr("src", resp.data.image);
                } else {
                    toastr.error(resp.message, 'Ощибка');
                }
            });
        });
        $("#reset_form").click(function () {
            $.fancybox.close($('#newChannelModal'));
        })

        $tip = "ID канала может быть в формате<br><b>@mychannel</b><&nbsp;&nbsp;&nbsp;или&nbsp;&nbsp;<b>t.me/@mychannel</b>";
        let firstTime = true;
        tippy('#channelName', {
            content: $tip,
            allowHTML: true,
            followCursor: 'horizontal',
            placement: 'bottom',
            zIndex:999999,
            showOnCreate: false,
            onShow: function (o) {
                if(firstTime) {
                    firstTime = false;
                    return false;
                }
            }
        });
    });
</script>