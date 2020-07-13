<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/publication/templates/pub-item/style.min.css');?>
<? $APPLICATION->IncludeFile("/bitrix/components/mainpage/publication/templates/pub-list/function.php", array(), array()); ?>

<?      
        $arPublication = arPublication($arParams["CODE"])[0];
        $statiIpropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(43, $arPublication["ID"]); 
	$statiMetaProp = $statiIpropValues->getValues();
        
        if(!empty($statiMetaProp['ELEMENT_META_TITLE'])) {
                $APPLICATION->SetTitle($statiMetaProp['ELEMENT_META_TITLE']);
                $APPLICATION->SetPageProperty('title', $statiMetaProp['ELEMENT_META_TITLE']);
        } else {
            $APPLICATION->SetPageProperty('title', $arPublication["NAME"]);
        }
        if(!empty($statiMetaProp['ELEMENT_META_KEYWORDS'])) {
            $APPLICATION->SetPageProperty('keywords', $statiMetaProp['ELEMENT_META_KEYWORDS']);
        }
        if(!empty($statiMetaProp['ELEMENT_META_DESCRIPTION'])) {
            $APPLICATION->SetPageProperty('description', $statiMetaProp['ELEMENT_META_DESCRIPTION']);
        }
        if(!empty($statiMetaProp['ELEMENT_PAGE_TITLE'])) {
            $stati_h1 = $statiMetaProp['ELEMENT_PAGE_TITLE'];
        } else {
            $stati_h1 = $arPublication["NAME"];
        }
?>

<div class="container-fluid container_m24" data-pubid="<?=$arPublication["ID"]?>">

    <div class="publication-img">
        <img src="<?=CFile::GetPath($arPublication['DETAIL_PICTURE'])?>" alt="<?=$arPublication["NAME"]?>">
    </div>
    <div class="publication_text">
        <?if(strpos($arPublication["DETAIL_TEXT"], '#banner#')){
            $first_part = substr($arPublication["DETAIL_TEXT"], 0, strpos($arPublication["DETAIL_TEXT"], '#banner#'));
            $second_part = substr($arPublication["DETAIL_TEXT"], strpos($arPublication["DETAIL_TEXT"], '#banner#')+8, strpos($arPublication["DETAIL_TEXT"], '#banner#'));
            echo $first_part;
            $APPLICATION->IncludeComponent("mainpage:stati_form", "", Array(), false, Array());
            echo $second_part;
        } else {?>
            <?=$arPublication["DETAIL_TEXT"]?>
        <?}?>
    </div>
</div>

<script>
    //отправка лайка ajax
    $(document).ready(function () {
        var data = {
            ID: <?=$arPublication["ID"]?>,
            control: 1
        };
        $.post(
            '/stati/ajax/',
            data,
            function(result){
            }
        );
        if($('.container_m24').innerWidth()>799){
            $('.container_m24').css('margin-left', ($('#content-wrapper').innerWidth()-$('.container_m24').innerWidth())/2 );
        }
    });
</script>


