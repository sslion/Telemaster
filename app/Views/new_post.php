<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-app">
                            <i class="fa fa-text-height"></i>
                            <span class="btn-title">Текст</span>
                        </a>

                        <a class="btn btn-app">
                            <i class="fa fa-text-height"></i>
                            <span class="btn-title">С картинкой</span>
                        </a>

                        <a class="btn btn-app">
                            <i class="fa fa-video"></i>
                            <span class="btn-title">С видео</span>
                        </a>

                        <a class="btn btn-app">
                            <i class="fas fa-list"></i>
                            <span class="btn-title">Опрос</span>
                        </a>

                        <button id="newPost">jdjddh</button>
                    </div>

                </div>

            </div>
            <div class="col-md-8">
                <div class="card">
                    Card
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display:none;" id="fox" >
    <div>
        <div class="fancydialog-title"></div>
        <form class="fancyinner" id="modal_form">

            <div class="form_row">
                <label class="form-label">Материал</label>
                <!--                                <select id="select2" style="width: 300px;" id="material">-->
                <select id="material" style="width: 300px;">
                    <option value="0" data-type="0" selected="selected">Выберите материал</option>

                </select>
            </div>

            <div class="form_row">
                <label class="form-label">Количество</label><input class="form-input_text" type="number"
                                                                   id="amount" value="">
            </div>
            <div class="form_row">
                <label class="form-label">Цена</label><input class="form-input_text" type="number"
                                                             id="price" value="">
            </div>
            <div class="form_row">
                <button type="reset" class="btn btn-warning float-right" style="margin-bottom: 15px;" id="reset_form">
                    Отмена
                </button>
                <button type="button" class="btn btn-info float-right" style="margin-right: 15px;" id="save_item">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .btn-app {
        border-radius: 4px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        color: #6c757d;
        font-size: 1.1rem;
        height: 70px;
        margin: 0 0 10px 10px;
        min-width: 80px;
        padding: 15px 5px;
        position: relative;
        text-align: center;

        .btn-title {
            font-size: 12px;
        }
    }
</style>
<script>
    window.onload = function () {
        $("#newPost").click(function () {
            $.fancybox.open($('#fox'), {
                beforeClose: function (instance, slide) {
                },
                animationEffect: "zoom-in-out",
            });

            //APP.post({}, "<?//=route_to("admin_newPost")?>//");
        });


    };


</script>