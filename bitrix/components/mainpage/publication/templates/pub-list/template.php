<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/publication/templates/pub-list/style.min.css');?>
<? $APPLICATION->IncludeFile("/bitrix/components/mainpage/publication/templates/pub-list/function.php", array(), array()); ?>
<?$arPublication = arPublications();?>


<div class="publication-list" data-pagen="1" data-pagens="<?=ceil(count(arPublication())/10)?>">
    <?foreach($arPublication as $arItem):?>
        <div class="publication-item">
            <div class="publication-img-box">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <?if(!empty($arItem['PREVIEW_PICTURE'])):?>
                        <img src="<?=CFile::GetPath($arItem['PREVIEW_PICTURE'])?>" alt="<?=$arItem['NAME']?>" />
                    <?endif;?>
                </a>
            </div>
            <div class="publication-content-box">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <div class="publication-title"><?=$arItem["NAME"]?></div>
                </a>
                <?if(!empty($arItem["PREVIEW_TEXT"])) {?>
                    <div class="publication-text"><?=$arItem["PREVIEW_TEXT"]?></div>
                <?} else {?>
                    <div class="publication-text"><?=$arItem["DETAIL_TEXT"]?></div>
                <?}?>
                <div class="publication-more">
                    <img src="/bitrix/components/mainpage/publication/templates/pub-list/images/img.png" alt="">
                    <div class="publication-views"><?=$arItem["PROPERTIES"]['views']['VALUE']?></div>
                    <a class="publication-more-link" href="<?=$arItem['DETAIL_PAGE_URL']?>">Подробнее...</a>
                </div>
            </div>
            <div class="clr"></div>
        </div>
    <?endforeach;?>
</div>

<script type="text/javascript" src="/bitrix/components/mainpage/publication/script.min.js"></script>

