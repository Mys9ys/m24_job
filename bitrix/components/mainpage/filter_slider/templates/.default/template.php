<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/filter_slider/style.min.css'); ?>

<div class="slider_filter_img">
    <img class="category_promo_img" src="<?=$arResult['IMG']?>" alt="">
    <? if(!empty($arResult['Prop']['title']['~VALUE'])) { ?>
        <div class="promo_block">
            <div class="promo_text"><?=$arResult['Prop']['title']['~VALUE']?></div>
            <div class="sub_promo_text"><?=$arResult['Prop']['subtitle']['~VALUE']?></div>
    <? } ?>
</div>
