<?php
if(!empty($client["avatar"])) {
    $avatar = "/avatars/" . $client["avatar"];
} else {
    $avatar = "/avatars/noavatar.png";
}
$findSources = (new \App\Models\FindSources())->findAll();
$managers = (new \App\Models\UserModel())->getUsers();
?>
<form id="clientForm">
<div class="avatar_wrapper"><img src="<?=$avatar?>" id="client_avatar"></div>

    <input class="form-input_text checkChange" data-event="keyup" data-value="<?=($client["firstname"] ?? "")?>" type="text" id="client_firstname" value="<?=($client["firstname"] ?? "")?>"
           style="width: 100%;" placeholder="Имя">

    <input class="form-input_text checkChange" data-event="keyup" data-value="<?=($client["firstname"] ?? "")?>" type="text" id="client_firstname" value="<?=($client["firstname"] ?? "")?>"
       style="width: 100%;" placeholder="Имя">

<input class="form-input_text checkChange" data-event="keyup" data-value="<?=($client["lastname"] ?? "")?>"  type="text" id="client_lastname" value="<?=($client["lastname"] ?? "")?>"
       style="width: 100%;" placeholder="Отчество">

    <div class="client_addresses">
        <div class="address_group">
            <input class="form-input_text checkChange" data-event="keyup"
                   data-value="<?= ($client["address"] ?? "") ?>"
                   type="text" id="client_address" value="<?= ($client["address"] ?? "") ?>"
                   style="width: 100%;margin: 0;" placeholder="Адрес">
            <i class="fa fa-plus action-icon-button add-address" style="margin-left: -28px;color:#0000ff;"></i>
        </div>

        <?php
        if(!empty($client["addresses"]) && count($client["addresses"]) > 1) {
            $a = array_shift($client["addresses"]);
            foreach ($client["addresses"] as $item) {
            ?>
            <div class="address_group">
                <input class="form-input_text checkChange"
                       id="address<?=$item["id"]?>"
                       data-event="address" data-id="<?= ($item["id"] ?? "") ?>"
                       data-value="<?= ($item["address"] ?? "") ?>"
                       type="text" value="<?= ($item["address"] ?? "") ?>"
                       style="width: 100%;margin: 0;" placeholder="Дополнительный адрес">
                <i class="fa fa-plus action-icon-button add-address" style="margin-left: -28px;color:#0000ff;"></i>
            </div>
        <? }
        }?>
        <div class="phone_group_template" style="display: none;">
            <input class="form-input_text checkChange" data-event="address" data-value=""
                   data-id="0"
                   type="text" value=""
                   style="width: 100%;margin: 0;" placeholder="Дополнительный адрес">
            <i class="fa fa-plus action-icon-button add-address" style="margin-left: -28px;color:#0000ff;"></i>
        </div>
    </div>
<!--<input class="form-input_text checkChange" data-event="keyup" data-value="--><?//=($client["address"] ?? "")?><!--"   type="text" id="client_address" value="--><?//=($client["address"] ?? "")?><!--"-->
<!--       style="width: 100%;" placeholder="Адрес">-->

<select class="nice-select small client-manager checkChange" id="client_manager"  data-event="select" data-value="<?=($client["manager"] ?? "")?>">
    <option value="">Выберите менеджера</option>
    <?php
    foreach ($managers as $item) {
        $selected = ($item["id"] == $client["manager"]) ? "selected" : "";
        echo "<option {$selected} value=\"{$item['id']}\">{$item['firstname']} {$item['lastname']} {$item['secondname']}</option>";
    } ?>
</select>

<input class="form-input_text checkChange" data-event="keyup" data-value="<?=($client["email"] ?? "")?>"   type="email" id="client_email" value="<?=($client["email"] ?? "")?>"
       style="width: 100%;" placeholder="Email">

<input class="form-input_text checkChange"  data-event="date" data-value="<?=($client["birthday"] ?? "")?>"  type="date" id="client_birthday" value="<?=($client["birthday"] ?? "")?>"
       style="width: 100%;" placeholder="День рождения">

<textarea class="form-input_text checkChange" id="client_description"  data-event="keyup" data-value="<?=($client["description"] ?? "")?>"
          style="width: 100%;" placeholder="Комментарий"><?=($client["description"] ?? "")?></textarea>

    <?php $client["find_source"] = (!empty($client["find_source"])) ? str_replace(" ", "", $client["find_source"]) : null; ?>
<select multiple class="form-control checkChange" style="padding:5px;border: 1px solid #0000ff;margin-bottom: 10px;" id="find_source" data-event="multiselect" data-value='<?=($client["find_source"] ?? "")?>'>
    <option ></option>
    <?php
    foreach ($findSources as $item) {
        $selected = "";
        if( !empty($client["find_source"])) {
            $findSource = json_decode($client["find_source"]);
            if(in_array($item["id"], $findSource)) {
                $selected = "selected";
            }
        }
        echo "<option value={$item['id']} {$selected}>{$item['title']}</option>";
    } ?>
</select>

<input class="form-input_text checkChange" data-event="keyup" data-value="<?=($client["cardnumber"] ?? "")?>" type="text" id="client_cardnumber" value="<?=($client["cardnumber"] ?? "")?>"
       style="width: 100%;" placeholder="Номер карты">

<input class="form-input_text checkChange"  data-event="keyup"  data-value="<?=($client["rank"] ?? "")?>"  type="text" id="client_rank" value="<?=($client["rank"] ?? "")?>"
       style="width: 100%;" placeholder="Должность">

<div id="saveClientWrapper" style="display: none;"><button class="btn btn-info btn-sm" id="saveChangedClient" type="button">Сохранить</button><button class="btn btn-default btn-sm" style="margin-left: 10px;">Отмена</button></div>

</form>
<style>
    #clientForm {
        background-color: rgba(200,200,200,.3);
        padding: 0 5px;
    }
    .avatar_wrapper {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
    #client_avatar {
        width:64px;
        height: 64px;
        border-radius: 50%;
        margin: 15px auto;
    }
    .client-manager {
        width: 100%;
    }
</style>
<script>
    tippy('#client_manager', {
        content: "Ответственный менеджер",
        allowHTML: true,
        placement: 'right-start',
    });
    tippy('#client_birthday', {
        content: "Дата рождения",
        allowHTML: true,
        placement: 'right-start',
    });
    tippy('#find_source', {
        content: "Используйте клавиши SHIFT или CTRL для мульти выбора",
        allowHTML: true,
        placement: 'right-start',
    });
    tippy('.add-address', {
        content: "Добавить дополнительный адрес",
        allowHTML: true,
        placement: 'right-start',
    });
    changedFileds = [];
    changedAddresses = [];

    window.onbeforeunload = function(e) {
        if(changedFileds.length !== 0) {
            message =  "Данные клиента были изменены! Выйти всё равно?";
            e.returnValue = message;
            return message;
        }
    }

    $(".add-address").click(function (e) {
        showAddAddress();
    });

    function showAddAddress() {
        let addressTemplate = $(".phone_group_template").clone();
        addressTemplate.removeClass("phone_group_template");
        addressTemplate.addClass("phone_group");
        addressTemplate.find(".form-input_text").attr("id", "addr" + Math.floor(Math.random() * 9999999999));
        $(".client_addresses").append(addressTemplate);
        addressTemplate.show();
        addressTemplate.find(".add-address").click(function () {
            showAddAddress();
        });
        addListeners();
    }

    addListeners();
    function addListeners() {
        $('#clientForm').find('.checkChange').each(function (el) {
            // console.log($(this).attr("id") + " > " + $(this).data("event"))
            if($(this).data("event") == "keyup") {
                $(this).keyup(function (e) {
                    checkChanges($(this).data("value"), $(this).val(), $(this).attr('id'));
                });
            }

            if($(this).data("event") == "select") {
                $(this).on('change', function (e) {
                    checkChanges($(this).data("value"), this.value, $(this).attr('id'));
                });
            }

            if($(this).data("event") == "multiselect") {
                $(this).on('change', function (e) {
                    let val1 = JSON.stringify($(this).val());
                    let val2 = JSON.stringify($(this).data("value"));
                    checkChanges(val1, val2, $(this).attr('id'));
                });
            }

            if($(this).data("event") == "date") {
                $(this).keyup(function (e) {
                    checkChanges($(this).data("value"), this.value, $(this).attr('id'));
                });
                $(this).on('change', function (e) {
                    checkChanges($(this).data("value"), this.value, $(this).attr('id'));
                });
            }

            if($(this).data("event") == "address") {
                $(this).keyup(function (e) {
                    checkChangedAddress($(this).data("value"), this.value, $(this).attr('id'));
                });
            }
        });
    }

    function checkChanges(before, after, id) {
        if(before != after) {
            if (changedFileds.indexOf(id) === -1) {
                changedFileds.push(id);
            }
        } else {
            let ind = changedFileds.indexOf(id);
            if (ind !== -1) {
                changedFileds.splice(ind, 1);
            }
        }
        checkChangedFields();
    }

    function checkChangedAddress(before, after, id) {
        if(before != after) {
            if (changedAddresses.indexOf(id) === -1) {
                changedAddresses.push(id);
            }
        } else {
            let ind = changedAddresses.indexOf(id);
            if (ind !== -1) {
                changedAddresses.splice(ind, 1);
            }
        }
        checkChangedFields();
    }

    function checkChangedFields() {
        if(changedFileds.length !== 0 || changedAddresses.length !== 0) {
            $("#saveClientWrapper").show();
        } else $("#saveClientWrapper").hide();
    }

    $("#saveChangedClient").click(function () {
        if(changedFileds.length === 0 && changedAddresses.length === 0) {
            $("#saveClientWrapper").hide();
            return;
        }

        let clientData = {};
        clientData.addresses = [];
        clientData.id = clientID;
        changedFileds.forEach(function (el) {
            clientData[el] = $("#" + el).val();
        })
        changedAddresses.forEach(function (el) {
            addr = {
                id: $("#" + el).data("id"),
                address: $("#" + el).val()
            }

            clientData.addresses.push(addr);
        })
        APP.post(clientData, "<?=route_to("save_changed_client")?>", function (result) {
            if(result.status == "success") {
                $("#saveClientWrapper").hide();
                changedFileds = [];
                APP.post({clientID: clientID}, "<?=route_to("get_client_form")?>", function (result) {
                    $("#client_form").html(result.text);
                })
                toastr.success("Изменения сохранены", "Успешно");
            } else {
                toastr.error(result.message, "Ошибка");
            }
        })
    });

</script>