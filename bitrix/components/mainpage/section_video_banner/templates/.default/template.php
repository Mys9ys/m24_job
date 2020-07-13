<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/section_video_banner/style.min.css'); ?>
<? $APPLICATION->AddHeadScript("/bitrix/components/mainpage/section_video_banner/script.min.js"); ?>
<?if(!empty($arResult)){?>
    <div class="section_video_banner video-responsive-block" id="section_video_banner">
        <div class="panel1">
            <picture>
                <img class="banner_pic lazyLoadM24"
                     data-max="<?=$arResult['pic']['max']?>"
                     data-min="<?=$arResult['pic']['min']?>"
                     data-media="426"
                     src="/images/loader.jpg" alt="">
            </picture>
            <div class="button_play_video video-button" data-ytID="<?=$arResult['vidID']?>" data-target="section_video_banner" data-vidStart="<?=$arResult['timeStart']?>"></div>
        </div>
    </div>
<?}?>
