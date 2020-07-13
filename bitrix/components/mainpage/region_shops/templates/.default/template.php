<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/region_shops/style.min.css'); ?>
<? $APPLICATION->AddHeadScript("/bitrix/components/mainpage/region_shops/script.min.js"); ?>

<? if (!empty($arResult)) { ?>
    <? if ($APPLICATION->GetCurPage() == "/") { ?>
        <? //Баннер на главной?>
        <div id="region_banner" class="owl-carousel-slider">
            <a class="owlElement slider_filter_link" href="/content/region_shops/?shop=<?= $arResult['shop']['shopID'] ?>">
                <picture class="slider_filter_img">
                    <img class="lazyLoadM24"
                         data-max="<?= $arResult['shop']['banner_img'] ?>"
                         data-min="<?= $arResult['shop']['banner_mini'] ?>"
                         data-media="426"
                         src="/images/loader.jpg" alt="">
                </picture>
            </a>
        </div>
    <? } else { ?>
        <div class="region_banner_block">
            <? //Описание?>
            <div class="region_banner_box_left">
                <div class="region_banner_title">
                    Наш интернет магазин предлагает Вам попробовать интересующий Вас массажер в официальном Шоу-руме в
                    Вашем
                    городе
                </div>
                <div class="region_block_text">
                    Если вы сомневаетесь, стоит ли покупать массажер или нет, хорош ли он в работе и стоит ли он своих
                    денег, то можете протестировать его в нашем магазине
                </div>
                <div class="get_sms_box">
                    <div class="get_address_sms shopAdressModal" >Получить
                        адрес магазина по SMS
                    </div>
                </div>
                <div class="region_attention_block">
                    <div class="region_attention_box">
                        Обращаем Ваше внимание – перед посещением Шоу-рума уточните наличие товара
                        <div class="chatM24_box">
                            <? $APPLICATION->IncludeComponent("mainpage:chatM24", "",
                                Array(
                                    'callbaska' => 'Y'
                                ),
                                false,
                                Array()
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <? //Слайдер?>
            <div class="region_banner_box_right">
                <div id="region_banner_one_shop" class="owl-carousel-slider">
                    <? foreach ($arResult['shop']['photos'] as $photos) { ?>
                        <div class="owlElement">
                            <div class="panel_img">
                                <img class="lazyOwl" data-src="<?= CFile::GetPath($photos) ?>" src="" alt="">
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="clr"></div>
            <div class="region_top_title">
                Бренды, доступные в магазине:
            </div>
            <? //картинка брендов?>
            <div class="region_banner_box_left left">
                <div class="banners_img">
                    <img src="/bitrix/components/mainpage/region_shops/image/brands.jpg" alt="">
                </div>
            </div>
            <? //описание брендов?>
            <div class="region_banner_box_right right">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <? foreach ($arResult['shop']['brands'] as $key => $photos) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading<?= $photos['ID'] ?>">
                                <div class="panel-title">
                                    <a href="/vendors/<?= strtolower($photos['NAME']) ?>/"
                                       title="<?= $photos['NAME'] ?>"><img
                                                src="<?= CFile::GetPath($photos['PREVIEW_PICTURE']) ?>" alt=""></a>
                                    <a class="brand_info <? if ($key == 0) {
                                        echo 'brand_info_active';
                                    } ?>" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapse<?= $photos['ID'] ?>"
                                       aria-expanded="<? if ($key == 0) {
                                           echo 'true';
                                       } else {
                                           echo 'false';
                                       } ?>" aria-controls="collapse<?= $photos['ID'] ?>"> Описание
                                    </a>
                                </div>
                            </div>
                            <div id="collapse<?= $photos['ID'] ?>"
                                 class="panel-collapse collapse <? if ($key == 0) echo 'in' ?>" role="tabpanel"
                                 aria-labelledby="heading<?= $photos['ID'] ?>">
                                <div class="panel-body">
                                    <?= $photos['DETAIL_TEXT'] ?>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="clr"></div>
            <div class="region_top_title">
                Как нас найти:
            </div>
            <? //контакты и время работы?>
            <?// блок с картами?>
            <? $arResult = $APPLICATION->IncludeComponent(
                "mainpage:map_shop",
                ".default",
                Array(
//                    "CITY" => $LOCATION_CITY_NAME,
//                    "showroom" => 'Y',
                    "shop_id" => $_REQUEST['shop']
                ),
                false
            );?>

            <div class="clr"></div>
        </div>

        <script>
            shopsRegionData = '<?=json_encode($arResult)?>';
        </script>
    <? } ?>
<? } ?>








