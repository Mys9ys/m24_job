<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/basket/style.css'); ?>
<link href="https://dadata.ru/static/css/lib/suggestions-15.6.css" type="text/css" rel="stylesheet">
<? //dd($arResult)?>

<? if (!empty($arResult['BASKET_ITEMS'])) { ?>
    <div class="basket_box">
        <? //прогресс заполнения заказа?>
        <div class="progress_basket">
            <? $progress = array(
                'Телефон',
                'ФИО&nbsp;и&nbsp;E&#8209mail',
                'Доставка',
                'Способы&nbsp;оплаты',
                'Подтверждение',
            );
            foreach ($progress as $key => $title) {
                ?>
                <div class="circle" id="circle_<?= $key + 1 ?>">
                    <div class="label cl_label_slide"><?= $key + 1 ?></div>
                    <div class="title"><?= $title ?></div>
                </div>
                <? if ($key + 1 < count($progress)) {
                    ?>
                    <div class="bar" id="bar_<?= $key + 1 ?>"></div>
                <? } ?>
            <? } ?>
        </div>
        <? //прогресс заполнения заказа END?>

        <div class="left_monitor">
            <div id="basket_slider_left" class="owl-carousel owl-theme">

                <? //слайд товаров в корзине?>
                <div class="basket_slide_products owlElement">
                    <div class="basket_products_block">
                        <? foreach ($arResult['BASKET_ITEMS'] as $product) { ?>
                            <div class="basket_products_item cl_items_prop"
                                 data-id="<?= $product['ID'] ?>"
                                 data-product="<?= $product['PRODUCT_ID'] ?>"
                                 data-name="<?= $product['name'] ?>"
                                 data-price="<?= ceil($product['PRICE']) ?>"
                                 data-quantity="<?= ceil($product['QUANTITY']) ?>">
                                <input type="hidden" value="<?= $product['ID'] ?>" class="gtm-product-id">
                                <input type="hidden" value="<?= ceil($product['PRICE']) ?>" class="gtm-product-price">
                                <input type="hidden" value="<?= $product['SECTION_NAME'] ?>" class="gtm-category-name">
                                <input type="hidden" value="<?= $product['SECTION_ID'] ?>" class="gtm-category-id">
                                <input type="hidden" value="<?= $product['MANUFACTURER_NAME'] ?>" class="gtm-brand">
                                <input type="hidden" value="cart" id="gtm-page-type">

                                <div class="product_img"><img src="<?= $product['DETAIL_PICTURE'] ?>" alt=""></div>
                                <? if (!empty($product['stickers'])) { ?>
                                    <div class="sticker_block">
                                        <? foreach ($product['stickers'] as $key => $sticker) { ?>
                                            <div class="<?= $key ?> sticker_item ">
                                                <div class="sticker_grad">
                                                    <span><?= $sticker ?></span>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                <? } ?>

                                <div class="product_name_wrap"><a class="product_name"
                                                                  href="<?= $product['DETAIL_PAGE_URL'] ?>"><?= $product['name'] ?></a>
                                </div>
                                <div class="delete_product" data-item_id="<?= $product['ID'] ?>"><i
                                            class="fa fa-trash-o" aria-hidden="true"></i></div>
                                <div class="basket_quantity_wrap">
                                    <div class="basket_quantity">
                                        <div class="quantity_product_change minus" data-item_id="<?= $product['ID'] ?>"
                                             data-operation="minus" data-count="<?= $product['QUANTITY'] ?>">–
                                        </div>
                                        <input class="quantity_product_field" type="text"
                                               value="<?= ceil($product['QUANTITY']) ?>" readonly>
                                        <div class="quantity_product_change plus" data-item_id="<?= $product['ID'] ?>"
                                             data-operation="plus" data-count="<?= $product['QUANTITY'] ?>">+
                                        </div>
                                    </div>
                                </div>
                                <div class="product_price_summary_wrap">
                                    <div class="product_price_summary">
                                        <? if ($product['DISCOUNT_PRICE'] > 0) { ?>
                                            <div class="old_price"> <?= number_format(ceil($product['old_price']), 0, '', ' ') ?>
                                                руб.
                                            </div>
                                            <div class="discount_price">
                                                - <?= number_format(ceil($product['DISCOUNT_PRICE']) * ceil($product['QUANTITY']), 0, '', ' ') ?>
                                                руб.
                                            </div>
                                            <div class="price_end"><?= number_format(ceil($product['PRICE']) * ceil($product['QUANTITY']), 0, '', ' ') ?>
                                                руб.
                                            </div>
                                        <? } else { ?>
                                            <div class="price_no_discount"><?= number_format(ceil($product['PRICE']) * ceil($product['QUANTITY']), 0, '', ' ') ?>
                                                руб.
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="confirm_order_btn basket_btn btn_right">Оформить заказ</div>
                </div>
                <? //слайд товаров в корзине END?>

                <? //слайд подтверждения номера телефона?>
                <div class="basket_slide_contacts owlElement">
                    <div class="contacts_block block_minimum">
                        <div class="error_wrap"></div>
                        <div class="contacts_block_title block_minimum_title">
                            Ваши контактные данные
                        </div>
                        <div class="input_wrap">
                            <span class="input_placeholder"><? if (!empty($_COOKIE['basket_phone'])) echo 'Телефон <b class="red_star">*</b>' ?></span>
                            <input class="form_input_basket validate_basket input_basket phonenumber" data-name="phone"
                                   type="text" value="<?= $_COOKIE['basket_phone'] ?>" id="ORDER_PROP_3"
                                   placeholder="Телефон*">
                            <input class="phonenumber_format" type="hidden">
                        </div>
                        <div class="prev_slide basket_btn btn_left" data-slide="1" data-check="0">Назад</div>
                        <div class="phone_confirm basket_btn btn_right">Далее</div>
                    </div>
                </div>
                <? //слайд подтверждения номера телефона END?>

                <? //слайд подтверждения ФИО и e-mail?>
                <script type="text/javascript"
                        src="https://dadata.ru/static/js/lib/jquery.suggestions-15.6.min.js"></script>
                <div class="basket_slide_contacts owlElement">
                    <div class="contacts_block block_minimum">
                        <div class="error_wrap"></div>
                        <div class="contacts_block_title block_minimum_title">
                            Ваши контактные данные
                        </div>
                        <div class="input_wrap">
                            <span class="input_placeholder"><? if (!empty($_COOKIE['basket_fullname'])) echo 'Ф.И.О. <b class="red_star">*</b>' ?></span>
                            <input class="form_input_basket fullname_input input_basket" data-name="fullname"
                                   type="text" id="bskt_name" value="<?= $_COOKIE['basket_fullname'] ?>"
                                   placeholder="Ф.И.О.*">
                        </div>
                        <div class="input_wrap">
                            <span class="input_placeholder"><? if (!empty($_COOKIE['basket_email'])) echo 'E-Mail' ?></span>
                            <input class="form_input_basket email_input input_basket" data-name="email" type="text"
                                   id="ORDER_PROP_2" value="<?= $_COOKIE['basket_email'] ?>"
                                   placeholder="E-Mail (необязательно)">
                        </div>
                        <div class="prev_slide basket_btn btn_left" data-slide="2">Назад</div>
                        <div class="fio_confirm basket_btn btn_right">Далее</div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#bskt_name').suggestions({
                            serviceUrl: "https://dadata.ru/api/v2",
                            token: "201f84e5f54961f94507cfa28412e689154eeffa",
                            type: "NAME",
                            count: 5,
                            onSelect: function (suggestion) {
                            }
                        });
                        $('#bskt_adress').suggestions({
                            serviceUrl: "https://dadata.ru/api/v2",
                            token: "201f84e5f54961f94507cfa28412e689154eeffa",
                            type: "ADDRESS",
                            count: 9,
                            onSelect: function (suggestion) {
                            }
                        });
                    });
                </script>
                <? //слайд подтверждения ФИО и e-mail END?>

                <? //способ доставки?>
                <div class="basket_slide_delivery owlElement">
                    <div class="delivery_block block_minimum">
                        <div class="error_wrap"></div>
                        <div class="delivery_block_title block_minimum_title">
                            Способ доставки
                        </div>
                        <div class="delivery_box">
                            <? foreach ($arResult['DELIVERY'] as $key => $delivery) { ?>
                                <div class="delivery_item" data-delivery="<?= $delivery['ID'] ?>"
                                     id="delivery_id_<?= $delivery['ID'] ?>"
                                     data-paysystem="<?= $arResult['DELIVERY_NEW'][$delivery['ID']] ?>">
                                    <div class="check_delivery_item">
                                        <div class="check_elem_delivery <? if ($key == 0) {
                                            echo 'delivery_check_elem_active';
                                            $cheked = $delivery['ID'];
                                            $paysystem_check = $arResult['DELIVERY_NEW'][$delivery['ID']];
                                        } ?>">
                                        </div>
                                    </div>
                                    <div class="delivery_info">
                                        <div class="delivery_name">
                                            <?= $delivery['NAME'] ?>
                                        </div>
                                        <? if ($delivery['PRICE'] > 0) { ?>
                                            <span><? echo GetMessage("SALE_DELIV_PRICE") . " " . $arDelivery["PRICE_FORMATED"] ?></span>
                                        <? } ?>
                                        <div class="delivery_description">
                                            <?= $delivery['DESCRIPTION'] ?>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>
                            <div class="delivery_adress_block">
                                <div class="input_wrap">
                                    <span class="input_placeholder"><? if (!empty($_COOKIE['basket_email'])) echo 'Адрес <b class="red_star">*</b>' ?></span>
                                    <input class="form_input_basket adress_input input_basket" data-name="adress"
                                           type="text" id="bskt_adress" value="<?= $_COOKIE['basket_adress'] ?>"
                                           placeholder="Адрес*">
                                </div>
                            </div>
                        </div>
                        <div class="prev_slide basket_btn btn_left" data-slide="3">Назад</div>
                        <div class="delivery_confirm basket_btn btn_right" data-delivery="<?= $cheked ?>"
                             data-paysystem="<?= $paysystem_check ?>">Далее
                        </div>
                    </div>
                </div>
                <? //способ доставки END?>

                <? //способ оплаты?>
                <div class="basket_slide_paysystem owlElement">
                    <div class="paysystem_block block_minimum">
                        <div class="error_wrap"></div>
                        <div class="paysystem_block_title block_minimum_title">
                            Способ оплаты
                        </div>
                        <script>
                            var arPaysystem = $.parseJSON('<?=json_encode($arResult['PAY_SYSTEM_NEW'])?>');
                        </script>
                        <div class="paysystem_box">
                            <!--                            --><? //foreach ($arResult['PAY_SYSTEM_NEW'] as $key => $paysystem){?>
                            <!--                                <div class="paysystem_item inactive_paysystem" data-paysystem="-->
                            <? //=$key?><!--" id="delivery_id_--><? //=$key?><!--">-->
                            <!--                                    <div class="check_paysystem_item inactive_paysystem"><div class="check_elem_paysystem -->
                            <? //if($key == 1) {echo 'paysystem_check_elem_active'; $cheked =$key;}?><!--"></div></div>-->
                            <!--                                    <div class="paysystem_info">-->
                            <!--                                        <div class="paysystem_name">-->
                            <!--                                            --><? //=$paysystem['NAME']?>
                            <!--                                        </div>-->
                            <!--                                        <div class="paysystem_description">-->
                            <!--                                            --><? //=$paysystem['DESCRIPTION']?>
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            --><? //}?>
                        </div>
                        <div class="prev_slide basket_btn btn_left" data-slide="4">Назад</div>
                        <div class="paysystem_confirm basket_btn btn_right confirm_btn_gtm" data-paysystem="">Оформить</div>
                    </div>
                </div>
                <? //способ оплаты END?>

                <? //завершение заказа?>
                <div class="basket_slide_confirm basket_slide_products owlElement">
                    <div class="title_confirm">Ваш заказ оформлен</div>
                    <div class="order_payment_block">

                    </div>
                    <div class="expert_contact">Нам эксперт свяжется с вами для уточнения деталей заказа</div>
                    <div class="basket_products_block">
                        <? foreach ($arResult['BASKET_ITEMS'] as $product) { ?>
                            <div class="basket_products_item">
                                <div class="product_img"><img src="<?= $product['DETAIL_PICTURE'] ?>" alt=""></div>
                                <? if (!empty($product['stickers'])) { ?>
                                    <div class="sticker_block">
                                        <? foreach ($product['stickers'] as $key => $sticker) { ?>
                                            <div class="<?= $key ?> sticker_item ">
                                                <div class="sticker_grad">
                                                    <span><?= $sticker ?></span>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                <? } ?>

                                <div class="product_name_wrap"><a class="product_name"
                                                                  href="<?= $product['DETAIL_PAGE_URL'] ?>"><?= $product['name'] ?></a>
                                </div>
                                <div class="basket_quantity_wrap">
                                    <div class="basket_quantity">
                                        <?= ceil($product['QUANTITY']) ?> шт.
                                    </div>
                                </div>
                                <div class="product_price_summary_wrap">
                                    <div class="product_price_summary">
                                        <? if ($product['DISCOUNT_PRICE'] > 0) { ?>
                                            <div class="old_price"> <?= number_format(ceil($product['old_price']), 0, '', ' ') ?>
                                                руб.
                                            </div>
                                            <div class="discount_price">
                                                - <?= number_format(ceil($product['DISCOUNT_PRICE']) * ceil($product['QUANTITY']), 0, '', ' ') ?>
                                                руб.
                                            </div>
                                            <div class="price_end"><?= number_format(ceil($product['PRICE']) * ceil($product['QUANTITY']), 0, '', ' ') ?>
                                                руб.
                                            </div>
                                        <? } else { ?>
                                            <div class="price_no_discount"><?= number_format(ceil($product['PRICE']) * ceil($product['QUANTITY']), 0, '', ' ') ?>
                                                руб.
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="basket_client_info">
                        <div class="client_info_block_title">
                            Данные покупателя
                        </div>
                        <div class="client_info_box">
                            <div class="phone_wrap client_info_wrap" data-content="phone">
                                <div class="phone_title client_info_title">Телефон</div>
                                <div class="phone_value client_info_value"></div>
                            </div>
                            <div class="fio_wrap client_info_wrap" data-content="fullname">
                                <div class="fio_title client_info_title">Имя и фамилия</div>
                                <div class="fio_value client_info_value"></div>
                            </div>
                            <div class="email_wrap client_info_wrap" data-content="email">
                                <div class="email_title client_info_title">Эл. почта</div>
                                <div class="email_value client_info_value"></div>
                            </div>
                            <div class="adress_wrap client_info_wrap" data-content="adress">
                                <div class="adress_title client_info_title">Адрес доставки</div>
                                <div class="adress_value client_info_value"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <? //завершение заказа END?>

                <? //рассрочка?>
                <div class="basket_slide_credit_line owlElement">
                    <div class="credit_line_block block_minimum">
                        <div class="error_wrap"></div>
                        <div class="paysystem_block_title block_minimum_title">
                            Оплата в рассрочку
                        </div>
                        <div class="credit_line_box">
                            <div class="credit_line_header">
                                <div class="cl_wrap">
                                    <div class="input_title">Сумма рассрочки</div>
                                    <input type="hidden" class="cl_summ_base" value="<?= $arResult['ORDER_PRICE'] ?>">
                                    <input type="text" class="header_input cl_summ_total" data-name="cl_summ_total"
                                           disabled value="<?= $arResult['ORDER_PRICE'] ?>">
                                </div>
                                <div class="cl_wrap">
                                    <div class="input_title">Ежемесячный платеж</div>
                                    <input type="text" class="header_input cl_summ_in_month"
                                           data-name="cl_summ_in_month" disabled
                                           value="<?= ceil($arResult['ORDER_PRICE'] / 12) ?>">
                                </div>
                            </div>
                            <div class="credit_line_range_block">
                                <div class="cl_range_wrap">
                                    <div class="range_title">Срок рассрочки</div>
                                    <input id="cl_pay_month" class="cl_pay_month cl_range" type="range" min="1" step="1"
                                           max="12" value="12" data-name="cl_pay_month" data-text="12 мес.">
                                    <div class="range_end">
                                        <div class="range_end_count">12</div>
                                        мес.
                                    </div>
                                </div>
                                <div class="cl_range_wrap">
                                    <div class="range_title">Первоначальный платеж</div>
                                    <input id="cl_pay_first" class="cl_pay_first cl_range" type="range" min="0"
                                           step="10" max="50" value="0" data-name="cl_pay_first" data-text="%">
                                    <div class="range_end">
                                        <div class="range_end_count">0</div>
                                        %
                                    </div>
                                </div>
                            </div>
                            <div class="credit_line_info_block">
                                <div class="info_wrap wrap_100">
                                    <div class="info_title">ФИО <span class="red_star">*</span></div>
                                    <input type="text" id="cl_name" class="cl_info_input cl_name validate_input"
                                           data-name="fullname" value="<?= $_COOKIE['basket_fullname'] ?>">
                                </div>
                                <div class="info_wrap wrap_50">
                                    <div class="info_title">Телефон контактный <span class="red_star">*</span></div>
                                    <input type="text" id="cl_main_phone"
                                           class="cl_info_input cl_main_phone validate_input" data-name="phone"
                                           value="<?= $_COOKIE['basket_phone'] ?>">
                                </div>
                                <div class="info_wrap wrap_50">
                                    <div class="info_title">E-mail <span class="red_star">*</span></div>
                                    <input type="text" id="cl_mail" class="cl_info_input cl_mail validate_input"
                                           data-name="email" value="<?= $_COOKIE['basket_email'] ?>">
                                </div>
                                <div class="info_wrap wrap_50">
                                    <div class="info_title">Телефон доп.</div>
                                    <input type="text" id="cl_phone_dop" class="cl_info_input cl_phone_dop"
                                           data-name="phone_dop" value="<?= $_COOKIE['basket_phone_dop'] ?>">
                                </div>
                                <div class="info_wrap wrap_50">
                                    <div class="info_title title_checkbox">Мне исполнилось 18 лет <span
                                                class="red_star">*</span></div>
                                    <input type="checkbox" class="cl_age18 validate_input cl_checkbox alert_element"
                                           data-name="age18">
                                </div>
                                <div class="info_wrap wrap_100">
                                    <div class="info_title">Адрес <span class="red_star">*</span></div>
                                    <input type="text" id="cl_adress" class="cl_info_input cl_adress validate_input"
                                           data-name="adress" value="<?= $_COOKIE['basket_adress'] ?>">
                                </div>
                                <div class="info_wrap wrap_100">
                                    <div class="info_title title_checkbox">Я даю согласие на обработку моих персональных
                                        данных <span class="red_star">*</span></div>
                                    <input type="checkbox" class="cl_politics validate_input cl_checkbox"
                                           data-name="politics">
                                </div>
                            </div>
                            <script>
                                $('#cl_name').suggestions({
                                    serviceUrl: "https://dadata.ru/api/v2",
                                    token: "201f84e5f54961f94507cfa28412e689154eeffa",
                                    type: "NAME",
                                    count: 5,
                                    onSelect: function (suggestion) {
                                    }
                                });
                                $('#cl_adress').suggestions({
                                    serviceUrl: "https://dadata.ru/api/v2",
                                    token: "201f84e5f54961f94507cfa28412e689154eeffa",
                                    type: "ADDRESS",
                                    count: 5,
                                    onSelect: function (suggestion) {
                                    }
                                });
                            </script>

                            <div class="prev_slide basket_btn btn_left" data-slide="4" data-cl="Y">Назад</div>
                            <div class="confirm_cl_btn basket_btn btn_right orange_title confirm_btn_gtm">Отправить заявку</div>
                            <div class="cl_error_block">* Заполните все обязательные поля</div>
                            <div class="bank_img">
                                <img src="/bitrix/components/mainpage/basket/image/alfabank.png" alt="">
                                <img src="/bitrix/components/mainpage/basket/image/home.png" alt="">
                                <img src="/bitrix/components/mainpage/basket/image/kredit_evro.png" alt="">
                                <img src="/bitrix/components/mainpage/basket/image/opt.png" alt="">
                                <img src="/bitrix/components/mainpage/basket/image/pochta-bank.png" alt="">
                                <img src="/bitrix/components/mainpage/basket/image/renessans.png" alt="">
                                <img src="/bitrix/components/mainpage/basket/image/paylate.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <? //рассрочка END?>

            </div>
        </div>
        <div class="right_monitor">

            <div id="paycheck_slider" class="owl-carousel owl-theme">
                <? // первый чек с кнопкой подтверждение количества товаров?>
                <div class="paycheck_product_box owlElement">
                    <div class="check_left_half">
                        <div class="product_box_header">
                            <div class="product_box_left paycheck_box_left">
                                <div class="product_title paycheck_box_title">Товары</div>
                                <div class="product_count paycheck_box_description"><?= $arResult["count_poducts"] ?>
                                    шт.
                                </div>
                            </div>
                            <div class="price_box_right paycheck_box_count">
                                <? if (!empty($arResult['summary_profit'])) { ?>
                                    <?= number_format(ceil($arResult["summary_old_price"]), 0, '', ' ') ?> руб.
                                <? } else { ?>
                                    <?= number_format(ceil($arResult["ORDER_PRICE"]), 0, '', ' ') ?> руб.
                                <? } ?>
                            </div>
                        </div>
                        <? if (!empty($arResult['summary_profit'])) { ?>
                            <div class="paycheck_discount_box">
                                <div class="paycheck_discount_title paycheck_box_left">
                                    <div class="paycheck_box_title">Выгода</div>
                                </div>
                                <div class="paycheck_discount_count paycheck_box_count">
                                    <?= number_format(ceil($arResult["summary_profit"]), 0, '', ' ') ?> руб.
                                </div>
                            </div>
                        <? } ?>
                        <div class="line_item"></div>
                        <div class="paycheck_summary_block">
                            <div class="paycheck_summary_title">Итого</div>
                            <div class="paycheck_summary_count">
                                <?= number_format(ceil($arResult["ORDER_PRICE"]), 0, '', ' ') ?> руб.
                            </div>
                        </div>
                    </div>
                    <div class="check_right_half">
                        <div class="confirm_order_btn paycheck_btn">Перейти к оформлению</div>
                        <div class="pay_and_delivery text_block">
                            Доступные способы оплаты и доставки можно выбрать при оформлении заказа
                        </div>
                        <? if ($arResult['credit_line'] == true) { ?>
                            <div class="credit_line_first_btn paycheck_btn orange_title">Оформить в рассрочку</div>
                        <? } else { ?>
                            <div class="paycheck_btn credit_line_disable" data-toggle="tooltip" data-html="true">
                                Оформить в рассрочку
                            </div>
                        <? } ?>
                        <div class="personal_data text_block">
                            Нажимая на кнопку, вы подтверждаете своё совершеннолетие, соглашаетесь на обработку
                            персональных данных в соответствии с
                            <a href="/personaldata/agree.php">Условиями</a>, а также с <a href="/personaldata/">Политикой</a>
                        </div>
                    </div>
                </div>
                <? // первый чек с кнопкой подтверждение количества товаров END?>

                <? // второй чек промежуточный?>
                <div class="paycheck_product_box owlElement">
                    <div class="product_box_header">
                        <div class="product_box_left paycheck_box_left">
                            <div class="product_title paycheck_box_title">Товары</div>
                            <div class="product_count paycheck_box_description"><?= $arResult["count_poducts"] ?>шт.
                            </div>
                        </div>
                        <div class="price_box_right paycheck_box_count">
                            <? if (!empty($arResult['summary_profit'])) { ?>
                                <?= number_format(ceil($arResult["summary_old_price"]), 0, '', ' ') ?> руб.
                            <? } else { ?>
                                <?= number_format(ceil($arResult["ORDER_PRICE"]), 0, '', ' ') ?> руб.
                            <? } ?>
                        </div>
                    </div>
                    <? if (!empty($arResult['summary_profit'])) { ?>
                        <div class="paycheck_discount_box">
                            <div class="paycheck_discount_title paycheck_box_left">
                                <div class="paycheck_box_title">Выгода</div>
                            </div>
                            <div class="paycheck_discount_count paycheck_box_count order_discount_price"
                                 data-price="<?= ceil($arResult["summary_profit"]) ?>">
                                <?= number_format(ceil($arResult["summary_profit"]), 0, '', ' ') ?> руб.
                            </div>
                        </div>
                    <? } ?>
                    <div class="paycheck_delivery_block">
                        <div class="paycheck_delivery_title paycheck_box_left">
                            <div class="paycheck_box_title">Доставка</div>
                        </div>
                        <div class="paycheck_delivery_count paycheck_box_count order_delivery_price"
                             data-price="<?= ceil($arResult["DELIVERY_PRICE"]) ?>">
                            <? if (!empty($arResult['DELIVERY_PRICE'])) {
                                echo number_format(ceil($arResult["DELIVERY_PRICE"]), 0, '', ' ') . ' руб.';
                            } else {
                                echo '0 руб.';
                            } ?>
                        </div>
                    </div>
                    <div class="line_item"></div>
                    <div class="paycheck_summary_block">
                        <div class="paycheck_summary_title">Итого</div>
                        <div class="paycheck_summary_count order_summary_price"
                             data-price="<?= ceil($arResult["ORDER_PRICE"]) ?>">
                            <?= number_format(ceil($arResult["ORDER_PRICE"]), 0, '', ' ') ?> руб.
                        </div>
                    </div>
                    <div class="personal_data text_block">
                        Нажимая на кнопку, вы подтверждаете своё совершеннолетие, соглашаетесь на обработку персональных
                        данных в соответствии с
                        <a href="/personaldata/agree.php">Условиями</a>, а также с <a
                                href="/personaldata/">Политикой</a>
                    </div>
                </div>
                <? // второй чек промежуточный END?>

                <? // третий чек окончательный?>
                <div class="paycheck_product_box paycheck_confirm owlElement">
                    <div class="check_left_half">
                        <div class="order_number">Ваш заказ №</div>
                        <div class="expert_block">
                            <div class="expert_foto">
                                <img src="" alt="">
                                <!--                            <img src="/bitrix/components/mainpage/basket/image/Oxana_160.png" alt="">-->
                            </div>
                            <div class="expert_info">
                                <div class="expert_title">Ваш эксперт</div>
                                <div class="expert_name"></div>
                            </div>
                        </div>
                    </div>

                    <div class="check_right_half">
                        <div class="product_box_header">
                            <div class="product_box_left paycheck_box_left">
                                <div class="product_title paycheck_box_title">Товары</div>
                                <div class="product_count paycheck_box_description"><?= $arResult["count_poducts"] ?>
                                    шт.
                                </div>
                            </div>
                            <div class="price_box_right paycheck_box_count">
                                <? if (!empty($arResult['summary_profit'])) { ?>
                                    <?= number_format(ceil($arResult["summary_old_price"]), 0, '', ' ') ?> руб.
                                <? } else { ?>
                                    <?= number_format(ceil($arResult["ORDER_PRICE"]), 0, '', ' ') ?> руб.
                                <? } ?>
                            </div>
                        </div>
                        <? if (!empty($arResult['summary_profit'])) { ?>
                            <div class="paycheck_discount_box">
                                <div class="paycheck_discount_title paycheck_box_left">
                                    <div class="paycheck_box_title">Выгода</div>
                                </div>
                                <div class="paycheck_discount_count paycheck_box_count">
                                    <?= number_format(ceil($arResult["summary_profit"]), 0, '', ' ') ?> руб.
                                </div>
                            </div>
                        <? } ?>
                        <div class="paycheck_delivery_block">
                            <div class="paycheck_delivery_title paycheck_box_left">
                                <div class="paycheck_box_title">Доставка</div>
                            </div>
                            <div class="paycheck_delivery_count paycheck_box_count"><? if (!empty($arResult['DELIVERY_PRICE'])) {
                                    echo number_format(ceil($arResult["DELIVERY_PRICE"]), 0, '', ' ') . ' руб.';
                                } else {
                                    echo '0 руб.';
                                } ?>
                            </div>
                        </div>
                        <div class="line_item"></div>
                        <div class="paycheck_summary_block">
                            <div class="paycheck_summary_title">Итого</div>
                            <div class="paycheck_summary_count">
                                <?= number_format(ceil($arResult["ORDER_PRICE"]), 0, '', ' ') ?> руб.
                            </div>
                        </div>
                    </div>
                </div>
                <? // третий чек окончательный END?>
            </div>
        </div>
    </div>
<? } else { ?>
    <div class="empty_basket_info">Ваша корзина пуста</div>
    <a class="empty_basket_btn basket_btn" href="/">Начать покупки</a>
<? } ?>

<? //крутилка загрузки?>
<div id="spiner_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
    </div>
</div>


<? $APPLICATION->AddHeadScript("/bitrix/components/mainpage/basket/script.min.js"); ?>

