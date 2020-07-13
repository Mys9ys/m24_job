<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/links/style.min.css');?>

<?//Для компов и планшетов?>
<div class="main-links-box link_max_img">
    <?foreach ($arResult as $arLink){?>
        <div class="links-box">
            <a href="/catalog/<?=$arLink["link"]?>/">
                <div class="links-content">
                    <picture>
                        <img class="maxImg-m24 minImg-m24 lazyLoadM24"
                             data-max="/bitrix/components/mainpage/links/images/<?=$arLink['link']?>.jpg"
                             data-min="/bitrix/components/mainpage/links/images/<?=$arLink["link"]?>_min.jpg"
                             data-media="621"
                             src="/images/loader.jpg" alt="<?=$arLink['name']?>">
                    </picture>
                    <div class="links-title"><?=$arLink["name"]?></div>
                    <div class="links-count"><?=$arLink["count"]?></div>
                    <div class="links-blackout"></div>
                </div>
            </a>
        </div>
    <?}?>
</div>

<script>
    $(document).ready(function () {
        if (screen.width <= 1233 && screen.width > 769){
            var width = $('.main-links-box').width();
            $('.main-links-box').height(width/2);
        }
    });
</script>
