<link rel="stylesheet" href="plugins/icheck-bootstrap\icheck-bootstrap.min.css">
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?php
$tags = [
    45 => 'mirotvorets72.com',
    46 => 'Какой-то тэг'
];
if(!empty($order)) {
    $order = reset($order);
    $details = json_decode($order['details'], true);
}

//var_dump(session()->get());
$currentUser = session('user')['id'];
?>
<?
//var_dump($order);
//exit();
?>

<script>
    window.addEventListener('load', function(){
        let modalPromt = document.createElement('div');
        let modalTitle = document.createElement('div');
        let modalInner = document.createElement('div');
        let modalRow = document.createElement('div');
        let btnYes = document.createElement('button');

        modalPromt.id = 'modalPromt';
        modalPromt.style.display = 'block';

        modalTitle.innerText = "hello"
        modalTitle.classList.add('fancydialog-title');

        modalInner.classList.add('fancyinner');
        modalInner.style.width = '490px';
        modalInner.style.height = '300px';
        modalRow.classList.add('form_row');

        modalPromt.appendChild(modalTitle)
        modalPromt.appendChild(modalInner)
        modalInner.appendChild(modalRow);

        modalInner.appendChild('<h1>this is H1</h1>');

        modalRow.appendChild(btnYes);
        btnYes.classList.add('btn');
        btnYes.classList.add('btn-warning');
        btnYes.classList.add('float-right');
        btnYes.innerText = 'Да';

        let btnNo = btnYes.cloneNode();
        btnNo.innerText = 'Нет ';
        modalRow.appendChild(btnNo);

        document.body.appendChild(modalPromt)
        $.fancybox.open(modalPromt);
    })
</script>


<div style="display:none;" id="fox1" >
        <div class="fancydialog-title"></div>
        <div class="fancyinner" id="modal_form">

            <div class="form_row">
                <button type="reset" class="btn btn-warning float-right" style="margin-bottom: 15px;" id="reset_form">
                    Отмена
                </button>
                <button type="button" class="btn btn-info float-right" style="margin-right: 15px;" id="save_item">
                    Сохранить
                </button>
            </div>
        </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-details">

                    <div class="card-header">
                        <label for="order_title">Назватие заявки: </label>
                        <?php
                        $orderTitle = (!empty($order)) ? ((!empty($details['orderTitle'])) ? $details['orderTitle'] : $order['order_title']) : '';
                        ?>
                        <input class="form-input_text" type="text" id="order_title" value="<?=$orderTitle?>" style="width: 100%;">

                        <label for="operation-date">Дата: </label>
                        <?php $date = date("Y-m-d", time());  ?>
                        <input class="form-input_text" id="operation-date" type="date" style="height: 36px;" value="<?=(!empty($details)) ? $details['operationDate'] : $date?>">

                        <label for="tags">Тэги: </label>
                        <select id="tags" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Выберите тэги" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                            <?php
                            if(empty($order) || empty(json_decode($order['tags'], true))) {
                                $orderTags = [];
                            } else {
                                $orderTags = json_decode($order['tags'], true);
                            }
                            foreach ($tags as $key => $tag) {
                                if(!empty($order)) {
                                    $selected = '';
                                    $k = array_search($key, array_column($orderTags, 'id'));
                                    if($k !== false) $selected = 'selected';
                                    echo "<option {$selected} data-select2-id='{$key}'>{$tag}</option>";
                                } else {
                                    echo "<option data-select2-id='{$key}'>{$tag}</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="status">Статус: </label>
                        <select class="nice-select small status w100p" id="status">
                            <option value="">Установите статус</option>
                            <?php
                            foreach ($statuses as $status) {
                                if($status['parent_id'] == 1968781) {
                                    $selected = '';
                                    if(!empty($order) && $status['amocrm_id'] == $order['status']) $selected = 'selected';
                                    $style = 'line-height:24px; background-color: ' . $status['color'] . ';';
                                    echo "<option {$selected} style='{$style}' value='{$status['id']}' class='opt'>{$status['title']}</option>";
                                }
                            } ?>
                        </select>

                        <label for="operation-date">Адрес заявки: </label>
                        <input class="form-input_text" id="order-address" type="text" style="height: 36px;" value="<?=(!empty($order)) ? $order['address'] : ''?>">

                        <div>
                            <label for="shouse">Склад: </label>
                            <select class="nice-select small shouse" id="shouse">
                                <option value="">Выберите склад</option>
                                <?php
                                foreach ($shouses as $shouse) {
                                    $selected = '';
//                                    if(!empty($order) && !empty($details['shouseID']) && $details['shouseID'] == $shouse['id']) $selected = 'selected';
                                    if(!empty($order) && !empty($order['shouse_id']) && $order['shouse_id'] == $shouse['id']) $selected = 'selected';
                                    echo "<option {$selected} value='{$shouse['id']}'>{$shouse['name']}</option>";
                                } ?>
                            </select>

                            <?php // подгружаем поля поиска клиента ?>
                            <label for="manager">Клиент: </label>
                            <?=view("layouts/client_form_main");?>

                            <label for="manager">Ответственный: </label>
                            <select class="nice-select small w100p" id="manager">
                                <option value="0">Выберите сотрудника</option>
                                <?php
                                foreach ($profiles as $profile) {
                                    $selected = '';
//                                    if(!empty($order) && !empty($details['managerID']) &&  $details['managerID'] == $profile['id']) $selected = 'selected';
                                    if(!empty($order) && !empty($details['managerID']) &&  $details['managerID'] == $profile['id']) $selected = 'selected';
                                    echo "<option {$selected} value='{$profile['id']}'>{$profile['firstname']} {$profile['lastname']}</option>";
                                }
                                ?>
                            </select>

                            <label for="driver">Водитель: </label>
                            <select class="nice-select small w100p" id="driver">
                                <option value="0">Выберите сотрудника</option>
                                <?php
                                foreach ($profiles as $profile) {
                                    $selected = '';
                                    if(!empty($order) && !empty($details['driverID']) &&  $details['driverID'] == $profile['id']) $selected = 'selected';

                                    echo "<option {$selected} value='{$profile['id']}'>{$profile['firstname']} {$profile['lastname']}</option>";
                                }
                                ?>
                            </select>

                            <label for="car">Номер машины: </label>
                            <select class="nice-select small w100p" id="car">
                                <option value="0">Выберите машину</option>
                                <?php
                                foreach ($cars as $car) {
                                    $selected = '';
                                    if(!empty($order) && !empty($details['carID']) &&  $details['carID'] == $car['id']) $selected = 'selected';

                                    echo "<option {$selected} value='{$car['id']}'>{$car["title"]}</option>";
                                }
                                ?>
                            </select>

                            <label for="client_address">Комментарий: </label>
                            <textarea id="comment" rows="5" placeholder="Введите комментарий" class="form-input_text" style="width: 100%;"><?=(!empty($order) && !empty($details['comment'])) ? $details['comment'] : ''?></textarea>

                            <div class="form-group clearfix">
                                <div class="icheck-info">
                                    <?php if(!empty($order)) {
                                        $paymentType = $details['paymentType'] ?? '';
                                    } ?>
                                    <?php if(!empty($order) && $paymentType == 'paymentCash') {
                                        $checked = 'checked';
                                    } else $checked = ''; ?>
                                    <input type="radio" id="paymentCash" value="paymentCash" name="paymentType" <?=$checked?>>
                                    <label for="paymentCash">
                                        Расчет наличными
                                    </label>
                                </div>
                                <div class="icheck-info">
                                    <?php if(!empty($order) && $paymentType== 'paymentBank') {
                                        $checked = 'checked';
                                    } else $checked = ''; ?>
                                    <input type="radio" id="paymentBank" value="paymentBank" name="paymentType" <?=$checked?>>
                                    <label for="paymentBank">
                                        Расчет по безналу
                                    </label>
                                </div>
                                <div class="icheck-info">
                                    <?php if(!empty($order) && $paymentType == 'paymentCard') {
                                        $checked = 'checked';
                                    } else $checked = ''; ?>
                                    <input type="radio" id="paymentCard" value="paymentCard" name="paymentType" <?=$checked?>>
                                    <label for="paymentCard">
                                        Расчет по карте
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-outline card-info">

                    <div class="card-body p-0">
                        <table class="table table-sm table-hover text-nowrap" id="materials-table">
                            <tr class="tr-no-items">
                                <td>Нет материалов</td>
                            </tr>
                            <tr class="tr-template" style="display: none;">
                                <td class="tr-title"></td>
                                <td class="tr-amount"></td>
                                <td class="tr-price"></td>
                                <td class="tr-total"></td>
                            </tr>
                            <tr class="total-template" style="display: none;">
                                <td >Итого:</td>
                                <td class="total-amount"></td>
                                <td></td>
                                <td class="total-sum"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="margin-top: 15px;">
                    <button id="addItem" type="button" class="btn bg-gradient-info btn-lg"><i class="fa fa-plus"></i> Добавить позицию</button>
                    <div id="buttons" style="text-align: right;float: right;" >
                        <button id="savePosition" type="button" class="btn bg-gradient-success btn-lg"><i class="fa fa-check"></i> Сохранить</button>
                        <button id="cancelPosition" type="button" class="btn bg-gradient-warning btn-lg"><i class="fa fa-times-circle"></i> Отменить</button>
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
                                    <?php
                                    foreach ($materials as $material) {
                                        echo "<option  data-type=\"0\" value=\"{$material['id']}\">{$material['title']}</option>";
                                    }
                                    ?>
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
                            <input type="hidden" id="current_item_id" value="">
                            <input type="hidden" id="edit" value="0">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .select2-selection__choice {
        background-color: #17a2b8;
        color: #fff !important;
    }
    .select2-container {
        display: inline-block;
    }

    .nice-select.open .list {
        max-height: 250px !important;
        width: 100%;
        overflow-x: hidden;
        overflow-y: scroll;
        border: solid 1px rgba(0, 0, 255, .5);
    }
    .total-tr {
        font-weight: bold;
        background-color: #dbebff;
    }
    .shouse, #operation-date, #order-address {
        width: 100%;
    }
    .card-details {
        /*background: #99ccff linear-gradient(180deg, #99ccff, #fff) repeat-x !important;*/
    }
    .w100p {
        width: 100%;
    }
    .select2-container--open {
        z-index: 1000001;
    }
    .selection > .select2-selection.select2-selection--single {
        height: 36px;
    }
    span.select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    span.select2 {
        margin-left: -3px;
        margin-bottom: 10px;
        border: 1px solid #0000ff;
        border-radius: 5px;
    }
</style>
<!-- Select2 -->
<!--<link rel="stylesheet" href="plugins/select2/css/select2.min.css">-->
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
    let state = {
        deliveryType: 'ourDelivery',
        client: {
            id: 0,
            phone: '',
            name: '',
        },
        address: '',
        paymentType: 'paymentCash'
    };
    let selectFocused = false;
    let dialogOpened = false;
    let validatingError = false;
    let isSaveButton = false;
    let materials = {};
    let editedID = 0;
    <?php
    if(!empty($order)) {
        echo "let isEdit = true;" . PHP_EOL;
        echo "let orderID = {$order['id']};" . PHP_EOL;
        echo "state.client.id = {$order['user_id']};" . PHP_EOL;
        echo "state.client.name = '{$order['title']};'" . PHP_EOL;
        echo "state.client.phone = '{$order['phone']}';" . PHP_EOL;
        echo "state.address = '{$order['address']}';" . PHP_EOL;
    } else {
        echo "let isEdit = false;" . PHP_EOL;
        echo "let orderID = 0;" . PHP_EOL;
    }
    if(!empty($order) && !empty($order['materials'])) {
        foreach ($order['materials'] as $key => $material) {
            $materialID = 'm' . $material['id'];
            $obj = "{id: '{$material['id']}', title: '{$material['title']}', amount: {$material['amount']}, price: {$material['price']}, type: 0}";
            echo "materials['{$materialID}'] = {$obj};" . PHP_EOL;
        }
    }
    ?>
    let selectedMaterialType = null;

    window.onload = function () {
        if(isEdit) drawMaterialsTable();

        $('#tags').select2({theme: 'bootstrap4'});
        // $('.status').select2({theme: 'bootstrap4'});

        $('#material').select2();
        $('#material').on('select2:select', function (e) {
            let el = $(e.params.data.element)
            selectedMaterialType =  $(el).data('type');
            // selectFocused = true;
            // $('#amount').focus();
        });

        $('#operation-date').change(function () {
            $(this).removeClass('error');
            const options = {year: 'numeric', month: 'long', day: 'numeric' };
            //$(this.element).val(start._d.toLocaleDateString("ru-RU", options));
        });

        $(document).keypress(function (e) {
            if (e.keyCode != 13) return;

            if(e.target.id == "comment") {
                // e.preventDefault();
                return;
            }

            if (!dialogOpened) {
                resetForm();
                openDialog();
                return;
            }

            if ($(e.target).attr("id") == "amount" && $("#amount").val() != "") {
                $('#price').focus();
            }
            if ($(e.target).attr("id") == "price" && ($("#amount").val() != "" || $("#amount").val() != "0") && ($("#price").val() != "" || $("#price").val() != "0")) {
                $("#save_item").click();
            }
        });

        $("#addItem").click(function (e) {
            resetForm();
            openDialog();
        });

        function openDialog() {
            $('.fancydialog-title').text('Добавить позицию');

            if(isEdit) $('.fancydialog-title').text('Изменить позицию');

            $.fancybox.open($('#fox'), {
                beforeClose: function (instance, slide) {
                    if(isSaveButton && !saveItem()) return isSaveButton = false;

                    dialogOpened = false;
                    isSaveButton = false;
                    drawMaterialsTable();
                },
                animationEffect: "zoom-in-out",
            });
            dialogOpened = true;
        }

        function drawMaterialsTable() {
            if(count(materials) == 0) {
                $('.tr-no-items').show();
                // $('#buttons').hide();
            } else {
                $('.tr-no-items').hide();
                $('.item-tr').remove();
                $('.total-tr').remove();
                let totalAmount = 0;
                let totalSum = 0.0;

                for(material in materials) {
                    var tr_template = $('.tr-template').clone();
                    var total_template = $('.total-template').clone();

                    $(tr_template).removeClass('tr-template').addClass('item-tr');

                    $(tr_template).find('.tr-title').html(materials[material].title);
                    $(tr_template).find('.tr-amount').html(materials[material].amount + " кг/шт.");
                    $(tr_template).find('.tr-price').html(materials[material].price + " руб.");
                    $(tr_template).find('.tr-total').html(+(materials[material].amount * materials[material].price).toFixed(2) + " руб.");
                    $('#materials-table').append($(tr_template));
                    $(tr_template).data("material", materials[material].id);
                    $(tr_template).data("amount", materials[material].amount);
                    $(tr_template).data("price", materials[material].price);
                    $(tr_template).show();

                    totalAmount += materials[material].amount;
                    totalSum += materials[material].amount * materials[material].price;
                    //totalSum = parseFloat(totalSum + materials[material].amount * materials[material].price).toFixed(2);

                    $(tr_template).click(function () {
                        trClick(this);
                    });

                    // $('#buttons').show();
                }

                $(total_template).removeClass('total-template').addClass('total-tr');
                $(total_template).find('.total-amount').html(+totalAmount.toFixed(2) + " кг/шт.");
                $(total_template).find('.total-sum').html(+totalSum.toFixed(2) + " руб.");
                $('#materials-table').append($(total_template));
                $(total_template).show();

            }
        }

        $('#material').change(function (e) {
            selectFocused = true;
            $('#amount').focus();
        })

        $('.nice-select').focus(function (e) {
            e.preventDefault();
            if (selectFocused) {
                selectFocused = false;
                $('#amount').focus();
            }
            return false;
        })

        $('#amount').focus(function () {
            $(this).select();
        });
        $('#amount').blur(function (e) {
            e.preventDefault();
            if (selectFocused) {
                selectFocused = false;
                $('#amount').focus();
            }
        });
        $('#price').focus(function () {
            $(this).select();
        });

        $('.shouse').change(function () {
            $('.shouse').removeClass('error');
        })

        $('#savePosition').click(function () {
            // if($('#shouse').val() < 1) {
            //     $('.shouse').addClass('error');
            //     toastr.error("Выберите склад!", "Ошибка");
            //     return;
            // }
            // if($('#operation-date').val() < 1) {
            //     $('#operation-date').addClass('error');
            //     toastr.error("Укажите дату!", "Ошибка");
            //     return;
            // }

            if(!state.client.id) {
                toastr.error("Необходимо выбрать клиента!", "Ошибка");
                return;
            }
            savePosition();
        });

        $('#cancelPosition').click(function () {
            document.location ='<?=$cancel_link?>';
        });

        $("#save_item").click(function (e) {
            isSaveButton = true;
            $.fancybox.close();
        });

        $('input[name="paymentType"').click(function () {
            state.paymentType = $(this).val();
            console.log(state.paymentType);
        });

        function saveItem() {
            validatingError = false;
            validatingError = (!validateNum($('#amount')) || validatingError);
            validatingError = (!validateNum($('#price')) || validatingError);
            if ($('#material').val() == 0) {
                $('#material').addClass('error');
                validatingError = true;
            } else {
                $('#material').removeClass('error');
            }
            if (validatingError) return false;

            if(isEdit && editedID !== 0) delete materials['m' + editedID];

            let amount = parseFloat($('#amount').val());
            let price = parseFloat($('#price').val());
            materials['m' + $('#material').val()] = {
                id: $('#material').val(),
                title:  $("#material option:selected").text(),
                amount: +amount.toFixed(1),
                price: +price.toFixed(2),
                type: selectedMaterialType
            };

            dialogOpened = false;
            selectedMaterialType = null;
            return true;
        }

        $('#reset_form').click(function () {
            resetForm();
            $.fancybox.close();
        });

        function trClick(el) {
            let elem = $(el);
            resetForm();

            $('.fancydialog-title').text('Изменить адрес пункта сбора');
            editedID = elem.data('material');
            $('#material option[value="' + editedID + '"]').prop('selected', true);
            $('#material').niceSelect('update');
            $('#amount').val(elem.data('amount'));
            $('#price').val(elem.data('price'));
            isEdit = true;
            openDialog();
        };

        function checkEmpty(el) {
            validatingError = ($(el).val() == "" || $(el).val() <= 0);
            if (validatingError && !$(el).hasClass('error')) {
                $(el).addClass('error');
            }
            if (!validatingError) {
                $(el).removeClass('error');
            }
        }

        function validateNum(el) {
            // проверка на пустоту и отрицательные числа
            let error = ($(el).val() == "" || $(el).val() <= 0);
            if (error && !$(el).hasClass('error')) {
                $(el).addClass('error');
            }
            if (!error) {
                $(el).removeClass('error');
            }

            return !error;
        }

        function resetForm() {
            $('#material option:eq(0)').prop('selected', true);
            $('#material').niceSelect('update');
            $('#material').removeClass('error');
            $('#amount').val('0');
            $('#price').val('0');
        }

    };

    function savePosition() {
        let data = {
            isEdit: isEdit,
            editedID: orderID,
            orderTitle: $('#order_title').val(),
            shouseID: $('#shouse').val(),
            deliveryType: state.deliveryType,
            operationDate: $('#operation-date').val(),
            status: $('#status').val(),
            clientID: state.client.id,
            leadID: 0,
            phone: state.client.phone,
            address: $('#order-address').val(),
            name: state.client.name,
            materials: materials,
            carID: $('#car').val(),
            driverID: $('#driver').val(),
            managerID: $('#manager').val(),
            comment: $('#comment').val(),
            paymentType: state.paymentType
        };
console.log(data)
        // return;

        APP.post(data, "/admin/shouse/storematerials", function (res){
            if(res.status == "success") {
                toastr.success(res.message);
                document.location = res.redirect_to;
            } else {
                toastr.error(res.message, "Ошибка");
            }
            console.log(res);
        });
    }

</script>
