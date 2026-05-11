const event_audio_src = "../sound_08029.mp3";
const eventAudio = new Audio();
eventAudio.preload = 'auto';
eventAudio.src = event_audio_src;

const forms = {
    order: "/formorder1",
    default: "/formorder",
};
const apiComands = {
    saveLeftmenuState: "/admin/saveleftmenustate",
}

const  createApplication = (param) => {
    this.APP = {
        setBadge(key, val) {
            val = (val < 1) ? "" : val;
            let template = '<span class="badge badge-success right">' + val + '</span>';
            $('#' + key).find('.badge').remove();
            $('#' + key).append(template);
        },

        formOrder(data = null, callback = null) {
            if(data == null) return data;
            var res = postData(data, forms.order);

            res.then(function(resdata) {
                if(callback == null) return resdata;
                return callback(resdata);
            })
        },

        post(data = null, url = "",  callback = null, onerror = null, opts = {}) {
            if(data == null) return data;
            var res = postData(data, (url == "") ? forms.default : url, opts);

            res.then(function(resdata) {
                if(callback == null) return resdata;
                return callback(resdata);
            }, function(resdata) {
                if(onerror == null) return resdata;
                return onerror(resdata);
            })
        },
        get(url = "",  callback = null, onerror = null) {
            var res = getData((url == "") ? forms.default : url);

            res.then(function(resdata) {
                if(callback == null) return resdata;
                return callback(resdata);
            }, function(resdata) {
                if(onerror == null) return resdata;
                return onerror(resdata);
            })
        },

        eventSoundPlay() {
            eventAudio.pause();
            eventAudio.currentTime = 0.0;
            eventAudio.play();
        },

        include(url) {
            var script = document.createElement('script');
            script.src = url;
            document.getElementsByTagName('head')[0].appendChild(script);
        },

        saveLeftmenuState(state) {
            postData({state: state},apiComands.saveLeftmenuState);
        },

        /**
         * Печать документа по url
         *
         * @param {string} url Адресс страницы для печати
         **/
        // печать документа по url
        print(url = '', target = '') {
            let mywindow = window.open(url, target);
            mywindow.onafterprint = window.close;
            mywindow.print();
        },

        // активируем редактируемые элементы

        /**
         * - активируем редактируемые элементы
         * - у элемента должен быть класс editable
         * - также атрибут contenteditable="true"
         * - при необходимости  дата-атрибут с колбэком data-callback="callbackName"
         **/
        activateEditable(callback = null) {
            $('body').on('focus', '[contenteditable]', function () {
                const $this = $(this);
                $this.data('before', $this.html());
            }).on('blur keydown keyup paste input', '[contenteditable]', function (e) {
                if(callback !== null) {
                    callback(e);
                }

                const $this = $(this);
                if (e.keyCode == 13) {
                    e.keyCode = 0;
                    $this.trigger('blur');
                    this.blur();
                }
                if ($this.data('before') !== $this.html()) {
                    $this.data('before', $this.html());
                    $this.trigger('change');
                }
                if(e.type === 'focusout') {
                    const callback = this.dataset.callback;
                    if(callback !== undefined) {
                        window[callback](this);
                    }
                }
            });
        }
    };

    function postData(data, controller = null, opts = {}) {
        if (controller == null) controller = forms.default;
        let options = {
            url: controller,
            type: 'POST',
            dataType: 'json',
            data: data
        }
        options = Object.assign(options, opts);
        return new Promise(function (resolve, reject) {
            $.ajax(options)
                .fail(function (a,b,c) {
                    console.log(a,b,c)
                    return reject(a);
                })
                .done(function (data) {
                    return resolve(data);
                });
        });
    }
    function getData(controller = null) {
        if (controller == null) controller = forms.default;
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: controller,
                type: 'GET',
                dataType: 'json',
            })
                .fail(function (data) {
                    return reject(data);
                })
                .done(function (data) {
                    return resolve(data);
                });
        });
    }
    return this;
};

createApplication();
//APP.include("./js/plugin.js");

this.count = function(arr){
    let result = 0;
    for(i in arr)
        result++;
    return result;
}