$(document).ready(function () {
    if (window.location.pathname != '/') {

        var autoplayTime = 3500;
        $('.owl-carousel-map').owlCarousel({
            singleItem: true,
//            autoPlay: autoplayTime, // задано переменной
            mouseDrag: true,
            touchDrag: true,
            navigation : true,
            navigationText : ["",""],
            pagination : true,
        });

        var map_width = $('.catalog-detail').width();
        $('#map').width(map_width);
        // var customOptions = {
        //     onKeyPress: function(val, e, field, options) {
        //
        //         if (val.replace(/\D/g, '').length===2)
        //         {
        //             val = val.replace('8','');
        //             field.val(val);
        //         }
        //         field.mask("+7 (999) 999-99-99", options);
        //     },
        //     placeholder: "+7 (___) ___-__-__"
        // };


        // $.mask.definitions['~']='[+78]';
        $("#phonenumber_sms").mask("+7 (999) 999-99-99");
        $("#phonenumber_sms").on('keyup', function () {
            if($(this).val()[4] == '8'){
                $("#phonenumber_sms").mask("+7 (999) 999-99-99");
            }
        });
        $("#phonenumber_sms").change(function () {
            var phonenumber = $(this).val().replace(/\+7 \(([0-9]{3})\) ([0-9]{3})\-([0-9]{2})\-([0-9]{2})/ig, "$1$2$3$4");
            $("#phonenumber_format_sms").val(phonenumber);
        });


        // берем данные из массива
        var $shopsData = JSON.parse(shopsData);

        // Дождёмся загрузки API и готовности DOM.
        ymaps.ready(init);

        function init() {
            // Создание экземпляра карты и его привязка к контейнеру с
            // заданным id ("map").
            var map_point = $shopsData['map_marker'];

            myMap = new ymaps.Map('map', {
                // При инициализации карты обязательно нужно указать
                // её центр и коэффициент масштабирования.
                center: [map_point['yandex_lat'], map_point['yandex_lon']], // Москва
                zoom: map_point['yandex_scale'],
                controls: ['zoomControl', 'typeSelector', 'fullscreenControl', 'routeButtonControl']
            });
            myMap.behaviors.disable("scrollZoom");
            if ($shopsData['shops']) {
                // выгружаем метки
                $.each($shopsData['shops'], function (index, shop) {
                    var myPlacemark = new ymaps.Placemark([shop['LAT'], shop['LON']], {
                        // Свойства.
                        // Содержимое иконки, балуна и хинта.
                        iconContent: '',
                        balloonContent: '',
                        hintContent: shop['NAME'],
                        ID: index,
                    }, {
                        // Опции.
                        // Стандартная фиолетовая иконка.
                        preset: 'islands#Icon',
                        iconColor: '#9cc218'

                    });

                    myMap.geoObjects
                        .add(myPlacemark);

                    myPlacemark.events.add('click', function (e) {
                        var idShopHover = myPlacemark.properties.get("ID");
                        shop_active(idShopHover, $shopsData);
                    });

                });
                // переход к метке магазина на карте из карточки шоу-рума
                $('.seeOnMap').on('click', function () {
                    var idShopHover = $(this).data('shopid');
                    shop_active(idShopHover, $shopsData);
                    $('html,body').stop().animate({scrollTop: $('#where_to_buy').offset().top}, 1000);
                });

                // активируем первый элемент
                if (screen.width > 900) {
                    shop_active(0, $shopsData);
                }
            }
        }

        // закрытие карточки информации о магазине размещенной на карте
        $('.close_btn').click(function () {
            $('.shop_contain').hide(700);
        });

        // открытие модального окна с внесением данных контакта
        $('.shopAdressModal, .getAdressSms').on('click', function () {
            var itemID = $('#smsSendModal').find('.shopid').val();
            shop_active(itemID, $shopsData);
            $('#smsSendModal').find('.preview_block, .modal-footer').show();
            $('#smsSendModal').find('.end_block').html('');
            $('#smsSendModal').modal('show');
        });
        $('#smsSendModal').on('click', '.getShopAdress', function () {
            $('#smsSendModal').find('#field_username').removeClass('error_attention');
            $('#smsSendModal').find('#phonenumber_sms').removeClass('error_attention');
            var itemID = $('#smsSendModal').find('.shopid').val();
            var phonenumber = $("#phonenumber_format_sms").val();
            var name = $('#field_username').val();
            var verify_flag = true;

            // верификация имени
            if (name.trim() == "" || name.trim().length <= 2) {
                verify_flag = false;
                $('#smsSendModal').find('#field_username').addClass('error_attention');
            }

            if ($("#phonenumber_format_sms").val().length != 10){
                verify_flag = false;
                console.log('$("#phonenumber_format_sms").val()', $("#phonenumber_format_sms").val().length);
                $('#smsSendModal').find('#phonenumber_sms').addClass('error_attention');
            }


            // снимаеем выдыление красным
            $('.form-control').on('keyup', function () {
                $(this).removeClass('error_attention');
            });


            // верификация номера
            if (verify_flag == true) {
                $('#smsSendModal').find('.preview_block, .modal-footer').hide();
                $('#smsSendModal').find('.end_block').html('<img class="ajax_loader" src="/images/ajax-loader.gif" alt="">');


                var $data = {
                    name: name,
                    phone: phonenumber,
                    city: $shopsData['CITY'],
                    shop_name: $shopsData['shops'][itemID]['NAME'],
                    adress: $shopsData['shops'][itemID]['adress']
                };

                // для карточки товара даннаые о товаре
                if($shopsData['product']){
                    var $product = $shopsData['product'];
                    $data['product'] = $product['PRODUCT_NAME'];
                    $data['productID'] = $product['PRODUCT_ID'];
                    $data['price'] = $product['PRICE'];
                }

                // console.log('$data', $data);

                // отправка смски
                $.post('/api/get_sms_adress/',
                    $data,
                    function (data) {
                        var message = 'Ваша заявка принята.';
                        var button_error = '';
                        if (data.error != false) {
                            message = data.error;
                            button_error = '<div class="error_send">Заказать звонок</div>'
                        }
                        $('#smsSendModal').find('.preview_block').hide();
                        $('#smsSendModal').find('.end_block').html(
                            '<span>' + message + '</span>' + button_error
                        );
                    },
                    "json"
                );
            }
        });


        // в случае ошибки - звонок от оператора
        $('.modal-body').on('click', '.error_send', function () {
            $('.grcb_widget').click();
            // $('.grcb-phone').focus().setCursorPosition(1);
        })
    }
});

// манипуляции с метками
function shop_active(id, $shopsData) {
    if (myMap.geoObjects.get(id)) {
        myMap.geoObjects.each(function (e) {
            e.options.set('preset', 'islands#Icon');
            e.options.set('iconColor', '#9cc218');
        });
        $('.shop_contain').children().not('.close_btn').not('.shopAdressModal').not('.shopAdressModalContainer').remove();
        myMap.geoObjects.get(id).options.set('preset', 'islands#dotIcon');
        myMap.geoObjects.get(id).options.set('iconColor', 'darkgreen');
        // console.log('geoObjects', myMap.geoObjects);
        shop_contain(id, $shopsData);
    }
}

// заполнение информации по магазину в окошке
function shop_contain(shopID, $shopsData) {
    var shop_info = $shopsData['shops'][shopID];
    var roistat_phone = $('.roistat_phone_value').text();
    if (!roistat_phone) {
        roistat_phone = '8&nbsp;800&nbsp;222&#8209;16&#8209;90';
    }

    $('.shop_contain').show(700);
    if (screen.width > 425) {
        $('.shop_contain').prepend('<div class=phoneShop><strong class="roistat_phone">' + roistat_phone + '</strong></div>');
        $('.shop_contain').prepend('<div class=huomioShop><strong>Перед посещением</strong> шоу-рума, пожалуйста, <strong>свяжитесь с оператором</strong> для уточнения наличия по телефону:</div>');
        // $('.shop_contain').prepend('<div class=workTime>' + shop_info['work_time'] + '</div>');
        // $('.shop_contain').prepend('<div class=prevVorkTime><strong>Время работы:</strong></div>');

        if(shop_info['quarantine']) {// начало блока карантин
            $('.shop_contain').prepend('<div class=workTime>' + shop_info['work_time'] + '</div>');
            $('.shop_contain').prepend('<div class=workTime><b style="color:red;">'+shop_info['quarantine']+':</div>');

        } else {
            $('.shop_contain').prepend('<div class=workTime><b style="color:red;">Магазин Закрыт.</b> Ожидаемая дата открытия 15 июля</div>');
        }/// блок на карантин END

    }
    if (shop_info['metro']) {
        $('.shop_contain').prepend('<div class=metroText>м.' + shop_info['metro'] + '</div>');
    } else {
        $('.shop_contain').prepend('<div class=metroText>' + shop_info['city'] + '</div>');
    }
    $('#smsSendModal').find('.shopid').val(shopID);
}