<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/topbanners/style.min.css'); ?>
<? $APPLICATION->AddHeadScript("/bitrix/components/mainpage/topbanners/script.min.js"); ?>
<?//dd($arResult['drop_basket'])?>
<div id="block1">
    <div id="left-part">
        <? $APPLICATION->IncludeComponent("mainpage:slider", "",
            Array(),
            false,
            Array()
        ); ?>
    </div>
    <?
    $pay_slider = array(
        'card_buy' => '/content/card_buy/',
        'halva_buy' => '/content/card_buy/',
        'credit_buy' => '/content/credit_buy/'
    );
    if($arResult['drop_basket'] == true){
        $pay_slider = array('drop_basket'=>'/personal/order/make/') + $pay_slider;
    }?>
    <div id="right-part">
        <div id="slider_pay" class="owl-carousel-slider">
            <?foreach ($pay_slider as $key=>$slide){?>
                <div class="owlElement">
                    <a class="slider_link" href="<?=$slide?>">
                        <img class="top-banner lazyLoadBanner <?='slide_'.$key?>"
                             data-win1="/bitrix/components/mainpage/topbanners/images/<?=$key?>_max.jpg"
                             data-win2="/bitrix/components/mainpage/topbanners/images/<?=$key?>_min.jpg"
                             data-win3="/bitrix/components/mainpage/topbanners/images/<?=$key?>_max.jpg"
                             data-win4="/bitrix/components/mainpage/topbanners/images/<?=$key?>_min.jpg"
                             src="/images/loader.jpg" alt="">
                    </a>
                </div>
            <?}?>
        </div>
        <a href="/content/card_buy/"></a>
        <div class="bottom-banner">
            <div class="response-header">
                <div class="response_rating_box">
                    <div class="response-sum"><?=number_format($arResult['rating'], 1 , ',', '')?></div>
                    <div class="rateyo-widg" data-rating="<?=$arResult['rating']?>"></div>
                </div>

                <div class="response_text_box">
                    <div class="bottom-banner-title">НАШИ ПОКУПАТЕЛИ ДОВОЛЬНЫ</div>
                    <div class="response-text"><?=$arResult['repute']?></div>
                </div>
            </div>
            <div class="response_footer">
                <div class="response-item-img">
                    <a href="<?=$arResult['item']['link']?>">
                        <img class="lazyLoadM24"
                             data-max="<?=$arResult['item']['img']?>"
                             data-min=""
                             data-media="0"
                             src="/images/loader.jpg" alt="">
                    </a>
                </div>
                <div class="response-item-text"><?=$arResult['item']['name']?></div>
            </div>
            <a href="/response/"><div class="all_response_button">Все отзывы</div></a>
        </div>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
</div>
