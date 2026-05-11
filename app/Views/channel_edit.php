<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body align-content-lg-center" style="text-align: center;">
                        <?php
                        if ($noPhoto) { ?>
                            <input type="hidden" id="photoURL" value="">
                        <?php } else { ?>
                            <input type="hidden" id="photoURL" value="<?= $fileUrl ?>">
                        <?php } ?>
                        <img src="<?= $fileUrl ?>" alt="<?= $channel["title"] ?>"
                             class="brand-image img-circle elevation-3"
                             style="background-color: white; padding: 3px;width: 100%;margin-bottom: 20px;">
                        <span class="channel-subscribers"><i class="fa fa-users"></i> <?=$subscribers?></span>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body p-0">
                        <form role="form">
                            <input type="hidden" id="channelID" value="<?= $channelID ?>">
                            <input type="hidden" id="channelUsername" value="<?= $channel["username"] ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="channelTitle">Название канала</label>
                                    <input value="<?= $channel["title"] ?>" type="text" class="form-control" id="channelTitle" placeholder="ВВедите название канала">
                                </div>
                                <div class="form-group">
                                    <label for="channelDescription">Описание канала</label>
                                    <textarea rows="6" class="form-control" id="channelDescription" placeholder="ВВедите описание канала"><?= $channel["description"] ?></textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button id="submitForm" type="button" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
</style>
<script>
    window.onload = function () {
        $("#submitForm").click(function (e) {
            let data = {
                id: $("#channelID").val(),
                title: $("#channelTitle").val(),
                description: $("#channelDescription").val(),
                photoURL: $("#photoURL").val(),
                username: $("#channelUsername").val(),
            };

            APP.post(data, '<?=route_to("admin_saveChannel")?>', function (result) {
                if(result.status == "success") {
                    toastr.success("Изменения сохранены", 'Успешно');
                } else {
                    toastr.error(result.message, 'Ошибка');
                }
            },
            function (result) {
                console.log(result)
                toastr.error("", 'Ошибка');
            });
            //window.location = "<?//=route_to("admin_editChannel") . "/?channel="?>//" + channel;
        });
    }
</script>