<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" style="text-align: center;">
                <img class="dashboard-logo" src="images/logo.png">
                <a class="btn btn-info btn-block" style="color: #fff;">Добавить публикаию</a>
                <button id="newPost" class="btn btn-info btn-block">Отправить публикаию</button>
                <button class="btn btn-info btn-block">Добавить опрос</button>
                <button class="btn btn-info btn-block">Добавить канал</button>
            </div>
            <div class="col-md-8">
                <?=$channels_card?>
                <?=$card?>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        $("#newPost").click(function () {
            APP.post({}, "<?=route_to("admin_newPost")?>");
        });
    }
</script>