<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

// BEGIN Замена #ВГОРОДЕ# на региональные значения (КВ)
switch ($_SERVER['SERVER_NAME']) {
    case "xn--90aedc4atap.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Белгороде'; //Белгород
        break;
    case "xn--b1agd0aean.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Воронеже'; //Воронеж
        break;
    case "xn--80acgfbsl1azdqr.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Екатеринбурге'; //Екатеринбург
        break;
    case "xn--80aauks4g.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Казани'; //Казань
        break;
    case "xn--j1aarei.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Курске'; //Курск
        break;
    case "xn--e1afhbv7b.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Липецке'; //Липецк
        break;
    case "xn----7sbdqaabf2clfe5a7hpcg.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Набережных Челнах'; //Наберебжные Челны
        break;
    case "xn-----7kcgn5cdbagnnnx.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Ростове-на-Дону'; //Ростов-на-Дону
        break;
    case "xn--80avue.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Туле'; //Тула
        break;
    case "xn--e1aner7ci.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Тюмени'; //Тюмень
        break;
    case "xn--k1afg2e.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Орле'; //Орёл
        break;
    case "xn--80adxhks.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Москве'; //Москва
        break;
    case "xn--80antj7do.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Рязани'; //Рязань
        break;
    case "xn--90absbknhbvge.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Новосибирске'; //Новосибирск
        break;
    case "xn----7sbeiia6axumbcqds.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Санкт-Петербурге'; //Санкт-Петербург
        break;
    case "xn----dtbdeglbi6acdmca3a.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Нижнем Новгороде'; //Нижний Новгород
        break;
    case "xn--80aaa0cvac.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Самаре'; //Самара
        break;
    case "xn--80aalwqglfe.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Краснодаре'; //Краснодар
        break;
    case "xn--80a1bd.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Уфе'; //Уфа
        break;
    case "xn--e1aohf5d.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Перми'; //Пермь
        break;
    case "xn--80addag2buct.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Волгограде'; //Волгоград
        break;
    case "xn--h1aeawgfg.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Иркутске'; //Иркутск
        break;
    case "xn--b1afaslnbn.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Кемерово'; //Кемерово
        break;
    case "xn--80aacf4bwnk3a.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Хабаровске'; //Хабаровск
        break;
    case "xn--80atblfjdfd2l.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Красноярске'; //Красноярск
        break;
    case "xn--90asilg6f.xn--24-6kcazf3bybfa8i.xn--p1ai":
        $v_regione = ' в Брянске'; //Брянск
        break;
    default:
        $v_regione = '';
}

?>
<? $APPLICATION->SetAdditionalCSS("/bitrix/templates/elektro_flat/tooltipster-master/css/tooltipster.css"); ?>
<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/components/bitrix/catalog/.default/bitrix/catalog.element/new_design/style.css"); ?>

<script type="text/javascript"
        src="/bitrix/templates/elektro_flat/tooltipster-master/js/jquery.tooltipster.min.js"></script>

<script>
    $(document).ready(function () {
        $('.tooltipza').tooltipster();
    });
</script>

<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function () {
        $("#accessories-from").appendTo("#accessories-to").css({"display": "block"});
        $("#catalog-reviews-from").appendTo("#catalog-reviews-to").css({"display": "block"});
        $(".add2basket_form").submit(function () {
            var form = $(this);

            imageItem = form.find(".item_image").attr("value");
            $("#addItemInCart .item_image_full").html(imageItem);

            titleItem = form.find(".item_title").attr("value");
            $("#addItemInCart .item_title").text(titleItem);

            var ModalName = $("#addItemInCart");
            CentriredModalWindow(ModalName);
            OpenModalWindow(ModalName);

            $.post($(this).attr("action"), $(this).serialize(), function (data) {
                try {
                    $.post("/ajax/basket_line.php", function (data) {
                        $("#cart_line").replaceWith(data);
                    });
                    $.post("/ajax/delay_line.php", function (data) {
                        $("#delay").replaceWith(data);
                    });
                    form.children(".btn_buy").addClass("hidden");
                    form.children(".result").removeClass("hidden");
                } catch (e) {
                }
            });
            document.location.href = '/personal/cart/';
            return false;
        });
        $(function () {
            $("div.catalog-detail-pictures a").fancybox({
                "transitionIn": "elastic",
                "transitionOut": "elastic",
                "speedIn": 600,
                "speedOut": 200,
                "overlayShow": false,
                "cyclic": true,
                "padding": 20,
                "titlePosition": "over",
                "onComplete": function () {
                    $("#fancybox-title").css({"top": "100%", "bottom": "auto"});
                    $("#fancybox-inner").css("overflow", "hidden");
                }
            });
        });

    });
    //]]>
</script>

<? $strMainID = $this->GetEditAreaId($arResult["ID"]);
$arItemIDs = array(
    "ID" => $strMainID,
    "PICT" => $strMainID . "_picture",
    "PRICE" => $strMainID . "_price",
    "BUY" => $strMainID . "_buy",
    "DELAY" => $strMainID . "_delay",
    "STORE" => $strMainID . "_store",
    "PROP_DIV" => $strMainID . "_skudiv",
    "PROP" => $strMainID . "_prop_",
    "SELECT_PROP_DIV" => $strMainID . "_propdiv",
    "SELECT_PROP" => $strMainID . "_select_prop_",
);
$strObName = "ob" . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData["JS_OBJ"] = $strObName;

$sticker = "";
if (array_key_exists("PROPERTIES", $arResult) && is_array($arResult["PROPERTIES"])) {
    if (array_key_exists("NEWPRODUCT", $arResult["PROPERTIES"]) && !$arResult["PROPERTIES"]["NEWPRODUCT"]["VALUE"] == false) {
        $sticker .= "<span class='new'>" . GetMessage("CATALOG_ELEMENT_NEWPRODUCT") . "</span>";
    }
    if (array_key_exists("SALELEADER", $arResult["PROPERTIES"]) && !$arResult["PROPERTIES"]["SALELEADER"]["VALUE"] == false) {
        $sticker .= "<span class='hit'>" . GetMessage("CATALOG_ELEMENT_SALELEADER") . "</span>";
    }
    if (array_key_exists("DISCOUNT", $arResult["PROPERTIES"]) && !$arResult["PROPERTIES"]["DISCOUNT"]["VALUE"] == false) {
        if (isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])) {

        } else {
            if ($arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] > 0) {
                $sticker .= "<span class='discount'>-" . $arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] . "%</span>";
            } else {
                $sticker .= "<span class='discount'>%</span>";
            }
        }
    }
} ?>
<? global $h1, $arr, $seotop; ?>
<div id="<?= $arItemIDs['ID'] ?>" class="catalog-detail-element" itemscope itemtype="http://schema.org/Product">
    <meta content="<?= $arResult['NAME'] ?>" itemprop="name"/>
    <meta content="<?= $arResult['NAME'] ?>" property="og:title"/>

    <div class="catalog-detail">
        <div class="left_panel">
            <script>
                $(document).ready(function () {
                    // задание переменной для автопрокрутки слайдеров
                    var autoplayTime = 3500;
                    $('#owl1').owlCarousel({
                        mouseDrag: true,
                        touchDrag: true,
                        singleItem: true,
                        navigation: true,
                        navigationText: ["", ""],
                    });

                    $('#owl2').owlCarousel({
                        autoPlay: autoplayTime, // задано переменной
                        mouseDrag: true,
                        touchDrag: true,
                        itemsTablet: [768, 4],
                        itemsTabletSmall: [425, 3],
                        itemsMobile : [350,2],
                        navigation: true,
                        navigationText: ["", ""],
                    });

                    // обработка событий слайдера
                    var owl1 = $("#owl1").data('owlCarousel');
                    var owl2 = $("#owl2").data('owlCarousel');
                    $('#owl1').find('.button-next').click(function () {
                        $('#owl1').trigger('owl.next');
                        owl1.stop();
                        owl2.stop();
                    });
                    $('#owl1').find('.button-prev').click(function () {
                        $('#owl1').trigger('owl.prev');
                        owl1.stop();
                        owl2.stop();
                    });

                    $('#owl2').find('.button-next').click(function () {
                        $('#owl2').trigger('owl.next');
                        owl1.stop();
                        owl2.stop();
                    });
                    $('#owl2').find('.button-prev').click(function () {
                        $('#owl2').trigger('owl.prev');
                        owl1.stop();
                        owl2.stop();
                    });
                    $('#owl2').find('.owlElement').click(function () {
                        owl1.goTo($(this).attr('data-photo'));
                        owl1.stop();
                    });

                });
            </script>
            <?$more_photo = [];?>
            <? // создаем массив с фотографиями?>
            <? if (isset($arResult["MORE_PHOTO"]) && !empty($arResult["MORE_PHOTO"])) { ?>
                <? $more_photo = $arResult["MORE_PHOTO"]; ?>
            <? } ?>

            <? // добавляем главную картинку?>
            <? if (isset($arResult["DETAIL_IMG"]) && !empty($arResult["DETAIL_IMG"])) { ?>
                <? array_unshift($more_photo, $arResult["DETAIL_IMG"]) ?>
            <? } else { ?>

                <? // случай, когда картинок нет?>
                <? if (!isset($more_photo) && empty($more_photo)) { ?>
                    <? $url = SITE_TEMPLATE_PATH . "/images/no-photo.jpg"; ?>
                    <? $more_photo = [
                        array("SRC" => $url)
                    ] ?>
                <? } ?>
            <? } ?>
            <? // записываем в массив вывода картинок видео?>
            <? if (!empty($arResult["PROPERTIES"]["video_new"]["~VALUE"])) { ?>
                <? foreach ($arResult["PROPERTIES"]["video_new"]["~VALUE"] as $video_link) { ?>
                    <? $vCode = preg_replace("/^.*\"https:\/\/www\.youtube\.com\/embed\/([a-zA-Z0-9_\-]+)\".*$/", "$1", $video_link["TEXT"]); ?>
                    <? $array_video = [
                        "vCode" => $vCode
                    ] ?>
                    <? array_unshift($more_photo, $array_video) ?>
                <? } ?>
            <? } ?>
            <? // верхний слайдер?>
            <div id="slaider1">
                <div id="owl1" class="owl-carousel-slider">
                    <? foreach ($more_photo as $arPhoto) { ?>
                        <? if ($arPhoto["vCode"]) { ?>
                            <div class="owlElement">
                                <div class="video-responsive-block" id="video1" style="background-image: url('//img.youtube.com/vi/<?= $arPhoto["vCode"] ?>/maxresdefault.jpg')">
                                    <div class="button_play_video video-button" data-ytID="<?= $arPhoto["vCode"] ?>" data-target="video1">
                                        <div class="img_youtube"></div>
                                    </div>
                                    <div class="video-preview"></div>
                                </div>
                            </div>
                        <? } else { ?>
                            <div class="owlElement">
                                <div class="panel_img" style="background-image: url('<?= $arPhoto["SRC"] ?>')">
                                </div>
                            </div>
                        <? } ?>
                    <? } ?>
                </div>
            </div>

            <? // нижний слайдер?>
            <div id="owl2" class="owl-carousel-slider">
                <? $i = 0;
                foreach ($more_photo as $arPhoto) { ?>
                    <? if ($arPhoto["vCode"]) { ?>
                        <div class="owlElement" data-photo="<?= $i++ ?>">
                            <div class="panel_img"
                                 style="background-image: url('//img.youtube.com/vi/<?= $arPhoto["vCode"] ?>/hqdefault.jpg');">
                                <div class="img_youtube"></div>
                            </div>
                        </div>
                    <? } else { ?>
                        <div class="owlElement" data-photo="<?= $i++ ?>">
                            <div class="panel_img" style="background-image: url('<?= $arPhoto["SRC"] ?>')">
                            </div>
                        </div>
                    <? } ?>
                <? } ?>
            </div>

            <? $array_section = [
                GetMessage("CATALOG_ELEMENT_FULL_DESCRIPTION"),
                'Характеристики',
                'Отзывы',
                'Статьи'
            ]; ?>

            <?// забота с описанием, отзывами и т.п. ?>
            <script>
                $(document).ready(function () {
                    $('.description_item').click(function () {
                        var box = '#' + $(this).attr('data-text');
                        $('.description_item').removeClass('active');
                        $(this).addClass('active');
                        $('.description_box').hide();
                        $(box).show();
                    })
                });
            </script>

            <ul class="tabs_section" data-tabgroup="first-tab-group">
                <? $i = 1;
                foreach ($array_section as $item) { ?>
                    <li class="description_item <? if ($i == 1) {
                        echo 'active';
                    } ?>" data-text="Dtab<?= $i++ ?>"><a><span><?= $item ?></span></a></li>
                <? } ?>
            </ul>
            <section id="first-tab-group" class="tabgroup">
                    <div class="description_box" id="Dtab1" style="display: block;">
                        <div class="description">
                            <?
                            $text = str_replace('#ВГОРОДЕ#', $v_regione, htmlspecialcharsBack($arResult["DETAIL_TEXT"]));
                            //mb_regex_encoding("UTF-8");
                            //$text = preg_replace('/<(h[1-6]{1})>(.*)<\/h[1-6]{1}>/i', "<div class='$1'>$2</div>", $text);
                            echo $text;
                            ?>
                        </div>
                    </div>
                    <div class="description_box" id="Dtab2">
                        <div class="tab_properties">
                            <? foreach ($arResult["DISPLAY_PROPERTIES"] as $k => $v): ?>
                                <div class="catalog-detail-property">
                                    <span class="name"><?= $v["NAME"] ?></span>
                                    <span class="val"><?= is_array($v["DISPLAY_VALUE"]) ? implode(", ", $v["DISPLAY_VALUE"]) : $v["DISPLAY_VALUE"]; ?></span>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>

                    <div class="description_box" id="Dtab3">
                        <!-- BEGIN пользовательские комментарии '<?= $arItemIDs['ID'] ?>' -->
                        <div class="section">
                            <? // cackle.comments
                            $APPLICATION->IncludeComponent("cackle.comments", ".default",
                                array("CHANNEL_ID" => $arResult['ID']), false);?>
                        </div>
                        <!-- END пользовательские комментарии -->
                    </div>
                    <div class="description_box" id="Dtab4">
                    </div>
                </section>

            <div class="clr"></div>

            <?// работа с картами?>
            <?global $LOCATION_CITY_NAME?>
<!--            --><?//$LOCATION_CITY_NAME='Санкт-Петербург';?>
            <?
            $Iblock_city = 53;
            $Iblock_shops = 54;
            ?>
            <?if($_SERVER['SERVER_NAME'] == 'm24.ru') {
                $Iblock_city = 57;
                $Iblock_shops = 56;
            }?>
            <?
            // определяем ID города
            $res_city = CIBlockElement::GetList(
                    Array(),
                    Array("IBLOCK_ID"=>$Iblock_city, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "NAME"=> $LOCATION_CITY_NAME),
                    false,
                    false,
                    array(
                        "ID",
                        "PROPERTY_geo",
                        "PROPERTY_zoom"));
            while($ob = $res_city->GetNextElement())
            {
                $city_ID = $ob->GetFields();
            }

            // заполняем координаты и масштаб для города
            $geo = explode (',', $city_ID["PROPERTY_GEO_VALUE"]);
            $map_marker = array(
                'yandex_lat' => str_replace(' ', '', $geo[0]),
                'yandex_lon' => str_replace(' ', '', $geo[1]),
                'yandex_scale' => $city_ID["PROPERTY_ZOOM_VALUE"],
                'PLACEMARKS' => [],
            );

            // выбираем магазины по ID бренда и ID города
            $res_shops = CIBlockElement::GetList(
                    Array(),
                    Array("IBLOCK_ID"=>$Iblock_shops, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_city" => $city_ID["ID"], "PROPERTY_brand" => $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"]),
                    false,
                    false,
                    array("NAME",
                        "PROPERTY_geo",// координаты
                        "PROPERTY_phone",// телефон
                    ));
            while($ob = $res_shops->GetNextElement())
            {
                $shops_m24 = $ob->GetFields();
                $geoshops = explode (',', $shops_m24["PROPERTY_GEO_VALUE"]);
                $array_place = [
                    'TEXT' => $shops_m24["NAME"]."###RN###".$shops_m24["PROPERTY_PHONE_VALUE"],
                    'LON' => str_replace(' ', '', $geoshops[1]),
                    'LAT' => str_replace(' ', '', $geoshops[0]),
                ];
                array_push($map_marker['PLACEMARKS'], $array_place);
            }
            ?>
            <div class="shops_on_the_map" id="where_to_buy">
                <?
//                $map_marker_test = serialize(array(
//                    'yandex_lat' => '55.810253502547646',
//                    'yandex_lon' => '37.54095120504298',
//                    'yandex_scale' => 10,
//                    'PLACEMARKS' => array (
//                        array(
//                            'TEXT' =>'ТК "ТВОЙ ДОМ"###RN###8 (800) 555 26 34',
//                            'LON' => '37.553276',
//                            'LAT' => '55.670203',
//                        ),
//                        array(
//                            'TEXT' =>'ТК "ТВОЙ ДОМ"###RN###8 (800) 555 26 34',
//                            'LON' => '37.724057',
//                            'LAT' => '55.610969',
//                        ),
//                    ),
//                ));
                ?>
                <?$map_marker=serialize($map_marker);?>
                <span>Наличие в магазинах в городе <?=$LOCATION_CITY_NAME?></span>
                <? $APPLICATION->IncludeComponent("bitrix:map.yandex.view",
                    ".default", array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "CONTROLS" => array(
                            0 => "SCALELINE",
                            1 => "ZOOM",
                            2 => "MINIMAP",
                        ),
                        "INIT_MAP_TYPE" => "MAP",
                        "MAP_DATA" => $map_marker,
                        "MAP_HEIGHT" => "400",
//                        "MAP_ID" => "yam_1",
                        "MAP_WIDTH" => "100%",
                        "OPTIONS" => array(
                            0 => "ENABLE_DRAGGING",
                        )
                    )
                );
                ?>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                // верхние отступы для для хлебных крошек 1224
                if (screen.width <= 1254 && screen.width > 768){
                    var h1_height = $('.h1_bread_cont h1').height() + 20;
                    var breadcrumb_height = $('.h1_bread_cont #breadcrumb').height() + 20;
                    var margin_slider = $('#slaider1').css('margin-left') + 50;
                    $('#slaider1').css('margin-top', breadcrumb_height+'px');
                    $('#owl1').css('padding-top', h1_height+'px');
                    $('.h1_bread_cont').css('margin-left', parseInt(margin_slider)+ 55 + 'px');
                }
                // верхние отступы для слайдера и правой панели с ценниками для 768
                if (screen.width <= 768 && screen.width > 425){
                    var h1_height = $('.h1_bread_cont h1').height() + 20;
                    var breadcrumb_height = $('.h1_bread_cont #breadcrumb').height() + 20;
                    var right_height = $('.right_panel').height() + 70;
                    var slider1_height = $('#owl1').height() + 20;
                    var slider2_height = $('#owl2').height()+ 30;
                    var right_top_sum =slider1_height+slider2_height+h1_height+breadcrumb_height;
                    $('.right_panel').css('top', right_top_sum);
                    $('.tabs_section').css('margin-top', right_height+'px');
                    $('#slaider1').css('margin-top', breadcrumb_height+'px');
                    $('#owl1').css('padding-top', h1_height+'px');
                }
                // верхние отступы для слайдера и правой панели с ценниками для 425
                if (screen.width <= 425 ){
                    var right_height = $('.right_panel').height() + 30;
                    var slider1_height = $('#owl1').height() + 20;
                    var slider2_height = $('#owl2').height()+ 10;
                    var right_top_sum =slider1_height+slider2_height;
                    console.log('slider1_height', slider1_height, 'slider2_height', slider2_height, 'right_top_sum', right_top_sum, 'right_height', right_height);
                    $('.right_panel').css('top', right_top_sum);
                    $('.tabs_section').css('margin-top', right_height+'px');
                    console.log('margin', $('.tabs_section').css('margin-top'));
                }
                $('.tabs_section').css('height', $('.tabs_section .description_item ').height()+6+'px');
            });
        </script>

        <div class="right_panel">
            <div class="wrapper">
                <div class="shadow_wrapper">
                    <? // цены и значки (кроме кнопок)?>
                    <div class="price_container" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <? // старая цена?>
                        <div class="catalog-detail-item-price-old">
                            <? $discount_value = $arResult["PRICES"]["BASE"]["VALUE"] - $arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]; ?>
                            <? if ($discount_value > 0) { ?>
                                <span>Старая цена:</span>
                                <div class="old_price_cont"><?= number_format($arResult["PRICES"]["BASE"]["VALUE"], 0, '', ' '); ?>,-
                                </div>
                            <? } ?>
                        </div>

                        <? // стоимость товара?>
                        <div class="catalog-detail-item-price">
                            <? if ($discount_value > 0) { ?>
                                <div>
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/components/bitrix/catalog/.default/bitrix/catalog.element/new_design/sale.png"
                                         alt="">
                                    <div class="price_cont"><?= number_format($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, '', ' '); ?>,-
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <div class="credit_payment">
                                    <?= number_format(ceil(intval($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"], 10) / 12 / 100) * 100, 0, '', ' '); ?>
                                    руб/мес. в кредит
                                </div>
                            <? } else { ?>
                                <div class="price_cont"><?= number_format($arResult["PRICES"]["BASE"]["VALUE"], 0, '', ' '); ?>
                                    ,-
                                </div>
                                <div class="credit_payment">
                                    <?= number_format(ceil(intval($arResult["PRICES"]["BASE"]["VALUE"], 10) / 12 / 100) * 100, 0, '', ' '); ?>
                                    руб/мес. в кредит
                                </div>
                            <? } ?>
                        </div>

                        <? // строка наличие и магазины?>
                        <div id="block_avl_shops">
                            <? // наличие?>
                            <div class="available">
                                <? if ($arResult["CAN_BUY"]): ?>
                                    <meta content="InStock" itemprop="availability"/>
                                    <div class="avl">
                                        <i class="fa fa-check-circle"></i>
                                        <span><?= GetMessage("CATALOG_ELEMENT_AVAILABLE") ?></span>
                                    </div>
                                <? elseif (!$arResult["CAN_BUY"]): ?>
                                    <meta content="OutOfStock" itemprop="availability"/>
                                    <div class="not_avl">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        <span><?= GetMessage("CATALOG_ELEMENT_UNDER_THE_ORDER") ?></span>
                                    </div>
                                <? endif; ?>
                            </div>
                            <? // где посмотреть?>
                                <div class="shops">
                                    <a href="#where_to_buy">
                                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                                        <span>где посмотреть</span>
                                    </a>
                                </div>
                            <div class="clr"></div>
                        </div>
                    </div>

                    <? // кнопки корзина, кредит, сравнить для товара в наличии?>
                    <div class="button_cont_m24">
                        <? if ($arResult["CAN_BUY"]): ?>
                            <form action="<?= SITE_DIR ?>ajax/add2basket.php" class="add2basket_form"
                                  id="add2basket_form_<?= $arResult['ID'] ?>">

                                <input type="hidden" name="ID" class="id" value="<?= $arResult['ID'] ?>"/>
                                <? if (!empty($arResult["SELECT_PROPS"])): ?>
                                    <input type="hidden" name="SELECT_PROPS"
                                           id="select_props_<?= $arResult['ID'] ?>" value=""/>
                                <? endif; ?>
                                <input type="hidden" name="item_image" class="item_image"
                                       value="&lt;img class='item_image' src='<?= $arResult["PREVIEW_IMG"]["SRC"] ?>' alt='<?= $arResult["NAME"] ?>'/&gt;"/>
                                <input type="hidden" name="item_title" class="item_title" value="<?= $arResult['NAME'] ?>"/>
                                <button type="submit" name="add2basket" class="btn_buy btn_m24 detail add_basket"
                                        value="<?= GetMessage('CATALOG_ELEMENT_ADD_TO_CART') ?>">
                                    <?= GetMessage('CATALOG_ELEMENT_ADD_TO_CART') ?><i class="fa fa-cart-plus"></i>
                                </button>
                                <button name="boc_anch" id="boc_anch_<?= $arResult['ID'] ?>"
                                        class="btn_buy btn_m24 boc_anch"
                                        value="<?= GetMessage('CATALOG_ELEMENT_BOC') ?>"><?= GetMessage('CATALOG_ELEMENT_BOC') ?></button>
                                <? $APPLICATION->IncludeComponent("altop:buy.one.click", ".default",
                                    array(
                                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                        "ELEMENT_ID" => $arResult["ID"],
                                        "ELEMENT_PROPS" => "",
                                        "REQUIRED_ORDER_FIELDS" => array(
                                            0 => "NAME",
                                            1 => "TEL",
                                        ),
                                        "DEFAULT_PERSON_TYPE" => "1",
                                        "DEFAULT_DELIVERY" => "0",
                                        "DEFAULT_PAYMENT" => "0",
                                        "DEFAULT_CURRENCY" => "RUB",
                                        "BUY_MODE" => "ONE",
                                        "PRICE_ID" => "1",
                                        "DUPLICATE_LETTER_TO_EMAILS" => array(
                                            0 => "a",
                                        ),
                                    ),
                                    false
                                ); ?>
                                <div class="btn_float_cont_m24">
                                    <button class="compare btn_m24 compare_float catalog-item-compare"
                                            id="catalog_add2compare_link_<?=$arResult['ID']?>"
                                            onclick="return addToCompare('<?=$arResult["COMPARE_URL"]?>', 'catalog_add2compare_link_<?=$arResult["ID"]?>');"
                                            rel="nofollow"><span class="compare_text"><?=GetMessage('CATALOG_ELEMENT_ADD_TO_COMPARE')?></span></a>
                                    </button>
                                    <button type="submit" name="add2basket" class="btn_buy btn_m24 kupivkredit_btn"
                                            value="<?= GetMessage('CATALOG_ELEMENT_BUY_ON_CREDIT') ?>"><?= GetMessage('CATALOG_ELEMENT_BUY_ON_CREDIT') ?></button>
                                    <div class="clr"></div>
                                </div>
                                <div class="clr"></div>

                                <small class="result detail hidden"><i
                                            class="fa fa-check"></i><?= GetMessage('CATALOG_ELEMENT_ADDED') ?>
                                </small>
                            </form>

                            <? // кнопки заказать, сообщить о надличии, сравнить для отсутствующего товара ?>
                        <? else: ?>
                            <a class="btn_buy btn_m24 apuo_detail" id="order_anch_<?= $arResult['ID'] ?>"
                               href="javascript:void(0)" rel="nofollow"><i
                                        class="fa fa-clock-o"></i><?= GetMessage("CATALOG_ELEMENT_UNDER_ORDER") ?>
                            </a>
                            <? $APPLICATION->IncludeComponent("altop:ask.price", "order",
                                Array(
                                    "ELEMENT_ID" => $arResult["ID"],
                                    "ELEMENT_NAME" => $arResult["NAME"],
                                    "EMAIL_TO" => "",
                                    "REQUIRED_FIELDS" => array("NAME", "TEL", "TIME")
                                ),
                                false
                            ); ?>
                            <? $APPLICATION->IncludeComponent("bitrix:sale.notice.product", "",
                                array(
                                    "NOTIFY_ID" => $arResult["ID"],
                                    "NOTIFY_URL" => htmlspecialcharsback($arResult["SUBSCRIBE_URL"]),
                                    "NOTIFY_USE_CAPTHA" => "Y"
                                ),
                                false
                            ); ?>
                            <button class="compare  btn_m24 compare_one "><?= GetMessage('CATALOG_ELEMENT_ADD_TO_COMPARE') ?></button>
                        <? endif; ?>
                    </div>
                    <div class="clr"></div>
                </div>

            <? global $LOCATION_CITY_ID, $LOCATION_CITY_NAME; //echo $LOCATION_CITY_NAME;?>

            <? $APPLICATION->IncludeComponent("m24:deliveryblock", ".default",
                array(
                    "SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
                    "PRODUCT_PRICE" => $arPrice["VALUE"]
                )
                , false); ?>
            </div>
        </div>


        <? /*if(!empty($arResult["DISPLAY_PROPERTIES"])):?>
				<div class="catalog-detail-properties">
					<div class="h4"><?=GetMessage("CATALOG_ELEMENT_PROPERTIES")?></div>
					<?foreach($arResult["DISPLAY_PROPERTIES"] as $k => $v):?>
						<div class="catalog-detail-property">
							<span class="name"><?=$v["NAME"]?></span> 
							<span class="val"><?=is_array($v["DISPLAY_VALUE"]) ? implode(", ", $v["DISPLAY_VALUE"]) : $v["DISPLAY_VALUE"];?></span>
						</div>
					<?endforeach;?>
				</div>
			<?endif;*/ ?>
        <div class="clr"></div>
    </div>
</div>

<? if (isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])) {
    $arJSParams = array(
        "CONFIG" => array(
            "USE_CATALOG" => $arResult["CATALOG"],
        ),
        "PRODUCT_TYPE" => $arResult["CATALOG_TYPE"],
        "VISUAL" => array(
            "ID" => $arItemIDs["ID"],
            "PICT_ID" => $arItemIDs["PICT"],
            "PRICE_ID" => $arItemIDs["PRICE"],
            "BUY_ID" => $arItemIDs["BUY"],
            "DELAY_ID" => $arItemIDs["DELAY"],
            "STORE_ID" => $arItemIDs["STORE"],
            "TREE_ID" => $arItemIDs["PROP_DIV"],
            "TREE_ITEM_ID" => $arItemIDs["PROP"],
        ),
        "PRODUCT" => array(
            "ID" => $arResult["ID"],
            "NAME" => $arResult["~NAME"]
        ),
        "OFFERS" => $arResult["JS_OFFERS"],
        "OFFER_SELECTED" => $arResult["OFFERS_SELECTED"],
        "TREE_PROPS" => $arSkuProps
    );
} else {
    $arJSParams = array(
        "CONFIG" => array(
            "USE_CATALOG" => $arResult["CATALOG"]
        ),
        "PRODUCT_TYPE" => $arResult["CATALOG_TYPE"],
        "VISUAL" => array(
            "ID" => $arItemIDs["ID"],
        ),
        "PRODUCT" => array(
            "ID" => $arResult["ID"],
            "NAME" => $arResult["~NAME"]
        )
    );
}

if (isset($arResult["SELECT_PROPS"]) && !empty($arResult["SELECT_PROPS"])) {
    $arJSParams["VISUAL"]["SELECT_PROP_ID"] = $arItemIDs["SELECT_PROP_DIV"];
    $arJSParams["VISUAL"]["SELECT_PROP_ITEM_ID"] = $arItemIDs["SELECT_PROP"];
    $arJSParams["SELECT_PROPS"] = $arSelProps;
} ?>

<script type="text/javascript">
    var <?=$strObName;?> =
    new JCCatalogElement(<?=CUtil::PhpToJSObject($arJSParams, false, true);?>);
    BX.message({
        SITE_ID: "<?=SITE_ID;?>"
    });
</script>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" style="float:right;padding:5px 10px 0 0;z-index:1;position:relative;">&times;</button>
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>