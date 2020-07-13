window.dataLayer = window.dataLayer || [];

$(document).ready(function () {

    $('#basket_slider_left').owlCarousel({
        // autoHeight: true,
        singleItem: true,
        autoPlay: false, // задано переменной
        mouseDrag: false,
        touchDrag: false,
        autoHeight: true
    });
// слайдер-чек
    $('#paycheck_slider').owlCarousel({
        // autoHeight: true,
        singleItem: true,
        autoPlay: false, // задано переменной
        mouseDrag: false,
        touchDrag: false,
    });
    var owl_main_block = $("#basket_slider_left").data('owlCarousel');
    var owl_check_block = $("#paycheck_slider").data('owlCarousel');
    // слайдер слева

// owl_main_block.jumpTo(5);
// owl_check_block.jumpTo(3);

    // GTM step 1
    var productsGTM = [];
    $('.cl_items_prop').each(function (key,item) {
        var $this = $(this);
        var GTMproduct_one = {
            'name': $this.data('name'),
            'id': $this.data('product'),
            'price': $this.data('price'),
            'brand': '',
            'category': '',
            'quantity': $this.data('quantity')
        };
        productsGTM.push(GTMproduct_one);
    });


    dataLayer.push({
        'ecommerce': {
            'currencyCode': 'RUB',
            'checkout': {
                'actionField': {'step': 1},
                'products': productsGTM
            }
        },
        'event': 'gtm-ee-event',
        'gtm-ee-event-category': 'Enhanced Ecommerce',
        'gtm-ee-event-action': 'Checkout Step 1',
        'gtm-ee-event-non-interaction': 'False',
    });

// кнопка на первом слайде(0) товары
    $('.confirm_order_btn').click(function () {
        var slide_number = 1;
        owl_main_block.jumpTo(slide_number);
        owl_check_block.jumpTo(slide_number);
        progressFunc(slide_number);


    });




// запись в куки элементов формы при наборе
    $('.input_basket').on('change keyup keypress focusout', function () {
        $.cookie('basket_' + $(this).attr('data-name'), $(this).val().trim(), {
            expires: 30,
            path: '/',
        });
    });
// снимаем выделение с незаполненых элементов прри вводе
    $('.input_basket').on('change', function () {
        $(this).removeClass('alert_element');
    });

    $('.btn_price_check').on('click', function () {

        // console.log($('.cl_items_prop').eq(0));
        items = {};
        $.each($('.cl_items_prop'), function (item, value) {
            items[$(this).data('product')] = $(this).data('price');
        });

        data_price_check = {
            operation: 'price_check',
            basket_id: $('.cl_items_prop').eq(0).data('id'),
            quantity: $('.cl_items_prop').eq(0).data('quantity'),
            products: items
        };

        // console.log(data_price_check);
        $.post(
            '/bitrix/components/mainpage/basket/ajax/',
            data_price_check,
            function (result) {
                // console.log('result', result);
                if(result == 1){
                    $('#reload_modal').modal('show');
                }
            });
    });
    $('.btn_check_price_reload').on('click', function () {
        location.reload();
    });



    data_order = {};
// валидация номера по маске
    $(".phonenumber").mask("+7 (999) 999-99-99");
// кнопка на втором слайде(1) телефон
//****************************************//
    $('.phone_confirm').click(function () {
        var slide_number = 2;
        var data = {
            operation: 'phone',
        };
        var phone = $(this).parent().find('.form_input_basket').val().replace(/\+7 \(([0-9]{3})\) ([0-9]{3})\-([0-9]{2})\-([0-9]{2})/ig, "+7$1$2$3$4");
        if (phone) {
            data_order['phone'] = data['phone'] = phone;
            if ($.cookie('roistat_visit')) {
                data_order['roistat_id'] = data['roistat_id'] = $.cookie('roistat_visit');
            }
            ajaxBasketChange(data, 'not_reload');
            owl_main_block.jumpTo(slide_number);
            progressFunc(slide_number);
        } else {
            $(this).parent().find('.error_wrap').html('<span class="error_message">Заполните поле ' + $(this).parent().find('.input_basket').attr('placeholder') + '</span>');
            $(this).parent().find('.form_input_basket').addClass('alert_element');
        }

        // GTM step 2

        // dataLayer.delete['ecommerce'];
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'RUB',
                'checkout': {
                    'actionField': {'step': slide_number},
                    'products': productsGTM
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Checkout Step 2',
            'gtm-ee-event-non-interaction': 'False',
        });
        
    });


// кнопка на третьем слайде(2) ФИО + майл
//****************************************//
    $('.fio_confirm').click(function () {
        var slide_number = 3;
        confirm_flag = true;
        error_massage = '';
        var data = {
            operation: 'fio',
            phone: data_order['phone']
        };
        // проверка имени
        var fullname_input = $('.fullname_input');
        if (fullname_input.val()) {
            data_order[fullname_input.data('name')] = data[fullname_input.data('name')] = fullname_input.val();
        } else {
            confirm_flag = false;
            fullname_input.addClass('alert_element');
            error_massage = error_massage + '<span class="error_message">Заполните поле ' + fullname_input.attr('placeholder') + '</span>';
        }

        // проверка заполнения майл
        var email_input = $('.email_input');
        if (email_input.val()) {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
            if (!pattern.test(email_input.val())) {
                confirm_flag = false;
                email_input.addClass('alert_element');
                error_massage = error_massage + '<span class="error_message">Заполните правильно поле ' + email_input.attr('placeholder').split(' ')[0] + '</span>';
            } else {
                data_order[email_input.data('name')] = data[email_input.data('name')] = email_input.val();
            }
        }

        // $.each($(this).parent().find('.form_input_basket'), function (key, value) {
        //     // проверяем заполненость
        //     if($(this).val()){
        //         // окрашиваем красным в случаее неправильного ввода ящика
        //         if($(this).data('name') == 'mail'){
        //             var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
        //             if(!pattern.test($(this).val())){
        //                 confirm_flag = false;
        //                 $(this).addClass('alert_element');
        //                 error_massage = error_massage + '<span class="error_message">Заполните поле '+$(this).attr('placeholder')+'</span>';
        //             }
        //         }
        //     } else {
        //         confirm_flag = false;
        //         $(this).addClass('alert_element');
        //         error_massage = error_massage + '<span class="error_message">Заполните поле '+$(this).attr('placeholder')+'</span>';
        //     }
        //     if(confirm_flag == true){
        //         data_order[$(this).data('name')] = data[$(this).data('name')] = $(this).val();
        //     }
        // });
        // console.log('data_order', data_order);
        $(this).parent().parent().find('.error_wrap').html(error_massage);
        if (confirm_flag == true) {
            ajaxBasketChange(data, 'not_reload');
            owl_main_block.jumpTo(slide_number);
            progressFunc(slide_number);
        }

        // GTM step 3

        // dataLayer.delete['ecommerce'];
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'RUB',
                'checkout': {
                    'actionField': {'step': slide_number},
                    'products': productsGTM
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Checkout Step 3',
            'gtm-ee-event-non-interaction': 'False',
        });
        
    });

// выбор способа доставки
    $('.delivery_item').on('click', function () {
        $('.delivery_adress_block').show();
        $('.delivery_item').find('.check_elem_delivery').removeClass('delivery_check_elem_active');
        $(this).find('.check_elem_delivery').addClass('delivery_check_elem_active');
        $('.delivery_confirm').attr('data-delivery', $(this).data('delivery'));
        $('.delivery_confirm').attr('data-paysystem', $(this).data('paysystem'));
        if ($(this).data('delivery') == 2) {
            $('.delivery_adress_block').hide();
        }
        // console.log('dostavka' , $(this).data('delivery'));
    });
//* кнопка на четвертом слайде(3) доставка
//****************************************//
    $('.delivery_confirm').on('click',function () {
        var delivery_flag = true;
        var slide_number = 4;
        $('.paysystem_box').children().remove(); // очищаем блок платежных систем
        data_order['delivery'] = $(this).attr('data-delivery');
        paysystem = $(this).attr('data-paysystem');
        if ($('.delivery_adress_block').css('display') != 'none') {
            if (!$('.adress_input').val()) {
                delivery_flag = false;
                $('.adress_input').addClass('alert_element');
            }
        }
        paySystemFill(paysystem.split(','), arPaysystem); //заполняем платежные системы
        if (delivery_flag == true) {
            data_order['adress'] = $('.adress_input').val();
            owl_main_block.jumpTo(slide_number);
            progressFunc(slide_number);
        }

        // GTM step 4

        // dataLayer.delete['ecommerce'];
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'RUB',
                'checkout': {
                    'actionField': {'step': slide_number},
                    'products': productsGTM
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Checkout Step 4',
            'gtm-ee-event-non-interaction': 'False',
        });
        
    });

// выбор способа оплаты
    $('.paysystem_box').on('click', '.paysystem_item', function () {
        $('.paysystem_item').find('.check_elem_paysystem').removeClass('paysystem_check_elem_active');
        $(this).find('.check_elem_paysystem').addClass('paysystem_check_elem_active');
        $('.paysystem_confirm').attr('data-paysystem', $(this).data('paysystem'));
        // console.log('paysystem');
        if ($(this).data('paysystem') == 16) {
            $('.credit_line_first_btn').click();
        }
        // GTM step 5

        // dataLayer.delete['ecommerce'];
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'RUB',
                'checkout': {
                    'actionField': {'step': '5'},
                    'products': productsGTM
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Checkout Step 5',
            'gtm-ee-event-non-interaction': 'False',
        });
    });
// кнопка на пятом слайде(4) Подтверждение заказа
//****************************************//
    $('.paysystem_confirm').on('click', function () {
        var slide_number = 5;
        data_order['operation'] = 'ordered';
        data_order['paysystem'] = $(this).attr('data-paysystem');
        data_order['discount_price'] = $('.order_discount_price').data('price');
        data_order['delivery_price'] = $('.order_delivery_price').data('price');
        data_order['summary_price'] = $('.order_summary_price').data('price');
        basket_loader();
        ajaxBasketChange(data_order, 'not_reload', 'order');

        owl_main_block.jumpTo(slide_number);
        owl_check_block.jumpTo(2);
        progressFunc(slide_number);


        

    });

///**********//
//*Рассрочка*//
//***********//
// переход к кредитлайну с первого чека
    $('.credit_line_first_btn').on('click', function () {
        owl_main_block.jumpTo(6);
        owl_check_block.jumpTo(1);
        progressFunc(4);

        // GTM step credit_line

        // dataLayer.delete['ecommerce'];
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'RUB',
                'checkout': {
                    'actionField': {'step': 6},
                    'products': productsGTM
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Checkout Step credit_line',
            'gtm-ee-event-non-interaction': 'False',
        });
    });
// обработка суммы рассрочки
    $('.cl_range').on('change', function () {
        $(this).parent().find('.range_end_count').text($(this).val());
        var base = $('.cl_summ_base').val();
        var pMonthly = $('.cl_summ_in_month').val();
        var pay_first = $('#cl_pay_first').val();
        var pLength = $('#cl_pay_month').val();

        var pTotal = Math.ceil(base - (base * pay_first * 0.01));
        var pMonthly = Math.ceil((base - (base * pay_first * 0.01)) / pLength);

        $('.cl_summ_total').val(pTotal);
        $('.cl_summ_in_month').val(pMonthly);
    });

// валидация номера по маске
    $(".cl_main_phone").mask("+7 (999) 999-99-99");
    $(".cl_phone_dop").mask("+7 (999) 999-99-99");
// запись в куки элементов формы при наборе
    $('.cl_info_input').on('keyup', function () {
        $.cookie('basket_' + $(this).attr('data-name'), $(this).val().trim(), {
            expires: 30,
            path: '/',
        });
    });
// подтверждение заявки на рассрочку
    $('.confirm_cl_btn').on('click', function () {
        var cl_flag = true;
        // грузим все продукты
        dataOne = [];
        $.each($('.cl_items_prop'), function (i, value) {
            dataOne.push($(this).data());
        });
        // данные для отправки в виджет рассрочки
        var formData = {
            credit_line: {
                client: {},
                products: dataOne,
                payment: {
                    duration: parseInt($('#cl_pay_month').val(), 10),
                    initial: Math.floor($('.cl_summ_base').val() * $('#cl_pay_first').val() * 0.01),
                    discount: 14
                }
            }
        };

        $.each($('.validate_input'), function (key, value) {
            // валидация элементов формы
            // чекбоксы
            if ($(this).attr('type') == 'checkbox') {
                if ($(this).is(':checked')) {
                } else {
                    $(this).parent().find('.info_title').addClass('alert_element_color');
                    $('.cl_error_block').show();
                    cl_flag = false;
                }
                // все остальные поля
            } else {
                if (!$(this).val()) {
                    $(this).parent().find('.info_title').addClass('alert_element_color alert_element_right');
                    $(this).addClass('alert_element');
                    $('.cl_error_block').show();
                    cl_flag = false;
                } else {
                    // проверка майла
                    if ($(this).attr('id') == 'cl_mail') {
                        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
                        if (!pattern.test($(this).val())) {
                            cl_flag = false;
                            $(this).parent().find('.info_title').addClass('alert_element_color alert_element_right');
                            $(this).addClass('alert_element');
                            $('.cl_error_block').show();
                        } else {
                            data_order[$(this).data('name')] = formData.credit_line.client[$(this).data('name')] = $(this).val();
                        }
                    } else {
                        if ($(this).data('name') == 'phone') {
                            data_order[$(this).data('name')] = formData.credit_line.client[$(this).data('name')] = $(this).val().replace(/\+7 \(([0-9]{3})\) ([0-9]{3})\-([0-9]{2})\-([0-9]{2})/ig, "+7$1$2$3$4");
                        } else {
                            data_order[$(this).data('name')] = formData.credit_line.client[$(this).data('name')] = $(this).val().replace(/\+7 \(([0-9]{3})\) ([0-9]{3})\-([0-9]{2})\-([0-9]{2})/ig, "+7$1$2$3$4");
                        }
                    }
                }
            }

        });
        // значение доп телефона
        if ($('#cl_phone_dop').val()) {
            formData.credit_line.client['extPhone'] = $('#cl_phone_dop').val().replace(/\+7 \(([0-9]{3})\) ([0-9]{3})\-([0-9]{2})\-([0-9]{2})/ig, "+7$1$2$3$4");
        }

        // заполняем данные для отправки в битрикс
        data_order['operation'] = 'cl-ordered';
        data_order['paysystem'] = 16;
        data_order['delivery'] = 3;
        if ($.cookie('roistat_visit')) {
            data_order['roistat_id'] = $.cookie('roistat_visit');
        }
        if ($('.order_discount_price').data('price')) {
            data_order['discount_price'] = $('.order_discount_price').data('price');
        } else {
            data_order['discount_price'] = 0;
        }
        data_order['delivery_price'] = $('.order_delivery_price').data('price');
        data_order['summary_price'] = $('.order_summary_price').data('price');

        formData.credit_line.price = data_order['summary_price'];
        // console.log('formData', formData);

        // подтверждаем отправку данных
        if (cl_flag == true) {
            basket_loader();
            $.post('/api/credit_line_gate/api/set_order/', formData, function (data) {
                if (data.status == 'OK') {
                }
            }, 'json');
            ajaxBasketChange(data_order, 'not_reload', 'order', 'cl', owl_main_block, owl_check_block);
        }
    });
// снятие покраснений с элементов формы
    $('.validate_input').on('change', function () {
        $(this).parent().find('.info_title').removeClass('alert_element_color alert_element_right');
        $(this).removeClass('alert_element');
        $('.cl_error_block').hide();
    });

///**************//
//*Рассрочка END*//
//***************//


// кнопка возврата на слайд назад
    $('.prev_slide').click(function () {
        progressPrev($(this).data('slide'));
        // console.log(' $(this).data(\'slide\');',  $(this).data('slide'), '$(this).data(\'check\')', $(this).data('check'));
        // owl_main_block.jumpTo(0);
        if ($(this).data('check') == 0) {
            owl_check_block.jumpTo($(this).data('check'));
        }
        owl_main_block.prev();
        if ($(this).data('cl') == 'Y') {
            owl_main_block.goTo(3);
        }
    });

// $('.cl_label_slide').on('click', function () {
//
//     if($(this).text()!=5){
//         console.log('slide',$(this).text());
//     }
// });

// выводим пласехолдер над инпутом
    $('.form_input_basket').on('focus', function () {
        $(this).parent().parent().find('.error_wrap').html('');
        if ($(this).attr("placeholder").indexOf("*") > 0) {
            var message = $(this).attr('placeholder').split('*');
            $(this).parent().find('.input_placeholder').html(message[0] + '<b class="red_star">*</b>');
        } else {
            $(this).parent().find('.input_placeholder').text($(this).attr('placeholder'));
        }
    });
// убираем пласехолдер над инпутом
    $('.form_input_basket').on('focusout', function () {
        if (!$(this).val() || $(this).val() == '+7 (___) ___-__-__') {
            $(this).parent().find('.input_placeholder').html('');
        }
    });

// удаляем из корзины
    $('.delete_product').on('click', function () {
        $('.gtm-product-id').val($(this).data('item_id'));
        var data = {
            operation: 'delete',
            id: $(this).data('item_id')
        };
        ajaxBasketChange(data);

        var $this = $(this).parents('.basket_products_item');

        // GTM удаляем из корзины
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'RUB',
                'remove': {
                    'products': [{
                        'name': $this.data('name'),
                        'id': $this.data('product'),
                        'price': $this.data('price'),
                        'brand': '',
                        'category': '',
                        'variant': '',
                        'quantity': $this.data('quantity')
                    }]
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Removing a Product from a Shopping Cart',
            'gtm-ee-event-non-interaction': 'False',
        });
    });
// увеличиваем/уменьшаем количество товаров в корзине
    $('.quantity_product_change').on('click', function () {
        var data = {
            operation: $(this).data('operation'),
            id: $(this).data('item_id'),
            QUANTITY: $(this).data('count'),
        };
        ajaxBasketChange(data);
    });

//пометка о невозможности включения рассрочки
    if (screen.width > 410) {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                title: 'В Вашей корзине есть товар, не доступный для приобретения в рассрочку. <a href="/content/credit_buy/" target="_blank">Подробнее</a>',
                placement: 'top',
                trigger: 'click hover',
            })
        })
    } else {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                title: 'В Вашей корзине есть товар, не доступный для приобретения в рассрочку. <a href="/content/credit_buy/" target="_blank">Подробнее</a>',
                placement: 'bottom',
                trigger: 'click hover',
            })
        })
    }

    // отправка данных аякс запросом
    function ajaxBasketChange(data, reload, order, cl, owl_main_block, owl_check_block) {
        // console.log('rassrochka', 'data:', data, 'reload:',reload, 'order:',order, 'cl:',cl, 'owl_main_block:',owl_main_block, 'owl_main_block',owl_check_block);
        //  отключаем прелоадер
        if (reload != 'not_reload') {
            basket_loader();
        }
        // оправляем в битрикс
        $.post(
            '/bitrix/components/mainpage/basket/ajax/',
            data,
            function (result) {
                //  отключаем перезагрузку странички
                if (reload != 'not_reload') {
                    location.reload();
                }
                //отправка в амо
                if (order == 'order') {
                    // проставляем заполненые поля формы на странице результата
                    $.each($('.client_info_wrap'), function (value) {
                        // console.log('wrap', $(this).data('content'));
                        $(this).find('.client_info_value').text(data[$(this).data('content')]);
                    });

                    // установка значений в чек
                    var value = JSON.parse(result);
                    $('.order_number').append(' ' + value['order']);
                    $('#spiner_modal').modal('hide');
                    $.get(
                        'https://node220.jivosite.com/widget/status/468678/HobMKhIZv9',
                        function (result) {
                            // console.log('result', result['agents'][0]['display_name']);
                            var name = result['agents'][0]['display_name'];
                            $('.expert_name').text(name);
                            $('.expert_foto img').attr('src', '/bitrix/components/mainpage/basket/image/' + name + '.png');
                        }
                    );

                    // для оплаты картой переходим в платежный шлюз
                    if (data['paysystem'] == 14) {
                        window.open('/personal/order/payment/?ORDER_ID=' + value['order']);
                        $('.order_payment_block').append('<span class="payment_info">Если окно с платежной информацией не открылось автоматически, нажмите </span> <a class="basket_btn orange_title" target="_blank" href="/personal/order/payment/?ORDER_ID=' + value["order"] + '">Оплатить картой</a>')
                    }
                    // отправка в црм для обычного заказа
                    if (cl != 'cl') {
                        AmoOrderSet(value['order']);
                    } else {

                        // переход на страницу завершения оформления для заказа в рассрочку
                        owl_main_block.jumpTo(5);
                        owl_check_block.jumpTo(3);
                        progressFunc(5);
                    }


                    // GTM Подтверждение заказа

                    dataLayer.push({
                        'ecommerce': {
                            'currencyCode': 'RUB',
                            'purchase': {
                                'actionField': {
                                    'id': 'm24_'+$.now(),
                                },
                                'products': productsGTM
                            }
                        },
                        'event': 'gtm-ee-event',
                        'gtm-ee-event-category': 'Enhanced Ecommerce',
                        'gtm-ee-event-action': 'Purchase',
                        'gtm-ee-event-non-interaction': 'False',
                    });
                }
            }
        );

    }
// передаем параметры заказа в Амо
    function AmoOrderSet(order) {
        $.get(
            '/api/new_basket_order/',
            {ORDER_ID: order}
        );
    }

// крутилка
    function basket_loader() {
        $('#spiner_modal').modal('show');
    }

// прогресс бар по заказу
    function progressFunc(slide_number) {
        var ID = '#circle_' + slide_number;
        $(ID).addClass('active');
        for (i = 1; i < slide_number; i++) {
            $('#circle_' + i).removeClass('active').addClass('done');
        }
        if (slide_number == 5) {
            $(ID).addClass('done');
        }
    }

// откат прогресс бара назад
    function progressPrev(slide_number) {
        var ID = '#circle_' + (slide_number - 1);
        var Next_ID = '#circle_' + (slide_number);
        $(ID).removeClass('done').addClass('active');
        $(Next_ID).removeClass('active');
    }

// отображение и выбор платежных систем
    function paySystemFill(arPayDelivery, arPay) {
        var content = '';
        var count = 1;
        // формируем массив с доступными платежными системами
        if (arPayDelivery) {
            $('.paysystem_wrap').children().remove();
            var select_pays = {};
            $.each(arPayDelivery, function (i, value) {
                if (arPay[value]) {
                    select_pays[value] = arPay[value];
                }
            });
            arPay = select_pays;
        }
        // console.log('arPay', arPay);

        $.each(arPay, function (i, item) {
            if (count == 1) {
                check_pay = i;
                var check_class = 'paysystem_check_elem_active';
            } else {
                var check_class = '';
            }
            content = content + '<div class="paysystem_item" data-paysystem="' + i + '" id="paysystem_id_' + i + '">' +
                '            <div class="check_paysystem_item"><div class="check_elem_paysystem ' + check_class + '"></div></div>' +
                '            <div class="paysystem_info">' +
                '                <div class="paysystem_name">' + item["NAME"] + '</div>' +
                '                <div class="paysystem_description">' + item["DESCRIPTION"] + '</div>' +
                '            </div>' +
                '        </div>';
            count++;
        });


        $('.paysystem_box').append(content);
        $('.paysystem_confirm').attr('data-paysystem', check_pay);

        // GTM step 5

        // dataLayer.delete['ecommerce'];
        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'RUB',
                'checkout': {
                    'actionField': {'step': '5'},
                    'products': productsGTM
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Checkout Step 5',
            'gtm-ee-event-non-interaction': 'False',
        });
    }

});



