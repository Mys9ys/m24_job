<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/map_shop/style.min.css'); ?>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<? $APPLICATION->AddHeadScript("/bitrix/components/mainpage/map_shop/script.min.js"); ?>

<script>
    shopsData = '<?=json_encode($arResult['data_js'])?>';
    var myMap;
</script>

<div class="shops_on_the_map" id="where_to_buy">

    <div class="huomio">
        <?if(!$arParams['shop_id']){?>
            <p class="map_title">Наличие в магазинах в городе <span><?= $arParams['CITY'] ?></span></p><br>
        <?}?>
        <span>Важно!</span> Перед посещением уточните наличие по телефону: <span
                class="roistat_phone roistat_phone_value">8&nbsp;800&nbsp;222&#8209;16&#8209;90</span>
    </div>
    <div id="map"></div>
    <div class="shop_contain">
        <div class="close_btn">+</div>
        <div class="shopAdressModalContainer"></div>
        <div class="shopAdressModal getAddressBTN"><span>Получить адрес </span>салона
            по sms
        </div>
    </div>
</div>

<?if($_SERVER['REQUEST_URI'] == '/content/contacts/'){?>
    <?$countShops = 0;
    if($arResult['shops']){
        foreach ($arResult['shops'] as $key=>$Shop) {?>
            <div class="shop_contain_content" itemscope itemtype="http://schema.org/LocalBusiness">
                <div class="shop_name" itemprop="name"><?echo $Shop["NAME"]?></div>
                <!--        <span style="color: rgb(156, 194, 24); font-weight: 800; font-size: 2em;">Наличие уточнять по телефону:</span> <span itemprop="telephone" style="font-weight: 600; font-size: 2em;">8 800 222-16-90</span><br />-->

                <div id="map_slider<?=$key?>" class="owl-carousel-slider owl-carousel-map">
                    <?foreach ($Shop['photos'] as $photos){?>
                        <div class="owlElement">
                            <div class="panel_img panel_img_show_room">
                                <img src="<?=CFile::GetPath($photos)?>" alt="">
                            </div>
                        </div>
                    <?}?>
                </div>
                <div class="shop_description">
                    <div class="getAdressSms getAddressBTN" data-shopid="<?=$countShops?>">Получить адрес салона по СМС</div>
                    <!--            <div class="getAdressSms">Узнать адрес у оператора</div>-->
                    <div class="seeOnMap" data-shopid="<?=$countShops++?>">Посмотреть на карте<i class="fa fa-map-marker" aria-hidden="true"></i></div>
                    <div class="clr"></div>
                    <?/// блок на карантин?>
                    <div class="quarantine">
                        <?if(empty($Shop['quarantine'])){ echo '<b style="color:red;">Магазин Закрыт.</b> Ожидаемая дата открытия 15 июля'; }
                        else {echo '<b style="color:red;">'.$Shop['quarantine'].'</b>';}?>
                    </div>
                    <?/// блок на карантин?>
                    <div class="brand_preview">В данном шоу-руме представленны бренды:</div>
                    <?foreach ($Shop['brands'] as $brand) {?>
                        <div class="shops_brands">
                            <!--                    <img src="--><?//=CFile::GetPath($brand["DETAIL_PICTURE"])?><!--" alt="" align="left">-->
                            <div class="brand_name"><span><?=$brand["NAME"]?>(<?=$brand["PREVIEW_TEXT"]?>).</span> <?=$brand["DETAIL_TEXT"]?></div>
                        </div>
                    <?}?>
                </div>
                <div class="clr"></div>
            </div>
        <?}
    }else{

        echo '<p></p>';
        echo $arResult['contact_text'];
        if(!$arResult['contact_text']) {?>
            <div class="stati-list">
                <div class="stati-item">
                    <div class="image_cont">
                        <div class="image">
                            <img width="300" alt="m24_logo_shop.jpg" src="/upload/medialibrary/1fd/1fd63aeab3076f2345714e2f51ba8e58.jpg" height="300" title="m24_logo_shop.jpg" class="shop_contact">
                        </div>
                    </div>
                    <div class="descr">
                        <a class="stati-title" >Интернет-магазин Массажеры24.РФ в городе <?=$arResult['CITY']?></a>
                        <div class="stati-detail">
                            <span class="roistat_phone">Телефон: 8 800 222-16-90</span><br>
                            Режим работы: с 10:00 до 22:00<br>
                            E-mail: <a href="mailto:info@massagery24.ru">info@massagery24.ru</a>
                        </div>
                    </div>
                </div>
            </div>
        <?}
    }
    ?>
<?}?>

<div id="smsSendModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-header">
                <span class="phone_input_title">Получить адрес салона по sms</span>
            </div>
            <div class="modal-body">
                <div class="preview_block">
                    <input type="text" id="field_username" class="form-control" placeholder="Ваше имя" style="background-color:transparent;color:#fff;margin-bottom:10px;"  >
                    <input type="text" id="phonenumber_sms" placeholder="Введите ваш телефон*" class="form-control" style="background-color:transparent;color:#fff;">
                    <span class="phone_not8">* номер вводится без 8</span>
                    <input type="hidden" id="phonenumber_format_sms" value="">
                </div>
                <div class="end_block"></div>
            </div>
            <div class="modal-footer">
                <div class="getShopAdress getAddressBTN">Получить адрес салона</div>
                <input type="hidden" class="shopid" value="">
            </div>
        </div>
    </div>
</div>




