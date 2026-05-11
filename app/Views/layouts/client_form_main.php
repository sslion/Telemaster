<div class="input-group" style="margin-bottom: 10px;">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
    </div>
    <input type="text" class="form-control" id="client_phone" placeholder="Поиск по номеру телефона"  autocomplete="off">
</div>

<div class="input-group mb-10" style="margin-bottom: 10px;">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
    </div>
    <input type="text" class="form-control" id="client_name" placeholder="Поиск по имени"  autocomplete="off">
</div>

<div class="clients-list-wrapper" style="display: none;">
    <ul id="clients-list"></ul>
</div>

<!--<div class="phone_group" style="display: none;">-->
<!--    <input class="form-input_text" type="text" id="client_phone1" value=""-->
<!--           style="margin-bottom: unset;width: 100%;" placeholder="Номер телефона клиента" autocomplete="off">-->
<!--    <i class="fa fa-plus action-icon-button add-phone"></i>-->
<!--</div>-->

<div id="client_phones" style="display: none;">
    <div class="phone_group client_phone_template" style="display: none;">
        <input class="form-input_text" type="text" value=""
               style="margin-bottom: unset;width: 100%;" placeholder="Номер телефона клиента" autocomplete="off">
        <i class="fa fa-remove action-icon-button delete-phone"></i>
    </div>
</div>


<!--<input class="form-input_text" type="text" id="client_name" value=""-->
<!--       style="width: 100%;" placeholder="Наименование клиента" autocomplete="off">-->

<div style="width: 100%;display: none;" id="add_new_client_button">
    <button type="button" id="newClient" style="width: 100%;border: 0;margin-bottom: 10px;"><i class="fa fa-plus"></i>Добавить нового клиента</button>
</div>

<div style="width: 100%;display: none;" id="more_button_wrapper">
    <button  data-toggle="collapse" data-target="#client_form" type="button" id="moreButton" style="width: 100%;border: 0;margin-bottom: 10px;">Подробнее&nbsp;&nbsp;&nbsp;<i id="more_arrow" class="fa fa-chevron-down"></i></button>
</div>


<div style="display:none;" id="newClientDialog">
    <div>
        <div class="fancydialog-title">Быстрое добавление клиента</div>
        <form class="fancyinner" id="newclient_form">
            <div class="form_row">
                <label class="form-label">Фамилия</label>
                <input class="form-input_text" type="text" id="new_client_firstname" value="">
            </div>
            <div class="form_row">
                <label class="form-label">Имя</label>
                <input class="form-input_text" type="text" id="new_client_lastname" value="">
            </div>
            <div class="form_row">
                <label class="form-label">Отчество</label>
                <input class="form-input_text" type="text" id="new_client_secondname" value="">
            </div>
            <div class="form_row">
                <label class="form-label">Номер телефона</label>
                <input class="form-input_text" type="text" id="new_client_phone" value="">
            </div>
            <div class="form_row">
                <button type="reset" class="btn btn-warning float-right" style="margin-bottom: 15px;"
                        id="reset_form">
                    Отмена
                </button>
                <button type="button" class="btn btn-info float-right" style="margin-right: 15px;"
                        id="save_contact">
                    Сохранить
                </button>
            </div>
            <input type="hidden" id="current_item_id" value="">
            <input type="hidden" id="edit" value="0">
        </form>
    </div>
</div>

<div id="client_form" class="collapse in"></div>
<script src="plugins/inputmask/jquery.inputmask.js"></script>
<style>
    #saveClientWrapper {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }
    .form-control, .form-control:focus {
        border: 1px solid #0000ff;
    }
    .input-group {
        /*margin-bottom: 10px;*/
    }
    .input-group-text {
        border: 1px solid #0000ff;
    }
    .phone_group, .address_group {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .action-icon-button {
        display: inline-block;
        height: 28px;
        width: 28px;
        line-height: 28px;
        border: 0;
        border-radius: 14px;
        font-size: 16px;
        text-align: center;
        cursor: pointer;
        margin-left: 5px;
    }
    .action-icon-button:hover {
        background-color: rgb(241, 241, 241);
    }
    .add-phone {
        color: #0000ff;
    }
    .delete-phone {
        color: red;
    }
    .clients-list-wrapper {
        max-height: 200px;
        width: 100%;
        overflow-y: scroll;
        position: absolute;
        z-index: 99999;
        background-color: #fff;
        border: 1px solid #aaa;
    }
    #clients-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .clients-list-item {
        cursor: pointer;
    }
    .clients-list-item:hover {
        background-color: #ececec;
    }

    .clients-list-phone {
        width: 147px;
        display: inline-block;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        background-image: url('data:image/svg+xml;utf8, <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 24 24"><path fill="%230000ff" d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/></svg>');
    }
</style>
<script>
    let grades = {};
    let clients = {};
    let clientID = 0;
    let clientPhone = 0;
    let clientName = "";
    let clientsListOpened = false;

    $("#client_phone").inputmask("+7 (999) 999-99-99");
    $("#new_client_phone").inputmask("+7 (999) 999-99-99");

    $("#newClient").click(function () {
        newClientDialog();
    });

    $("#client_phone").keydown(function (e) {
        if(e.keyCode === 8) return e.keyCode;
        if(e.keyCode > 47 && e.keyCode < 58) return e.keyCode;
        if(e.keyCode > 95 && e.keyCode < 106) return e.keyCode;
        return false;
    });

    $("#client_phone").keyup(function (e) {
        let str = $("#client_phone").val();

        $("#client_name").val("");
        if (str.length < 3) {
            $(".clients-list-wrapper").hide();
            hideLoyaltyBlock();
            return;
        }
        $(".clients-list-wrapper").css("top", "unset");
        APP.post({clientPhone: str}, "<?=route_to("admin_search_client_by_phone")?>", function (result) {
            $(".clients-list-item").remove();
            if(result.clients.length) {
                addClients(result);
            } else {
                $(".clients-list-wrapper").hide();
                $("#add_new_client_button").show();
                hideLoyaltyBlock();
            }
        })

    });
    $("#client_name").keyup(function (e) {
        if(e.keyCode > 36 && e.keyCode < 41) return e.keyCode;
        let str = $("#client_name").val();

        $("#client_phone").val("");

        if (str.length < 3) {
            $(".clients-list-wrapper").hide();
            hideLoyaltyBlock();
            return;
        }
        $(".clients-list-wrapper").css("top", "194px");
        APP.post({clientName: str}, "<?=route_to("admin_search_client_by_name")?>", function (result) {
            $(".clients-list-item").remove();
            // console.log(result.clients + "<<<")
            if(result.clients.length) {
                addClients(result);
            } else {
                $(".clients-list-wrapper").hide();
                hideLoyaltyBlock();
                $("#add_new_client_button").show();
            }
        })
    });

    $(".add-phone").click(function () {
        showAddPhone();
    });

    $("#more_button_wrapper").click(function(){
        if($("#more_arrow").hasClass("rotate")) {
            $("#more_arrow").removeClass("rotate");
        } else {
            $("#more_arrow").addClass("rotate");
        }
        $("#client_form").collapse('toggle'); // toggle collapse
    });

    $("#save_contact").click(function () {
        let contactData = {
            firstName: $("#new_client_firstname").val(),
            lastName: $("#new_client_lastname").val(),
            secondName: $("#new_client_secondname").val(),
            phone: $("#new_client_phone").val(),
            fastCreate: true
        };
        saveContact(contactData);
    });

    $(document).click(function (e) {
        if(clientsListOpened) {
            hideClientsList();
        }
    });

    window.addEventListener('load', function() {
        console.log(state)
        if(isEdit) {
            clientID = state.client.id
            clients['c' + clientID] = {
                id: state.client.id,
                name: state.client.name,
                firstName: state.client.name,
                lastName: state.client.name,
                phone: state.client.phone
            };
            applyClient(('c' + state.client.id));
        }
        console.log(clients)
    })

    function saveContact(contactData) {
        APP.post({contactData: contactData}, "<?=route_to("admin_save_client")?>", function (result) {
            // console.log(result);
            if(result.status == "error") {
                toastr.error(result.message, "Ошибка");
            } else {
                $.fancybox.close($('#newClientDialog'), {
                    animationEffect: "zoom-in-out",
                });
                clients = {};
                clients["c" + result.newClient.id] = result.newClient;
                applyClient("c" + result.newClient.id);
            }
        })
    }

    function applyClient(key) {
        let userData = clients[key];
        // если что, удалить
        clientID = userData.id;
        getClientForm(clientID);
        // если что, удалить

        if(clientID !== userData.id) {
            clientID = userData.id;
            getClientForm(clientID);
        }
        clientID = userData.id; state.client.id = clientID;
        clientName = userData.name; state.client.name = clientName;
        clientPhone = userData.phone; state.client.phone = clientPhone;

        $("#client_phone").val(userData.phone);
        getClientPhones();
        // debugger
        console.log(userData)
        $("#client_name").val(userData.firstName + " " + userData.lastName);
        hideClientsList();
        $("#add_new_client_button").hide();
        $("#more_button_wrapper").show();

        if(userData.in_loyalty == "1") {
            for (let resultKey in grades) {
                if(grades[resultKey].rate == userData.loyalty_rate) {
                    $(".loyalty-status").html(grades[resultKey].name);
                }
            }
            $(".in-loyalty-start").html(userData.loyalty_startdate);
            $(".loyalty-bonuses").html(userData.total_bonuses);
            $(".loyalty-rate").html((userData.loyalty_rate * 100).toFixed(2) + "%");

            $(".in-loyalty").show();
            $(".no-loyalty").hide();
        } else {
            $(".no-loyalty").show();
            $(".in-loyalty").hide();
        }
        $(".loyalty-block").show();
    }

    function hideLoyaltyBlock() {
        $(".loyalty-block").hide();
    }

    function getClientForm(clientID) {
        APP.post({clientID: clientID}, "<?=route_to("get_client_form")?>", function (result) {
            $("#client_form").html(result.text);

            clients['c' + clientID].firstName = $(result.text).find('#client_firstname').data('value');
            clients['c' + clientID].lastName = $(result.text).find('#client_lastname').data('value');
            console.log(clients['c' + clientID].firstName)

        })
    }

    function addClients(result) {
        // console.log(result)

        if(result.clients.length) {
            clients = result.clients;
        } else clients = {};
        grades = result.grades;
        result = result.clients
        for (let resultKey in result) {
            clients['c' + result[resultKey].id] = result[resultKey];
            let name = result[resultKey].firstname + " " + result[resultKey].lastname;
            let clientLi = "<li class='clients-list-item'";
            clientLi += " data-id='" + result[resultKey].id + "'";
            clientLi += " data-name='" + name + "'";
            clientLi += " data-phone='" + result[resultKey].phone + "'>";
            clientLi += "<span class='clients-list-phone'>" + result[resultKey].phone + "</span>";
            clientLi += "<span class='clients-list-name'>" + result[resultKey].firstname + " " + result[resultKey].lastname + "</span>";
            clientLi += "</li>";
            $("#clients-list").append(clientLi);
        }
        showClientsList();
        $(".clients-list-item").click(function (e) {
            let elLI = $(e.target).closest(".clients-list-item");
            applyClient('c' + elLI.data("id"));
        });
    }

    function getClientPhones() {
        $("#client_phones").hide();
        APP.post({clientID: clientID}, "<?=route_to("get_client_phones")?>", function (result) {
            if(result.length >1) {
                delete result[0];
                $("#client_phones").find(".client_phone").remove();
                let template = $("#client_phones").find(".client_phone_template");
                for(let key in result) {
                    let newPhone = $(template).clone();
                    newPhone.removeClass("client_phone_template").addClass("client_phone");
                    newPhone.find(".form-input_text").val(result[key].phone).inputmask("+9 (999) 999-99-99");
                    newPhone.data("id", result[key].id);
                    newPhone.css("display", "flex");
                    newPhone.find(".delete-phone").click(function (e) {
                        deletePhone($(e.target));
                    });
                    $("#client_phones").append(newPhone);
                }
                $("#client_phones").show();
            }
        });
    }

    function showAddPhone() {
        // $("#client_phones").find(".client_phone").remove();
        let template = $("#client_phones").find(".client_phone_template");

        let newPhone = $(template).clone();
        newPhone.removeClass("client_phone_template").addClass("client_phone");
        newPhone.find(".form-input_text").inputmask("+9 (999) 999-99-99");
        newPhone.data("id", -1);
        newPhone.css("display", "flex");
        newPhone.find(".delete-phone").click(function (e) {
            deletePhone($(e.target));
        });
        $("#client_phones").append(newPhone);
        $("#client_phones").show();
    }

    function deletePhone(el) {
        let id = $(el).closest(".client_phone").data("id");
        if(id == "-1") {
            // просто удаляем строчку
            $(el).closest(".client_phone").remove();
        } else {
            //TODO реализовать удаление номера телефона
        }
        console.log(id);
    }

    function newClientDialog() {
        $('.fancydialog-title').text('Быстрое создание клиента');
        $("#new_client_firstname").val($("#client_name").val());
        $("#new_client_lastname").val("");
        $("#new_client_secondname").val("");
        $("#new_client_phone").val($("#client_phone").val());

        $.fancybox.open($('#newClientDialog'), {
            beforeClose: function (instance, slide) {

            },
            animationEffect: "zoom-in-out",
        });
    }

    function showClientsList() {
        $(".clients-list-wrapper").show();
        clientsListOpened = true;
    }

    function hideClientsList() {
        $(".clients-list-wrapper").hide();
        clientsListOpened = false;
    }
</script>