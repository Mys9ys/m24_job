<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/publication/style.min.css');?>
<? $APPLICATION->IncludeFile("/bitrix/components/mainpage/publication/function.php", array(), array()); ?>

<div id="publications-box">
    <?if($APPLICATION->GetCurPage() == '/'){?>
        <?$arPublication = publicationGet($arParams['PAGE_ELEMENT_COUNT'])?>
        <div class="publications-title">
            <div class="title-pub">Последние записи в блоге</div>
            <div class="text-pub">Полезные статьи и сравнения, которые помогут вам сделать правильный выбор при покупке массажёра</div>
        </div>
    <?} elseif(!empty($arParams)) {
        $arPublication = publicationIDGet($arParams['publications']);
    }?>
    <?if(!empty($arPublication)){?>
        <div class="publications-content">
            <?foreach ($arPublication as $Publication){?>
                <div class="publication-box">
                    <picture class="publication-img">
                        <img class="lazyLoadM24"
                             data-max="<?=$Publication['pic']['max']?>"
                             data-min="<?=$Publication['pic']['min']?>"
                             data-media="425"
                             src="/images/loader.jpg" alt="">
                    </picture>
                    <div class="publication-content">
                        <div class="publication-title"><?=$Publication['NAME']?></div>
                        <div class="publication-text"><?=strip_tags($Publication['DETAIL_TEXT'])?></div>
                        <a href="/stati/<?=$Publication['CODE']?>/"><div class="publication-btn">Подробнее</div></a>
                    </div>
                    <div class="clr"></div>
                </div>
            <?}?>
        </div>

        <div class="more-publications"><a href="/stati/" target="_blank">Больше обзоров <i class="fa fa-plus-circle" aria-hidden="true"></i></a></div>
        <div class="clr"></div>
    <?}?>


</div>

<script>
    $(document).ready(function () {
        $('.publication-content').each(function () {
            var text = $(this).find('.publication-text').text().slice(0, 405);
            $(this).find('.publication-text').text(text+'...');
        });
        
    });
</script>

