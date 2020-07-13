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
}?>
<? global $LOCATION_CITY_ID, $LOCATION_CITY_NAME; //echo $LOCATION_CITY_NAME;?>
<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/components/bitrix/catalog/.default/bitrix/catalog.element/new_design/style.css"); ?>
<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/components/m24/catalog/.default/bitrix/catalog.element/new_design/functions.php", array(), array()); ?>

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

?>

<? global $h1, $arr, $seotop; ?>
<div id="<?= $arItemIDs['ID'] ?>" class="catalog-detail-element" itemscope itemtype="http://schema.org/Product">
    <meta content="<?= $arResult['NAME'] ?>" itemprop="name"/>
    <meta content="<?= strip_tags($arResult['PREVIEW_TEXT']) ?>" itemprop="description"/>
    <? /*<meta content="<?= $arResult['NAME'] ?>" property="og:title"/>*/ ?>

    <div class="catalog-detail" id="gtm_product_page">
        <div class="left_panel">

            <?$more_photo = [];?>
            <? // создаем массив с фотографиями?>
            <? if (isset($arResult["MORE_PHOTO"]) && !empty($arResult["MORE_PHOTO"])) { ?>
                <? $more_photo = $arResult["MORE_PHOTO"]; ?>
            <? } ?>

            <? // добавляем главную картинку?>
            <? if (isset($arResult["DETAIL_IMG"]) && !empty($arResult["DETAIL_IMG"])) { ?>
                <?$detail=array('SRC' => $arResult["DETAIL_IMG"]['SRC'], 'itemprop' => 'image' )?>
                <? array_unshift($more_photo, $detail) ?>
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
            <?
            $Iblock_videoreview = 64;
            if($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
                $Iblock_videoreview = 69;
            }
            $filter = Array("IBLOCK_ID"=>$Iblock_videoreview,
                "ACTIVE"=>"Y",
//                "!PROPERTY_Vblog_VALUE"=>"Y",
                "=PROPERTY_productID" => $arResult['ID']
            );
            $res = CIBlockElement::GetList(
                array("SORT"=>'DESC'),
                $filter,
                false,
                false,
                array());
            while($ob = $res->GetNextElement())
            {
                $response = $ob->GetFields();
                $response["PROPERTIES"] = $ob->GetProperties();
                $elem['IMG'] = CFile::GetPath($response["PREVIEW_PICTURE"]);
                $elem['vidID'] = $response["PROPERTIES"]["vidID"]["VALUE"];
                $elem['timeStart'] = $response["PROPERTIES"]["timeStart"]["VALUE"];
                $arVids[] = $elem;
            }
           ?>


            <div class="slider_box">
                <? // верхний слайдер?>
                <div id="slaider1">
                    <div id="product_slider_big" class="owl-carousel-slider">
                        <? foreach ($more_photo as $arPhoto) { ?>
                            <div class="owlElement">
                                <div class="panel_img" style="background-image: url('<?= $arPhoto["SRC"] ?>')" <?if(!empty($arPhoto["itemprop"])) echo 'itemprop="image"';?>>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <?// кнопка баннер - видеообзоры ?>
                    <?if(!empty($arVids)){
                        $video_banner_mini = '<img class="mini_banner_img video_banner_btn" src="/bitrix/templates/elektro_flat/components/m24/catalog/.default/bitrix/catalog.element/new_design/image/videoobzory_n.png">';
                    }?>
                    <div class="banner_mini_box">
                        <?=$video_banner_mini?>
                    </div>
                </div>
                <? // нижний слайдер?>
                <div id="owl2" class="owl-carousel-slider">
                    <? $i = 0;
                    foreach ($more_photo as $arPhoto) { ?>
                        <div class="owlElement" data-photo="<?= $i++ ?>">
                            <div class="panel_img" style="background-image: url('<?= $arPhoto["SRC"] ?>')">
                            </div>
                        </div>
                    <? } ?>
                </div>
                <?//массив стикеров?>
                <?$arSticker = array();
                //Рассрочка
                if($arResult['PROPERTIES']['credit_line']['VALUE'] =='Y' && $arResult["CAN_BUY"] && $arResult["PRICES"]["BASE"]["VALUE"]>10000){
                    $arSticker['sticker_credit'] = 'Рассрочка 0-0-12';
                }
                //Карта
                if($arResult['PROPERTIES']['ACQUIRING_AVAILABLE']['VALUE'] =='Y' && $arResult["CAN_BUY"]){
                    $arSticker['sticker_card'] = 'Оплата картой';
                    $arSticker['sticker_halva'] = 'Халва';
                }
                //скидка
                if(!empty($arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'])){
                    $arSticker['sticker_sale'] = 'Скидка -'.round($arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'],0).'%';
                } else {
                    ($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"]=='да') ? $arSticker['sticker_sale'] = 'Скидка' : '';
                }
                //Новинка
                ($arResult["PROPERTIES"]["NEWPRODUCT"]["VALUE"]=='да') ? $arSticker['sticker_new'] = 'Новинка' : '';
                //Хит
                ($arResult["PROPERTIES"]["SALELEADER"]["VALUE"]=='да') ? $arSticker['sticker_hit'] = 'Хит' : '';
                ?>
                <?if(!empty($arSticker)){?>
                    <div class="sticker_box">
                        <?//кнопка разворота стикеров?>
                        <?$sticker_unvisible = 'sticker_unvisible';?>
                        <div class="sticker_wrapper">
                            <?$count_item = 1;?>
                            <?foreach ($arSticker as $selector=>$title){?>
                                <div class="<?=$selector?> sticker_item <?if($count_item>1) { echo $sticker_unvisible; } ?>"><div class="sticker_grad"><span><?=$title?></span></div></div>
                                <?$count_item++;?>
                            <?}?>
                        </div>
                        <?if($count_item>2){?>
                            <div class="sticker_all_btn"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                        <?}?>
                    </div>
                <?}?>
            </div>

<!--            --><?//dd($_COOKIE['sticker_visible']);?>


            <? $array_section = [
                GetMessage("CATALOG_ELEMENT_FULL_DESCRIPTION"),
                'Характеристики',
                'Отзывы',
//                'Статьи'
            ];?>


            <?// массив с аналогами?>
            <?$arAnalog = $arResult['PROPERTIES']['analog']['VALUE'];
            if(empty($arAnalog) || $arResult["CAN_BUY"] == true){
                $arAnalog = array();
            }?>


            <ul class="tabs_section" data-tabgroup="first-tab-group">
                <?//аналоги на случай отсутствия на складе?>
                <?if(!empty($arAnalog)):?>
                    <?array_unshift($array_section,'Аналоги')?>
                <?endif;?>
                <?// Видео вкладка?>
                <?if (!empty($arVids)) {
                    array_push($array_section, 'Видео');
                }?>
                <?//вывод ?>
                <? $i = 1;
                foreach ($array_section as $item) { ?>
                    <li class="description_item <? if ($i == 1) {
                        echo 'active';
                    } ?>" data-text="Dtab<?= $i++ ?>"><a><span><?= $item ?></span></a></li>
                <? } ?>
            </ul>
            <section id="first-tab-group" class="tabgroup">
                <?$count_box = 1;?>
                <?//аналоги на случай отсутствия на складе?>
                <?if(!empty($arAnalog)):?>
                    <div class="description_box" id="Dtab<?=$count_box++?>" style="padding: auto;">
                        <h3 style="color: rgb(40,40,40); text-align: center; margin-top: 20px">Доступные аналоги</h3>
                        <? $APPLICATION->IncludeComponent("catalog.pages:page", "",
                            Array(
                                'analogs' => $arAnalog,
                                "AJAX_LOAD"=> 'N',
                                'Sort_field' => 'N'
                            ),
                            false,
                            Array()
                        ); ?>
                    </div>

                <?endif;?>
                     <?// Описание?>
                    <div class="description_box" id="Dtab<?=$count_box++?>">
                        <div class="description">
                            <?
                            $text = str_replace('#ВГОРОДЕ#', $v_regione, htmlspecialcharsBack($arResult["DETAIL_TEXT"]));
                            //mb_regex_encoding("UTF-8");
                            //$text = preg_replace('/<(h[1-6]{1})>(.*)<\/h[1-6]{1}>/i', "<div class='$1'>$2</div>", $text);
                            echo $text;
                            ?>
                        </div>
                    </div>
                     <?// ТТХ?>
                    <div class="description_box" id="Dtab<?=$count_box++?>">
                        <div class="tab_properties">
                            <? foreach ($arResult["DISPLAY_PROPERTIES"] as $k => $v): ?>
                                <div class="catalog-detail-property">
                                    <span class="name"><?= $v["NAME"] ?></span>
                                    <?$ttxValue = strip_tags($v["DISPLAY_VALUE"])?>
                                    <span class="val"><?= is_array($ttxValue) ? implode(", ", $ttxValue) : $ttxValue; ?></span>
                                </div>
                            <? endforeach; ?>
                            <div class="catalog-detail-property" style="font-weight: bold">
                                <span class="name"><?= $arResult['PROPERTIES']["VES_S_AKKUM"]['NAME'] ?></span>
                                <span class="val"><?= $arResult['PROPERTIES']["VES_S_AKKUM"]['VALUE'] ?></span>
                            </div>
                        </div>
                        <div class="attention_block_text">
                            <span>* </span>Цвет, ткань и форма массажных элементов могут быть изменены на усмотрение производителя
                        </div>
                    </div>

                    <?// Отзывы?>
                    <div class="description_box" id="Dtab<?=$count_box++?>">
                    </div>
                <?// Видео раздел
                if (!empty($arVids)) {?>
                    <div class="description_box" id="Dtab<?=$count_box++?>">
                        <? $APPLICATION->IncludeComponent("mainpage:videoreview", "",
                            Array("ID"=> $arResult['ID']),
                            false,
                            Array()
                        ); ?>
                        <div id="video_flag"></div>
                    </div>
                <?}?>


<!--                    --><?//// Статьи?>
<!--                    <div class="description_box" id="Dtab--><?//=$count_box++?><!--">-->
<!--                    </div>-->
                </section>
                
<!--                --><?// if($USER->IsAdmin()) { ?>
                <!-- Иконки функционал  -->
                <script>
                    function SaveHoverImage(code, img, cWidth, cHeight, /*oldColor,*/ newColor) {
                        var cnv = document.createElement("canvas");
                        cnv.width = cWidth;
                        cnv.height = cHeight;
                        var ctx = cnv.getContext("2d");
                        ctx.drawImage(img, 0, 0);
                        var imgData = ctx.getImageData(0, 0, cnv.width, cnv.height);
                        var data = imgData.data;
                        for(var x = 0, len = data.length; x < len; x += 4)
                        {
                            if((data[x] != 255) || (data[x + 1] != 255) || (data[x + 2] != 255))
                            {
                                data[x] = newColor[0];
                                data[x + 1] = newColor[1];
                                data[x + 2] = newColor[2];
                            }
                        }
                        ctx.putImageData(imgData, 0, 0);
                        localStorage.setItem(code, cnv.toDataURL("image/png"));
                        return cnv.toDataURL("image/png");
                    }
                    
                    $(document).ready(function(){
                        $('.m24-prop-icons-panel').find('img.active').mouseover(function(e){
                            var cImgSrc = $(this).attr('src'),
                                cWidth = $(this).width(),
                                cHeight = $(this).height(),
                                code = $(this).data('code');
                            //window.localStorage.removeItem(code);
                            if(!window.localStorage[code])
                            {
                                SaveHoverImage(code, this, cWidth, cHeight, /*[179, 180, 179],*/ [156, 194, 24]);
                            }
                            $(this).data('out', $(this).attr('src'));
                            $(this).attr('src', window.localStorage[code]);
                            
                        });
                        $('.m24-prop-icons-panel').find('img.active').mouseout(function(e){
                            var cImgSrc = $(this).attr('src');
                            $(this).attr('src', $(this).data('out'));
                        });
                        var propIconsCount = $('.m24-prop-icons-panel').find('img.active').toArray().length;
                        if(propIconsCount <= 0)
                        {
                            $('.m24-prop-icons-container').hide();
                        }
                        else if(propIconsCount < 10)
                        {
                            $('.m24-prop-icons-container').addClass('small');
                        }
                        else
                        {
                            $('.m24-prop-icons-container').addClass('full');
                        }
                    });
                </script>
                <style>
                    .m24-prop-icons-container
                    {
                        padding:10px;
                    }
                    .m24-prop-icons-container.full .m24-prop-icons-panel
                    {
                        width:100%;
                        margin-top:10px;
                        border:1px solid rgb(156, 194, 24);
                        border-radius:10px;
                        padding:3px;
                    }
                    .m24-prop-icons-container.small .m24-prop-icons-panel
                    {
                        width:168px;
                        padding:5px;
                        column-count:3;
                        column-gap:0;
                        display:inline-block;
                        vertical-align:top;
                    }
                    .m24-prop-icons-container.full .m24-prop-icons-panel img
                    {
                        margin:3px !important;
                        float:none !important;
                    }
                    .m24-prop-icons-container.small .m24-prop-icons-panel img
                    {
                        margin:8px !important;
                        float:none !important;
                    }
                    .m24-prop-icons-hint
                    {
                        color:rgb(156, 194, 24);
                        font-size:12px;
                        font-weight:400;
                        text-align:right;
                        padding-right:15px;
                        padding-bottom:10px;
                    }
                    .m24-prop-icons-container.small .m24-prop-icons-wrapper
                    {
                        width:100%;
                        margin-top:10px;
                        border:1px solid rgb(156, 194, 24);
                        border-radius:10px;
                        padding:5px;
                        text-align:center;
                    }
                    .m24-prop-icons-container.small .m24-prop-icons-bg
                    {
                        padding:0;
                        height:168px;
                        display:inline-block;
                        vertical-align:top;
                    }
                </style>
                <section class="m24-prop-icons-container">
                    <div style="font-size:2em;color:#333;font-weight:400;">Виды массажа</div>
                    <div class="m24-prop-icons-wrapper">
                        <div class="m24-prop-icons-bg">
                            <img src="<?=$arResult['IMAGE_TOOLTIP']['SRC']?>" width="<?=$arResult['IMAGE_TOOLTIP']['WIDTH']?>" height="<?=$arResult['IMAGE_TOOLTIP']['HEIGHT']?>" alt="" title="">
                        </div>
                        <div class="m24-prop-icons-panel"><?
                            $fCount = 0;
                            foreach($arResult['PROPERTIES'] as $key => $value)
                            {
                                if(!in_array($key, Array('P17', 'P18', 'P19', 'P20', 'P21', 'P22', 'P36', 'P37', 'P39'))) continue;
                                $fEnums = $value['VALUE_ENUM_ID'];
                                if(!empty($fEnums))
                                {
                                    foreach($fEnums as $i => $enum)
                                    {
                                        $fName = "/upload/pictovar/{$enum}.png";
                                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$fName))
                                        {
                                            $fCount++;
                                        ?><img width="36" height="36" data-code="pictovar-<?=$enum?>" class="tooltipza active" alt="<?=$arResult['PROPERTIES'][$key]['VALUE'][$i]?>" title="<?=$arResult['PROPERTIES'][$key]['VALUE'][$i]?>" src="<?=$fName?>"><?
                                        }
                                        else
                                        {
                                        ?><img style="display:none;" width="36" height="36" data-code="pictovar-<?=$enum?>" class="tooltipza inactive" alt="<?=$arResult['PROPERTIES'][$key]['VALUE'][$i]?>" title="<?=$arResult['PROPERTIES'][$key]['VALUE'][$i]?>"><?
                                        }
                                    }
                                }
                            }
                        ?></div>
                    </div>
                    <div class="m24-prop-icons-hint">*для получения подсказки наведите на иконку</div>
                </section>
                <!-- end Иконки функционал  -->
<!--                --><?// } ?>
            <div class="clr"></div>
            <?// Отзывы?>

            <? $APPLICATION->IncludeComponent(
                "m24:response",
                ".default",
                Array(
                    "PRODUCT_NAME" => $arResult['NAME'],
                    "PRODUCT_ID" => $arResult['ID'],
                    "BRAND_ID" => $arResult['PROPERTIES']['MANUFACTURER']['VALUE'],
                    "SECTION" => $arResult['SECTION']['NAME'],
                ),
                false
            );?>
            <?// блок с картами?>
            <?if($arResult["PRICES"]["BASE"]["VALUE"] - $arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"] > 0){
                $map_price=$arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"];
            } else {
                $map_price=$arResult["PRICES"]["BASE"]["VALUE"];
            }?>
            <? $APPLICATION->IncludeComponent(
                "mainpage:map_shop",
                ".default",
                Array(
                    "BRAND_ID" => $arResult['PROPERTIES']['MANUFACTURER']['VALUE'],
                    "CITY" => $LOCATION_CITY_NAME,
//                    "CITY" => "Москва",
                    "PRODUCT_ID" => $arResult['ID'],
                    "PRODUCT_NAME" => $arResult['NAME'],
                    "PRICE" => $map_price,
                ),
                false
            );?>
        </div>

        <div class="right_panel">
            <div class="wrapper">
                <div class="shadow_wrapper">
                    <? // цены и значки (кроме кнопок)?>
                    <div class="price_container" itemprop="offers" itemscope="itemscope" itemtype="http://schema.org/Offer">
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
                                    <div class="price_cont"><?= number_format($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, '', ' '); ?>,-
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <?$credit_payment=$arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>
                            <? } else { ?>
                                <div class="price_cont"><?= number_format($arResult["PRICES"]["BASE"]["VALUE"], 0, '', ' '); ?>
                                    ,-
                                </div>
                                <?$credit_payment=$arResult["PRICES"]["BASE"]["VALUE"]?>
                            <? } ?>
                            <?if(!empty($arSticker['sticker_credit'])){?>
                                <div class="credit_payment btn_click_add_basket_gtm" data-credit="Y">
                                    <?= number_format(ceil(intval($credit_payment, 10) / 4 / 100) * 100, 0, '', ' '); ?>
                                    руб/мес. в рассрочку
                                </div>
                            <?}?>
                        </div>
                        <meta itemprop="price" content="<?=$credit_payment?>">
                        <meta itemprop="priceCurrency" content="RUB">
                        <? // строка наличие и магазины?>
                        <div id="block_avl_shops">
                            <? // наличие?>
                            <div class="available">
                                <? if ($arResult["CAN_BUY"]): ?>
<!--                                    <meta content="InStock" itemprop="availability"/>-->
                                    <link itemprop="availability" href="http://schema.org/InStock">
                                    <div class="avl">
                                        <i class="fa fa-check-circle"></i>
                                        <span><?= GetMessage("CATALOG_ELEMENT_AVAILABLE") ?></span>
                                    </div>
                                <? elseif (!$arResult["CAN_BUY"]): ?>
<!--                                    <meta content="OutOfStock" itemprop="availability"/>-->
                                    <link itemprop="availability" href="http://schema.org/OutOfStock">
                                    <div class="not_avl">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        <span><?= GetMessage("CATALOG_ELEMENT_UNDER_THE_ORDER") ?></span>
                                    </div>
                                <? endif; ?>
                            </div>
                            <? // где посмотреть?>
                            <a href="#where_to_buy">
                                <div class="shops">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                    <span>где посмотреть</span>
                                </div>
                            </a>
                            <div class="clr"></div>
                        </div>
                    </div>

                    <? // кнопки корзина, кредит, сравнить для товара в наличии?>
                    <div class="button_cont_m24">
                        <? if ($arResult["CAN_BUY"]): ?>
                            <?//новая кнопка в корзину?>
                            <div class="add_basket_box">
                                <div class="btn_buy btn_m24 detail add_basket_btn btn_click_add_basket_gtm" data-product="<?= $arResult['ID'] ?>">В корзину <i class="fa fa-cart-plus"></i></div>
                                <button name="boc_anch" id="boc_anch_<?= $arResult['ID'] ?>"
                                        class="btn_buy btn_m24 boc_anch"
                                        value="<?= GetMessage('CATALOG_ELEMENT_BOC') ?>"><?= GetMessage('CATALOG_ELEMENT_BOC') ?></button>
                            </div>



                                <? $APPLICATION->IncludeComponent("m24:buy.one.click", ".default",
                                    array(
                                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                        "ELEMENT_ID" => $arResult["ID"],
                                        "PRICE" => $credit_payment,
                                        "PREVIEW_PICTURE" => $arResult["PREVIEW_PICTURE"]['SRC'],
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
                                    false,
                                array()
                                ); ?>

                                    
                                <div class="btn_float_cont_m24">
                                    
                                <?if(!isset($_SESSION['CATALOG_COMPARE_LIST'][$arParams['IBLOCK_ID']]['ITEMS'][$arResult['ID']])):
                                        $cMode = 'add';
                                        $cTitle = 'Сравнить';
                                    else:
                                        $cMode = 'delete';
                                        $cTitle = '<span class="fa fa-check"></span>';
                                    endif;
                                    ?>
                                        <button href="javascript:void(0)" data-mode="<?=$cMode?>" data-product="<?=$arResult["ID"]?>" class="compare btn_m24 compare_float catalog-item-compare" id="catalog_add2compare_link_<?=$arResult['ID']?>" title="<?=GetMessage('CATALOG_ELEMENT_ADD_TO_COMPARE')?>" rel="nofollow"><?=$cTitle?></button>



                                </div>
                                <div class="clr"></div>

                                <small class="result detail hidden"><i
                                            class="fa fa-check"></i><?= GetMessage('CATALOG_ELEMENT_ADDED') ?>
                                </small>


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
                                    "PRICE" => $credit_payment,
                                    "EMAIL_TO" => "",
                                    "REQUIRED_FIELDS" => array("NAME", "TEL", "TIME")
                                ),
                                false
                            ); ?>
<!--                            --><?// $APPLICATION->IncludeComponent("bitrix:sale.notice.product", "",
//                                array(
//                                    "NOTIFY_ID" => $arResult["ID"],
//                                    "NOTIFY_URL" => htmlspecialcharsback($arResult["SUBSCRIBE_URL"]),
//                                    "NOTIFY_USE_CAPTHA" => "Y"
//                                ),
//                                false
//                            ); ?>
                            <button class="compare btn_m24 compare_one "><?= GetMessage('CATALOG_ELEMENT_ADD_TO_COMPARE') ?></button>
                        <? endif; ?>
                    </div>
                    <div class="clr"></div>
                </div>

                <?// баннер - оплата картой?>
                <?if(!empty($arSticker['sticker_card'])){?>
                    <img class="card_pay_btn add_basket_btn btn_click_add_basket_gtm" data-product="'.$arResult['ID'].'" src="/bitrix/templates/elektro_flat/components/m24/catalog/.default/bitrix/catalog.element/new_design/image/online_banking_n.png">

                <?}?>
                <?//доставка?>
                <? $APPLICATION->IncludeComponent("m24:deliveryblock", ".default",
                array(
                    "SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
                    "PRODUCT_PRICE" => $arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]
                )
                , false); ?>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <?// вместилище для маленького баннера?>
            <div class="small_banner_container">
                <?//баннеры?>
                <?//dd($arResult)?>
                <? $APPLICATION->IncludeComponent(
                    "mainpage:banners.new",
                    ".default",
                    Array(
                        "SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
                        "product_ID" => $arResult['ID'],
                    ),
                    false
                );?>
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
    <input type="hidden" value="<?= $arResult['ID'] ?>" class="gtm-product-id">
    <input type="hidden" value="<?= $credit_payment ?>" class="gtm-product-price">
    <input type="hidden" value="<?= $arResult['NAME'] ?>" class="gtm-product-name">
    <input type="hidden" value="<?= $arResult['SECTION']['NAME'] ?>" class="gtm-category-name">
    <input type="hidden" value="<?= $arResult['SECTION']['PATH'][0]['ID'] ?>" class="gtm-category-id">
    <input type="hidden" value="<?=$arResult['PROPERTIES']['MANUFACTURER']['NAME']?>" class="gtm-brand-name">
    <input type="hidden" value="product" class="gtm-page-type">

<!--    --><?//dd($arResult['PROPERTIES']['MANUFACTURER'])?>

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




<script>
    window.dataLayer = window.dataLayer || [];
    $(document).ready(function () {

        // задание переменной для автопрокрутки слайдеров
        var autoplayTime = 3500;
        $('#product_slider_big').owlCarousel({
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
            itemsMobile : [479,3],
            navigation: true,
            navigationText: ["", ""],
        });

        // обработка событий слайдера
        var owl1 = $("#product_slider_big").data('owlCarousel');
        var owl2 = $("#owl2").data('owlCarousel');
        $('#product_slider_big').find('.button-next').click(function () {
            $('#product_slider_big').trigger('owl.next');
            owl1.stop();
            owl2.stop();
        });
        $('#product_slider_big').find('.button-prev').click(function () {
            $('#product_slider_big').trigger('owl.prev');
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

        // запуск видео с отсечкой по времени
        $('#slaider1').on('click', '.button_play_video', function(){
            ShowYTVideo($(this).attr('data-target'), $(this).attr('data-ytID'), $(this).attr('data-vidStart'));
        });
        // переход к окну "Видеообзоры"
        $('.mini_banner_img').click(function () {
            console.log('vid',$('#video_flag').parent().attr('id'));
            $('#first-tab-group').find('.description_box').hide();
            $('#video_flag').parent().show();
            $('.tabs_section').find('.description_item ').removeClass('active');
            // $('#tabs_section').children('[data-text="'+id+'"]');
            $('[data-text='+$('#video_flag').parent().attr('id')+']').addClass('active');
            $('html,body').stop().animate({ scrollTop: $('#video_flag').parent().offset().top }, 1000);
        });

        //работа со стикерами
        $('.sticker_box').on('click', '.sticker_all_btn', function () {
            $.each($('.sticker_wrapper').children(),function (key,item) {
                $(item).removeClass('sticker_unvisible');
            });
            var count_items = $('.sticker_wrapper').children().length;
            if($(this).find('.fa-angle-down').length == 1){
                $(this).find('.fa').removeClass('fa-angle-down').addClass('fa-angle-right');
                count=1;
                for (i=count_items; i>0; i--){
                    $('.sticker_wrapper').children().eq(i).fadeOut(300*count++);
                }
            } else {
                $(this).find('.fa').removeClass('fa-angle-right').addClass('fa-angle-down');
                for (i=1; i<=count_items; i++){
                    $('.sticker_wrapper').children().eq(i).fadeIn(300*i);
                }
            }
        });
        // работа с описанием, отзывами и т.п.
        $('.description_item').click(function () {
            var box = '#' + $(this).attr('data-text');
            $('.description_item').removeClass('active');
            $(this).addClass('active');
            $('.description_box').hide();
            $(box).show();
        });

        // Для фейсбука - смотрели товар
        fbq('track', 'ViewContent', {
            content_name: '<?=$arResult['NAME']?>',
            content_category: '<?=$arResult['SECTION']['NAME']?>',
            content_ids: <?=$arResult['ID']?>,
            content_type: 'product',
            value: <?=$credit_payment?>,
            currency: 'RUB'
        });


        dataLayer.push({
            'ecommerce': {
                'currencyCode': 'RUB',
                'detail': {
                    'actionField': {'list': ''},
                    'products': [{
                        'name': "<?=$arResult['NAME']?>",
                        'id': "<?=$arResult['ID']?>",
                        'price': "<?=$credit_payment?>",
                        'brand': "<?=$arResult['PROPERTIES']['MANUFACTURER']['NAME']?>",
                        'category': "<?=$arResult['SECTION']['NAME']?>",
                        // 'variant': '',
                        // 'position': ''
                    }]
                },
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Product Details',
            'gtm-ee-event-non-interaction': 'True',
        });

        // console.log('dataLayer, ', dataLayer);
        // console.log('see_product', $('.catalog-item-table-view'));
        // $.each($('.catalog-item-card'), function (item, value) {
        //     console.log('see_product', item, value);
        //
        // });

        // обработка нажатия кнопки "в корзину"
        $('.btn_click_add_basket_gtm').on('click',function () {
            // Для фейсбука - положили в корзину
            fbq('track', 'AddToCart',
                {
                    content_name: '<?=$arResult['NAME']?>',
                    content_category: '<?=$arResult['SECTION']['NAME']?>',
                    content_ids: <?=$arResult['ID']?>,
                    content_type: 'product',
                    value: '<?=$credit_payment?>',
                    currency: 'RUB'
                }
            );


            dataLayer.push({
                'ecommerce': {
                    'currencyCode': 'RUB',
                    'add': {
                        'actionField': {'list': ''},
                        'products': [{
                            'name': "<?=$arResult['NAME']?>",
                            'id': "<?=$arResult['ID']?>",
                            'price': "<?=$credit_payment?>",
                            'brand': "<?=$arResult['PROPERTIES']['MANUFACTURER']['NAME']?>",
                            'category': "<?=$arResult['SECTION']['NAME']?>",
                            // 'variant': '',
                            // 'position': ''
                        }]
                    }
                },
                'event': 'gtm-ee-event',
                'gtm-ee-event-category': 'Enhanced Ecommerce',
                'gtm-ee-event-action': 'Adding a Product to a Shopping Cart',
                'gtm-ee-event-non-interaction': 'False',
            });

            var data ={
                ID: <?=$arResult['ID']?>,
                quantity:1,
                credit: $(this).data('credit')
            };

            // console.log('data', data);
            $.post(
                '/ajax/add2basket.php',
                data,
                function (result) {
                    location.href = '/personal/order/make/';
                });
        });

        // верхние отступы для для хлебных крошек 1224
        if (screen.width > 767){
            $('.slider_box').css('margin-top', $('.h1_bread_cont').height()+20+'px');
        }
        // верхние отступы для слайдера и правой панели с ценниками для 768
        if (screen.width <= 768 && screen.width > 425){
            var top_height = $('.h1_bread_cont').height()+$('.slider_box').height()+40;

            $('.right_panel').css('top', top_height+'px');
            $('.tabs_section').css('margin-top',$('.right_panel').height()+20+'px');
        }
        // верхние отступы для слайдера и правой панели с ценниками для 425
        if (screen.width <= 425 ){
            var top_height = $('.h1_bread_cont').height()+$('.slider_box').height()+40;
            $('.right_panel').css('top', top_height-20+'px');
            $('.tabs_section').css('margin-top',$('.right_panel').height()+20+'px');
        }
        $('.tabs_section').css('height', $('.tabs_section .description_item ').height()+6+'px');

        // сравнение
        window.compareNotifierTimer = false;
        $('#catalog_add2compare_link_<?=$arResult["ID"]?>').click(function(){
            if($(this).data('mode') == 'add') $(this).html('<span class="fa fa-check"></span>');
            else if($(this).data('mode') == 'delete') $(this).html('Сравнить');
            $.post('/ajax/add2compare.php', {ID: $(this).data('product'), mode: $(this).data('mode')}, function(data){
                $('#compare').find('.qnt').stop().animate({'background-color': '#c61e50'}, 500).html(data.items);
                if(data.items > 0)
                {
                    $('#compare a').attr('href', "/catalog/compare/?action=COMPARE");
                }
                else
                {
                    $('#compare a').removeAttr('href');
                }
                if(data.popup)
                {
                    if(compareNotifierTimer) clearTimeout(compareNotifierTimer);
                    if($('#compare').find('.m24-compare-notifier').length == 0)
                    {
                        $('#compare').prepend('<a class="m24-compare-notifier" href="/catalog/compare/?action=COMPARE"></a>');
                    }
                    var notifier = $('#compare').find('.m24-compare-notifier');
                    notifier.height('0px').css('top', '0px');
                    notifier.stop().animate({height:'217px', top:'-217px'}, 500, function(){
                        compareNotifierTimer = setTimeout(function(){
                            var notifier = $('#compare').find('.m24-compare-notifier');
                            $('#compare').find('.qnt').stop().animate({'background-color': '#8184a1'}, 500);
                            notifier.stop().animate({height:'0px', top:'0px'}, 500, function(){
                                $(this).remove();
                            });
                        }, 5000);
                    });
                }
                else
                {
                    $('#compare').find('.qnt').stop().animate({'background-color': '#8184a1'}, 500);
                }
            }, 'json');
            if($(this).data('mode') == 'add') $(this).data('mode', 'delete');
            else if($(this).data('mode') == 'delete') $(this).data('mode', 'add');
        });
        // запуск видео, с определенной секунды
        $('#slaider1').on('click', '.button_play_video', function(){
            ShowYTVideo($(this).attr('data-target'), $(this).attr('data-ytID'), $(this).attr('data-vidStart'));
            var data = {
                verify: true,
                props: 'views',
                id: $(this).attr('data-ytID')
            };
            // console.log('data', data);
            $.post(
                '/bitrix/components/mainpage/videoreview/ajax/',
                data,
                function () {

                }
            );
        });

    });
</script>