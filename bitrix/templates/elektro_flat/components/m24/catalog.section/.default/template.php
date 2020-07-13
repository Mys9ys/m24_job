<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->addExternalCss(SITE_TEMPLATE_PATH.'/m24_bigdata_new.css');
$APPLICATION->SetAdditionalCSS('/bitrix/templates/elektro_flat/components/m24/catalog.section/.default/banners.css');
$APPLICATION->IncludeFile("/bitrix/templates/elektro_flat/components/m24/catalog.section/.default/functions.php", array(), array());?>


<?

// BEGIN Вывод UF_PRETITLE для раздела
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'],'ID'=>$arResult['ID'], 'GLOBAL_ACTIVE'=>'Y'); 
$db_list = CIBlockSection::GetList(array(), $arFilter, false, Array("UF_PRETITLE")); 
if($uf_value = $db_list->GetNext()): 
	$pretitle=$uf_value["UF_PRETITLE"].' ';
else:
	$pretitle='';
endif;
// END

// BEGIN Замена #ВГОРОДЕ# на региональные значения (КВ)
switch ($_SERVER['SERVER_NAME']) {
		case "xn--90aedc4atap.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Белгороде'; //Белгород
			 break;
		case "xn--b1agd0aean.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Воронеже'; //Воронеж
			 break;
		case "xn--80acgfbsl1azdqr.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Екатеринбурге'; //Екатеринбург
			 break;
		case "xn--80aauks4g.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Казани'; //Казань
			 break;
		case "xn--j1aarei.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Курске'; //Курск
			 break;
		case "xn--e1afhbv7b.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Липецке'; //Липецк
			 break;
		case "xn----7sbdqaabf2clfe5a7hpcg.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Набережных Челнах'; //Наберебжные Челны
			 break;
		case "xn-----7kcgn5cdbagnnnx.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Ростове-на-Дону'; //Ростов-на-Дону
			 break;
		case "xn--80avue.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Туле'; //Тула
			 break;
		case "xn--e1aner7ci.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Тюмени'; //Тюмень
			 break;
		case "xn--k1afg2e.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Орле'; //Орёл
			 break;
		case "xn--80adxhks.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Москве'; //Москва
			 break;
		
		
		case "xn--80antj7do.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Рязани'; //Рязань
			 break;
		case "xn--90absbknhbvge.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Новосибирске'; //Новосибирск
			 break;
		case "xn----7sbeiia6axumbcqds.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Санкт-Петербурге'; //Санкт-Петербург
			 break;	 
		case "xn----dtbdeglbi6acdmca3a.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Нижнем Новгороде'; //Нижний Новгород
			 break;
		case "xn--80aaa0cvac.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Самаре'; //Самара
			 break;
		case "xn--80aalwqglfe.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Краснодаре'; //Краснодар
			 break; 
		case "xn--80a1bd.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Уфе'; //Уфа
			 break; 
		case "xn--e1aohf5d.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Перми'; //Пермь
			 break;
		case "xn--80addag2buct.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Волгограде'; //Волгоград
			 break;
		case "xn--h1aeawgfg.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Иркутске'; //Иркутск
			 break;
		case "xn--b1afaslnbn.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Кемерово'; //Кемерово
			 break;
		case "xn--80aacf4bwnk3a.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Хабаровске'; //Хабаровск
			 break;
		case "xn--80atblfjdfd2l.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Красноярске'; //Красноярск
			 break;
		case "xn--90asilg6f.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Брянске'; //Брянск
			 break;	 
		default:  $v_regione = '';		
	}
$arResult['DESCRIPTION'] = str_replace('#ВГОРОДЕ#', $v_regione, $arResult['DESCRIPTION']);
// END
?>

<?// сортировка элементов для страницы Акции?>
<?if($_SERVER['REQUEST_URI'] == '/actions/'){
    $res = CIBlockElement::GetList(
        array("SORT"=> 'ASC'),
        Array("IBLOCK_ID" => 39, "ACTIVE"=>"Y"),
        false,
        false,
        array());
    while ($ob = $res->GetNextElement()) {
        $Elem = $ob->GetFields();
        $Elem["PROPERTIES"] = $ob->GetProperties();
        if($Elem["PROPERTIES"]['actions']['VALUE'] == 'Y'){
            $arDiscount = CCatalogDiscount::GetDiscountByProduct($Elem['ID']);
            $prc = intval($Elem['PROPERTIES']['MINIMUM_PRICE']['VALUE']);
            $Elem['PRICE'] = $prc;
            foreach($arDiscount as $discount) 
            {
                if($discount['VALUE_TYPE'] == 'S') {
                    $prc = intval($discount['VALUE']);
                } elseif($discount['VALUE_TYPE'] == 'F') {
                $prc -= intval($discount['VALUE']);
                } elseif($discount['VALUE_TYPE'] == 'P') {
                    $prc *= ((100 - intval($discount['VALUE']))/100);
                }
            }
            $Elem['PRICE_DISCOUNT'] = $prc;
            $arResult["ITEMS"][] = $Elem;
        }
    }
} else {
    foreach($arResult['ITEMS'] as $i => $Elem) {
        $arDiscount = CCatalogDiscount::GetDiscountByProduct($Elem['ID']);
        $prc = intval($Elem['PROPERTIES']['MINIMUM_PRICE']['VALUE']);
        $Elem['PRICE'] = $prc;
        foreach($arDiscount as $discount) 
        {
            if($discount['VALUE_TYPE'] == 'S') {
                $prc = intval($discount['VALUE']);
            } elseif($discount['VALUE_TYPE'] == 'F') {
            $prc -= intval($discount['VALUE']);
            } elseif($discount['VALUE_TYPE'] == 'P') {
                $prc *= ((100 - intval($discount['VALUE']))/100);
            }
        }
        $Elem['PRICE_DISCOUNT'] = $prc;
        $arResult["ITEMS"][$i] = $Elem;
    }
}?>

<?// Выводим аналоги?>
<?if(!empty($arParams['analogs'])){
    $arResult["ITEMS"] = getAnalog($arParams['analogs']);
}?>

<?if(count($arResult["ITEMS"]) > 0):?>

<script>
    window.compareNotifierTimer = false;
    if(typeof(window['m24addToCompare']) != 'function') function m24addToCompare(id)
    {
        $('#catalog_add2compare_link_'+id).click(function(){
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
    }
</script>

<div class="bigdata-items" itemscope itemtype="http://schema.org/ItemList">
	<link href="<?=$APPLICATION->GetCurPage()?>" itemprop="url" />
	<div class="catalog-item-table-view">
        <?$countElement = 1;?>
		<?foreach($arResult["ITEMS"] as $key => $arElement):
			$strMainID = $this->GetEditAreaId($arElement["ID"]);
			$arItemIDs = array(
				"ID" => $strMainID
			);

//			$bPicture = is_array($arElement["PREVIEW_PICTURE"]);
//			$altPicture = is_array($arElement["PREVIEW_IMG"]);
                        //var_dump($arElement["PREVIEW_IMG"]);
                        //die();

			$sticker = "";
			if(array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"])):
				if(array_key_exists("NEWPRODUCT", $arElement["PROPERTIES"]) && !$arElement["PROPERTIES"]["NEWPRODUCT"]["VALUE"] == false):
					$sticker .= "<span class='new'>NEW</span>";
				endif;
				if(array_key_exists("SALELEADER", $arElement["PROPERTIES"]) && !$arElement["PROPERTIES"]["SALELEADER"]["VALUE"] == false):
					$sticker .= "<span class='hit'>ХИТ</span>";
				endif;
				if(array_key_exists("DISCOUNT", $arElement["PROPERTIES"]) && !$arElement["PROPERTIES"]["DISCOUNT"]["VALUE"] == false):
					if(isset($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):						
						if($arElement["OFFERS_MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] > 0):
							$sticker .= "<span class='discount'>-".$arElement["OFFERS_MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]."%</span>";
						else:
							$sticker .= "<span class='discount'>%</span>";
						endif;
					else:
						if($arElement["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] > 0):
							$sticker .= "<span class='discount'>-".$arElement["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]."%</span>";
						else:
							$sticker .= "<span class='discount'>SALE!</span>";
						endif;
					endif;
				endif;
			endif;?>
			<div class="catalog-item-card" itemscope itemtype="http://schema.org/Product" itemprop="itemListElement">

                <?// картинка акции новогодней?>
                <?if($arElement['PROPERTIES']['actions']['VALUE'] == 'Y'){?>
<!--                    <div class="actions-panel"><img src="/bitrix/templates/elektro_flat/components/m24/catalog.section/.default/images/actions.png" alt=""></div>-->
                <?}?>
                <style>
                    .catalog-item-card{
                        position: relative;
                    }
                    .catalog-item-card .actions-panel{
                        position: absolute;
                        z-index: 1;
                        bottom: 90px;
                        left: 10px;
                    }
                    .actions-panel img{
                        width: 65px;
                        height: 65px;
                        max-width: 100%;
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: center;

                    }
                </style>
                <?// конец картинки акции новогодней?>

                            <meta itemprop="position" content="<?=$key?>">
                            <meta itemprop="description" content="<?=$arElement['PREVIEW_TEXT']?>">
				<div class="catalog-item-info">							
					<div class="item-image">

                        <?// картинки для странички с акцией?>
                        <?if($_SERVER['REQUEST_URI'] == '/actions/'){?>
                            <?if($arElement['PREVIEW_PICTURE']){
                                $content = CFile::GetPath($arElement["PREVIEW_PICTURE"]);
                            } else {
                                $content = CFile::GetPath($arElement["DETAIL_PICTURE"]);
                            }?>
                            <a href="<?=$arElement['DETAIL_PAGE_URL']?>">
                                <??>
                                <img class="item_img item_img_first" src="<?=$content?>" alt="<?=$arElement['NAME']?>" />
                                <? if(!empty($arElement["PROPERTIES"]['image_hover']['VALUE'])) { ?>
                                    <img class="item_img item_img_hover" src="<?=CFile::GetPath($arElement["PROPERTIES"]['image_hover']['VALUE'])?>" alt="<?=$arElement['NAME']?>" /><? } ?>
                                <span class="sticker"><?=$sticker?></span>
                            </a>
                            <style>
                                .item_img{
                                    width: 300px;
                                    height: 255px;
                                    max-width: 100%;
                                    background-repeat: no-repeat;
                                    background-position: center;
                                    background-size: cover;
                                }
                            </style>
                        <?} else {?>
						<?if(is_array($arElement['DETAIL_PICTURE'])):?>
							<meta content="<?=$arElement['DETAIL_PICTURE']['SRC']?>" itemprop="image" />
							<a href="<?=$arElement['DETAIL_PAGE_URL']?>">
								<img class="item_img item_img_first" src="<?=$arElement['PREVIEW_IMG']['SRC']?>" width="<?=$arElement['PREVIEW_IMG']['WIDTH']?>" height="<?=$arElement['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arElement['NAME']?>" />
                                                                <? if(!empty($arElement['HOVER_IMG'])) { ?><img class="item_img item_img_hover" src="<?=$arElement['HOVER_IMG']['SRC']?>" width="<?=$arElement['HOVER_IMG']['WIDTH']?>" height="<?=$arElement['HOVER_IMG']['HEIGHT']?>" alt="<?=$arElement['NAME']?>" /><? } ?>
								<span class="sticker">
									<?=$sticker?>
								</span>
								<?if(!empty($arElement["PROPERTIES"]["MANUFACTURER"]["PREVIEW_IMG"]["SRC"])):?>
									<img class="manufacturer" src="<?=$arElement['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['SRC']?>" width="<?=$arElement['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['WIDTH']?>" height="<?=$arElement['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arElement['PROPERTIES']['MANUFACTURER']['NAME']?>" />
								<?endif;?>
							</a>

                        <?else :?>

							<meta content="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" itemprop="image" />
							<a href="<?=$arElement['DETAIL_PAGE_URL']?>">
								<img class="item_img" src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" width="150" height="150" alt="<?=$arElement['NAME']?>" />
								<span class="sticker">
									<?=$sticker?>
								</span>
								<?if(!empty($arElement["PROPERTIES"]["MANUFACTURER"]["PREVIEW_IMG"]["SRC"])):?>
									<img class="manufacturer" src="<?=$arElement['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['SRC']?>" width="<?=$arElement['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['WIDTH']?>" height="<?=$arElement['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arElement['PROPERTIES']['MANUFACTURER']['NAME']?>" />
								<?endif;?>
							</a>
						<?endif?>
                        <?}?>
					</div>
                                        <div class="item-all-title">
						<a class="item-title" href="<?=$arElement['DETAIL_PAGE_URL']?>" title="<?=$arElement['NAME']?>" itemprop="url">
							<meta itemprop="name" content="<?=$pretitle?><?=$arElement['NAME']?>">
                                                        <div class="product-name">
                                                            <? 
                                                                if(empty($arElement['PROPERTY_SHORT_NAME_VALUE'])) 
                                                                {
                                                                    echo $arElement['NAME'];
                                                                } 
                                                                else 
                                                                {
                                                                    echo $arElement['PROPERTY_SHORT_NAME_VALUE'];
                                                                }
                                                                    
                                                            ?>
                                                        </div>
                                                        <div class="product-pretitle"><?=$pretitle?></div>
						</a>
					</div>
					<div class="item-price-cont">	
						<div class="item-price" itemscope="" itemtype="http://schema.org/Offer" itemprop="offers">
                                                        <span class="mobile-hidden">Цена 
                                                                <? if($arElement['PRICE_DISCOUNT'] < $arElement['PRICE']) { ?>
                                                                    <span class="catalog-item-price-old">
                                                                    &nbsp;<?=$arElement['PRICE']?>&nbsp;
                                                                    </span>
                                                                <? } ?>
                                                        </span>
                                                        <span class="catalog-item-price js-giftd-product-price  js-giftd-block-2 " data-giftd-block-id-product="2">
                                                                <?=$arElement['PRICE_DISCOUNT']?>													
                                                                <span class="unit"><i class="fa fa-rub"></i></span>
                                                        </span>
                                                        <meta itemprop="price" content="<?=intval($arElement['PRICE_DISCOUNT'])?>">
                                                        <meta itemprop="priceCurrency" content="RUB">
                                                </div>
					</div>
					<div class="buy_more">
						<?if($arParams["DISPLAY_COMPARE"]=="Y"):
                                                    if(!isset($_SESSION['CATALOG_COMPARE_LIST'][$arParams['IBLOCK_ID']]['ITEMS'][$arElement['ID']])):
                                                        $cMode = 'add';
                                                        $cTitle = 'Сравнить';
                                                    else:
                                                        $cMode = 'delete';
                                                        $cTitle = '<span class="fa fa-check"></span>';
                                                    endif;
                                                    ?>
							<div class="compare">
                                                                <a href="javascript:void(0)" data-mode="<?=$cMode?>" data-product="<?=$arElement["ID"]?>" class="catalog-item-compare btn btn-default" id="catalog_add2compare_link_<?=$arElement['ID']?>" title="<?=GetMessage('CATALOG_ELEMENT_ADD_TO_COMPARE')?>" rel="nofollow"><?=$cTitle?></a>
							</div>
                                                        <script>
                                                            $(document).ready(function(){
                                                                m24addToCompare(<?=$arElement['ID']?>);
                                                            });
                                                        </script>
						<?endif;?>
                                                <div class="view-detail">
                                                        <a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="btn btn-default"></a>
                                                </div>				
					</div>
				</div>
			</div>
            <?// на главной в категории "новинка, скидки ..."?>
            <?if($_SERVER['REQUEST_URI'] == '/'){
                if($countElement == 4){
                $banner =  getMainPageRandomBanner();
                $videoItem =  getMainPageRandomVideos();
                } else {
                    $banner = '';
                    $videoItem = '';
                }
                // баннеры для каталога
            } else {?>
                <?$banner =  getCatalogBanners($arResult['ID'], $countElement)?>
                <?$videoItem =  getCatalogVideos($arResult['ID'], $countElement)?>
            <?}?>

            <?// вывод баннера?>
            <?if(!empty($banner)) {?>
                <div class="catalog-item-card">
                    <?// Вставляем картинку в баннер?>
                    <?if($banner['PREVIEW_PICTURE']){
                        $content = '<div class="banner-img"><img src="'.CFile::GetPath($banner['PREVIEW_PICTURE']).'" alt=""></div>';
                    }?>
                    <?// Вставляем текст в баннер ?>
                    <?if($banner['DETAIL_TEXT']){
                        $content = '<div class="banner-text">'.$banner['DETAIL_TEXT'].'</div>';
                    }?>
                    <?// проверка на наличие контента?>
                    <?if($banner['PREVIEW_TEXT']){?>
                        <a href="<?=$banner['PREVIEW_TEXT']?>">
                            <?=$content?>
                        </a>
                    <?} else {?>
                        <?=$content?>
                    <?}?>
                </div>
            <?}?>

            <?// вывод баннера с видео?>
            <?if(!empty($videoItem)) {?>
            <?// Вставляем картинку из инфоблока?>
            <?if($videoItem['PREVIEW_PICTURE']){
                $content = '<img src="'.CFile::GetPath($videoItem['PREVIEW_PICTURE']).'" alt="">';
            } dd('mi yt')?>
                <div class="catalog-item-card double-videos video-responsive-block" id="video2">
                    <div class="panel1"><?=$content?>
                        <div class="button_play_video video-button" data-ytID="<?=$videoItem['PREVIEW_TEXT']?>" data-target="video2"></div>
                    </div>
<!--                    --><?//if($videoItem['DETAIL_TEXT']){?>
                        <div class="video-banner-title"><?=$videoItem['DETAIL_TEXT']?></div>
<!--                    --><?//}?>
                </div>
            <?}?>
            <?$countElement++?>

        <?endforeach;?>
	</div>

	<?foreach($arResult["ITEMS"] as $key => $arElement):

		if((isset($arElement["OFFERS"]) && !empty($arElement["OFFERS"])) || (isset($arElement["SELECT_PROPS"]) && !empty($arElement["SELECT_PROPS"]))):
			$strMainID = $this->GetEditAreaId($arElement["ID"]);
			$arItemIDs = array(
				"ID" => $strMainID,
				"PICT" => $strMainID."_picture",
				"PRICE" => $strMainID."_price",
				"BUY" => $strMainID."_buy",
				"PROP_DIV" => $strMainID."_sku_tree",
				"PROP" => $strMainID."_prop_",
				"SELECT_PROP_DIV" => $strMainID."_propdiv",
				"SELECT_PROP" => $strMainID."_select_prop_"
			);
			$strObName = "ob".preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);?>
			
			<div class="pop-up-bg more_options_body" id="<?=$arItemIDs['ID']?>_body"></div>
			<div class="pop-up more_options" id="<?=$arItemIDs['ID']?>">				
				<a href="javascript:void(0)" class="pop-up-close more_options_close" id="<?=$arItemIDs['ID']?>_close"><i class="fa fa-times"></i></a>
				<div class="h1"><?=GetMessage("CATALOG_ELEMENT_MORE_OPTIONS")?></div>
				<div class="item_info">
					<div class="item_image" id="<?=$arItemIDs['PICT']?>">
						<?if(isset($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):
							foreach($arElement["OFFERS"] as $key_off => $arOffer):?>
								<div id="img_<?=$arElement['ID']?>_<?=$arOffer['ID']?>" class="img <?=$arElement['ID']?> hidden">
									<?if(isset($arOffer["PREVIEW_IMG"])):?>
										<img src="<?=$arOffer['PREVIEW_IMG']['SRC']?>" alt="<?=$arElement["NAME"]?>" width="<?=$arOffer['PREVIEW_IMG']["WIDTH"]?>" height="<?=$arOffer['PREVIEW_IMG']["HEIGHT"]?>"/>
									<?else:?>
										<img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>"/>
									<?endif;?>
								</div>
							<?endforeach;
						else:?>
							<div class="img">
								<?if(isset($arElement["PREVIEW_IMG"])):?>
									<img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>"/>
								<?else:?>
									<img src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" width="150" height="150" alt="<?=$arElement['NAME']?>" />
								<?endif;?>
							</div>
						<?endif;?>
						<div class="item_name">
							<?=$arElement["NAME"]?>
						</div>
					</div>
					<div class="item_block">						
						<?if(!empty($arElement["OFFERS_PROP"])):?>
							<table class="offer_block" id="<?=$arItemIDs['PROP_DIV'];?>">
								<?$arSkuProps = array();
								foreach($arResult["SKU_PROPS"] as &$arProp) {
									if(!isset($arElement["OFFERS_PROP"][$arProp["CODE"]]))
										continue;
									$arSkuProps[] = array(
										"ID" => $arProp["ID"],
										"SHOW_MODE" => $arProp["SHOW_MODE"]
									);?>
									<tr class="<?=$arProp['CODE']?>" id="<?=$arItemIDs['PROP'].$arProp['ID'];?>_cont">
										<td class="h3">
											<?=htmlspecialcharsex($arProp["NAME"]);?>:
										</td>
										<td class="props">
											<ul id="<?=$arItemIDs['PROP'].$arProp['ID'];?>_list" class="<?=$arProp['CODE']?>">
												<?foreach($arProp["VALUES"] as $arOneValue) {
													$arOneValue["NAME"] = htmlspecialcharsbx($arOneValue["NAME"]);?>
													<li data-treevalue="<?=$arProp['ID'].'_'.$arOneValue['ID'];?>" data-onevalue="<?=$arOneValue['ID'];?>" style="display:none;">
														<span title="<?=$arOneValue['NAME'];?>">
															<?if("TEXT" == $arProp["SHOW_MODE"]) {
																echo $arOneValue["NAME"];
															} elseif("PICT" == $arProp["SHOW_MODE"]) {
																if(!empty($arOneValue["PICT"]["src"])):?>
																	<img src="<?=$arOneValue['PICT']['src']?>" width="<?=$arOneValue['PICT']['width']?>" height="<?=$arOneValue['PICT']['height']?>" alt="<?=$arOneValue['NAME']?>" />
																<?else:?>
																	<i style="background:#<?=$arOneValue['HEX']?>"></i>
																<?endif;
															}?>
														</span>
													</li>
												<?}?>
											</ul>
											<div class="bx_slide_left" style="display:none;" id="<?=$arItemIDs['PROP'].$arProp['ID']?>_left" data-treevalue="<?=$arProp['ID']?>"></div>
											<div class="bx_slide_right" style="display:none;" id="<?=$arItemIDs['PROP'].$arProp['ID']?>_right" data-treevalue="<?=$arProp['ID']?>"></div>
											<div class="clr"></div>
										</td>
									</tr>
								<?}
								unset($arProp);?>
							</table>
						<?endif;?>
						
						<?if(!empty($arElement["SELECT_PROPS"])):?>
							<table class="offer_block" id="<?=$arItemIDs['SELECT_PROP_DIV'];?>">
								<?$arSelProps = array();
								foreach($arElement["SELECT_PROPS"] as $key_prop => $arProp):
									$arSelProps[] = array(
										"ID" => $arProp["ID"]
									);?>
									<tr class="<?=$arProp['CODE']?>" id="<?=$arItemIDs['SELECT_PROP'].$arProp['ID'];?>">
										<td class="h3"><?=htmlspecialcharsex($arProp["NAME"]);?></td>
										<td class="props">												
											<ul class="<?=$arProp['CODE']?>">
												<?$props = array();
												foreach($arProp["DISPLAY_VALUE"] as $arOneValue) {
													$props[$key_prop] = array(
														"NAME" => $arProp["NAME"],
														"CODE" => $arProp["CODE"],
														"VALUE" => strip_tags($arOneValue)
													);
													$props[$key_prop] = strtr(base64_encode(addslashes(gzcompress(serialize($props[$key_prop]),9))), '+/=', '-_,');?>
													<li data-select-onevalue="<?=$props[$key_prop]?>">
														<span title="<?=$arOneValue;?>"><?=$arOneValue?></span>
													</li>
												<?}?>
											</ul>
											<div class="clr"></div>
										</td>
									</tr>
								<?endforeach;
								unset($arProp);?>
							</table>
						<?endif;?>						
						
						<div class="catalog_price" id="<?=$arItemIDs['PRICE'];?>">
							<?if(isset($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):
								foreach($arElement["OFFERS"] as $key_off => $arOffer):?>
									<div id="price_<?=$arElement['ID']?>_<?=$arOffer['ID']?>" class="price <?=$arElement["ID"]?> hidden">
										<?foreach($arOffer["PRICES"] as $code => $arPrice):
											if($arPrice["MIN_PRICE"] == "Y"):
												if($arPrice["CAN_ACCESS"]):
																
													$price = CCurrencyLang::GetCurrencyFormat($arPrice["CURRENCY"], "ru");
													if(empty($price["THOUSANDS_SEP"])):
														$price["THOUSANDS_SEP"] = " ";
													endif;
													$currency = str_replace("#", " ", $price["FORMAT_STRING"]);

													if($arPrice["VALUE"]==0):
														$arElement["OFFERS"][$key_off]["ASK_PRICE"] = 1;?>			
														<span class="no-price">
															<?=GetMessage("CATALOG_ELEMENT_NO_PRICE")?>
															<?=(!empty($arOffer["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arOffer["CATALOG_MEASURE_NAME"] : "";?>
														</span>
													<?elseif($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>				
														<span class="price-old">
															<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
															<?=$currency;?>
														</span>
														<span class="price-percent">
															<?=GetMessage("CATALOG_ELEMENT_SKIDKA")." ".$arPrice["PRINT_DISCOUNT_DIFF"];?>
														</span>
														<span class="price-normal">
															<?=number_format($arPrice["DISCOUNT_VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
															<span class="unit">
																<?=$currency?>
																<?=(!empty($arOffer["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arOffer["CATALOG_MEASURE_NAME"] : "";?>
															</span>
														</span>															
													<?else:?>															
														<span class="price-normal">
															<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
															<span class="unit">
																<?=$currency?>
																<?=(!empty($arOffer["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arOffer["CATALOG_MEASURE_NAME"] : "";?>
															</span>
														</span>															
													<?endif;												
												endif;
											endif;
										endforeach;?>
										<div class="available">
											<?if($arOffer["CAN_BUY"]):?>													
												<div class="avl">
													<i class="fa fa-check-circle"></i>
													<span><?=GetMessage("CATALOG_ELEMENT_AVAILABLE")/*." ".$arOffer["CATALOG_QUANTITY"]*/?></span>
												</div>
											<?elseif(!$arOffer["CAN_BUY"]):?>												
												<div class="not_avl">
													<i class="fa fa-times-circle"></i>
													<span><?=GetMessage("CATALOG_ELEMENT_NOT_AVAILABLE")?></span>
												</div>
											<?endif;?>
										</div>
									</div>
								<?endforeach;
							else:
								foreach($arElement["PRICES"] as $code => $arPrice):
									if($arPrice["MIN_PRICE"] == "Y"):
										if($arPrice["CAN_ACCESS"]):
																
											$price = CCurrencyLang::GetCurrencyFormat($arPrice["CURRENCY"], "ru");
											if(empty($price["THOUSANDS_SEP"])):
												$price["THOUSANDS_SEP"] = " ";
											endif;
											$currency = str_replace("#", " ", $price["FORMAT_STRING"]);

											if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
												<span class="price-old">
													<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
													<?=$currency;?>
												</span>
												<span class="price-percent">
													<?=GetMessage("CATALOG_ELEMENT_SKIDKA")." ".$arPrice["PRINT_DISCOUNT_DIFF"];?>
												</span>
												<span class="price-normal">
													<?=number_format($arPrice["DISCOUNT_VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
													<span class="unit">
														<?=$currency?>
														<?=(!empty($arElement["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arElement["CATALOG_MEASURE_NAME"] : "";?>
													</span>
												</span>
											<?else:?>
												<span class="price-normal">
													<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
													<span class="unit">
														<?=$currency?>
														<?=(!empty($arElement["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arElement["CATALOG_MEASURE_NAME"] : "";?>
													</span>
												</span>
											<?endif;
										endif;
									endif;
								endforeach;?>
								<div class="available">
									<?if($arElement["CAN_BUY"]):?>												
										<div class="avl">
											<i class="fa fa-check-circle"></i>
											<span><?=GetMessage("CATALOG_ELEMENT_AVAILABLE")/*." ".$arElement["CATALOG_QUANTITY"]*/?></span>
										</div>
									<?elseif(!$arElement["CAN_BUY"]):?>												
										<div class="not_avl">
											<i class="fa fa-times-circle"></i>
											<span><?=GetMessage("CATALOG_ELEMENT_NOT_AVAILABLE")?></span>
										</div>
									<?endif;?>
								</div>
							<?endif;?>
						</div>
							
						<div class="catalog_buy_more" id="<?=$arItemIDs['BUY'];?>">
							<?if(isset($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):
								foreach($arElement["OFFERS"] as $key_off => $arOffer):?>
									<div id="buy_more_<?=$arElement['ID']?>_<?=$arOffer['ID']?>" class="buy_more <?=$arElement['ID']?> hidden">
										<?if($arOffer["CAN_BUY"]):											
											if($arOffer["ASK_PRICE"]):?>
												<a class="btn_buy apuo" id="ask_price_anch_<?=$arOffer['ID']?>" href="javascript:void(0)" rel="nofollow"><i class="fa fa-comment-o"></i><span><?=GetMessage("CATALOG_ELEMENT_ASK_PRICE_FULL")?></span></a>
												<?$properties = false;
												foreach($arOffer["DISPLAY_PROPERTIES"] as $propOffer) {
													$properties[] = $propOffer["NAME"].": ".strip_tags($propOffer["DISPLAY_VALUE"]);
												}
												$properties = implode("; ", $properties);
												if(!empty($properties)):
													$offer_name = $arElement["NAME"]." (".$properties.")";
												else:
													$offer_name = $arElement["NAME"];
												endif;?>
												<?$APPLICATION->IncludeComponent("altop:ask.price", "",
													Array(
														"ELEMENT_ID" => $arOffer["ID"],		
														"ELEMENT_NAME" => $offer_name,
														"EMAIL_TO" => "",				
														"REQUIRED_FIELDS" => array("NAME", "TEL", "TIME")
													),
													false,
													array("HIDE_ICONS" => "Y")
												);?>
											<?elseif(!$arOffer["ASK_PRICE"]):?>											
												<div class="add2basket_block">
													<form action="<?=SITE_DIR?>ajax/add2basket.php" class="add2basket_form">
														<div class="qnt_cont">
															<a href="javascript:void(0)" class="minus" onclick="if (BX('quantity_<?=$arOffer["ID"]?>').value > <?=$arOffer["CATALOG_MEASURE_RATIO"]?>) BX('quantity_<?=$arOffer["ID"]?>').value = parseFloat(BX('quantity_<?=$arOffer["ID"]?>').value)-<?=$arOffer["CATALOG_MEASURE_RATIO"]?>;"><span>-</span></a>
															<input type="text" id="quantity_<?=$arOffer['ID']?>" name="quantity" class="quantity" value="<?=$arOffer['CATALOG_MEASURE_RATIO']?>"/>
															<a href="javascript:void(0)" class="plus" onclick="BX('quantity_<?=$arOffer["ID"]?>').value = parseFloat(BX('quantity_<?=$arOffer["ID"]?>').value)+<?=$arOffer["CATALOG_MEASURE_RATIO"]?>;"><span>+</span></a>
														</div>
														<input type="hidden" name="ID" class="offer_id" value="<?=$arOffer["ID"]?>" />
														<?$props = array();
														foreach($arOffer["DISPLAY_PROPERTIES"] as $propOffer) {
															$props[] = array(
																"NAME" => $propOffer["NAME"],
																"CODE" => $propOffer["CODE"],
																"VALUE" => strip_tags($propOffer["DISPLAY_VALUE"])
															);
														}
														$props = strtr(base64_encode(addslashes(gzcompress(serialize($props),9))), '+/=', '-_,');?>
														<input type="hidden" name="PROPS" value="<?=$props?>" />
														<?if(!empty($arElement["SELECT_PROPS"])):?>
															<input type="hidden" name="SELECT_PROPS" id="select_props_<?=$arOffer['ID']?>" value="" />						
														<?endif;?>
														<?if(!empty($arOffer["PREVIEW_IMG"]["SRC"])):?>
															<input type="hidden" name="item_image" class="item_image" value="&lt;img class='item_image' src='<?=$arOffer["PREVIEW_IMG"]["SRC"]?>' alt='<?=$arElement["NAME"]?>'/&gt;"/>
														<?else:?>
															<input type="hidden" name="item_image" class="item_image" value="&lt;img class='item_image' src='<?=$arElement["PREVIEW_IMG"]["SRC"]?>' alt='<?=$arElement["NAME"]?>'/&gt;"/>
														<?endif;?>
														<input type="hidden" name="item_title" class="item_title" value="<?=$arElement['NAME']?>"/>											
														<button type="submit" name="add2basket" class="btn_buy" value="<?=GetMessage('CATALOG_ELEMENT_ADD_TO_CART')?>"><i class="fa fa-shopping-cart"></i><span><?=GetMessage("CATALOG_ELEMENT_ADD_TO_CART")?></span></button>
														<small class="result hidden"><i class="fa fa-check"></i><span><?=GetMessage("CATALOG_ELEMENT_ADDED")?></span></small>
													</form>
												</div>
											<?endif;
										elseif(!$arOffer["CAN_BUY"]):?>
											<a class="btn_buy apuo" id="order_anch_<?=$arOffer['ID']?>" href="javascript:void(0)" rel="nofollow"><i class="fa fa-clock-o"></i><span><?=GetMessage("CATALOG_ELEMENT_UNDER_ORDER")?></span></a>
											<?$properties = false;
											foreach($arOffer["DISPLAY_PROPERTIES"] as $propOffer) {
												$properties[] = $propOffer["NAME"].": ".strip_tags($propOffer["DISPLAY_VALUE"]);
											}
											$properties = implode("; ", $properties);
											if(!empty($properties)):
												$offer_name = $arElement["NAME"]." (".$properties.")";
											else:
												$offer_name = $arElement["NAME"];
											endif;?>
											<?$APPLICATION->IncludeComponent("altop:ask.price", "order",
												Array(
													"ELEMENT_ID" => $arOffer["ID"],		
													"ELEMENT_NAME" => $offer_name,
													"EMAIL_TO" => "",				
													"REQUIRED_FIELDS" => array("NAME", "TEL", "TIME")
												),
												false,
												array("HIDE_ICONS" => "Y")
											);?>
										<?endif;?>
									</div>
								<?endforeach;
							else:?>
								<div class="buy_more">
									<?if($arElement["CAN_BUY"]):?>
										<div class="add2basket_block">
											<form action="<?=SITE_DIR?>ajax/add2basket.php" class="add2basket_form">
												<div class="qnt_cont">
													<a href="javascript:void(0)" class="minus" onclick="if (BX('quantity_select_<?=$arElement["ID"]?>').value > <?=$arElement["CATALOG_MEASURE_RATIO"]?>) BX('quantity_select_<?=$arElement["ID"]?>').value = parseFloat(BX('quantity_select_<?=$arElement["ID"]?>').value)-<?=$arElement["CATALOG_MEASURE_RATIO"]?>;"><span>-</span></a>
													<input type="text" id="quantity_select_<?=$arElement['ID']?>" name="quantity" class="quantity" value="<?=$arElement['CATALOG_MEASURE_RATIO']?>"/>
													<a href="javascript:void(0)" class="plus" onclick="BX('quantity_select_<?=$arElement["ID"]?>').value = parseFloat(BX('quantity_select_<?=$arElement["ID"]?>').value)+<?=$arElement["CATALOG_MEASURE_RATIO"]?>;"><span>+</span></a>
												</div>
												<input type="hidden" name="ID" class="id" value="<?=$arElement['ID']?>" />
												<input type="hidden" name="SELECT_PROPS" id="select_props_<?=$arElement['ID']?>" value="" />												
												<input type="hidden" name="item_image" class="item_image" value="&lt;img class='item_image' src='<?=$arElement["PREVIEW_IMG"]["SRC"]?>' alt='<?=$arElement["NAME"]?>'/&gt;"/>
												<input type="hidden" name="item_title" class="item_title" value="<?=$arElement['NAME']?>"/>												
												<button type="submit" name="add2basket" class="btn_buy" value="<?=GetMessage('CATALOG_ELEMENT_ADD_TO_CART')?>"><i class="fa fa-shopping-cart"></i><span><?=GetMessage("CATALOG_ELEMENT_ADD_TO_CART")?></span></button>
												<small class="result hidden"><i class="fa fa-check"></i><span><?=GetMessage("CATALOG_ELEMENT_ADDED")?></span></small>
											</form>
										</div>
									<?endif;?>
								</div>
							<?endif;?>
						</div>											
					</div>
				</div>
			</div>
			<?if(isset($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):
				$arJSParams = array(
					"PRODUCT_TYPE" => $arElement["CATALOG_TYPE"],
					"VISUAL" => array(
						"ID" => $arItemIDs["ID"],
						"PICT_ID" => $arItemIDs["PICT"],
						"PRICE_ID" => $arItemIDs["PRICE"],
						"BUY_ID" => $arItemIDs["BUY"],
						"TREE_ID" => $arItemIDs["PROP_DIV"],
						"TREE_ITEM_ID" => $arItemIDs["PROP"]
					),
					"PRODUCT" => array(
						"ID" => $arElement["ID"],
						"NAME" => $arElement["NAME"]
					),
					"OFFERS" => $arElement["JS_OFFERS"],
					"OFFER_SELECTED" => $arElement["OFFERS_SELECTED"],
					"TREE_PROPS" => $arSkuProps
				);
			else:
				$arJSParams = array(
					"PRODUCT_TYPE" => $arElement["CATALOG_TYPE"],
					"VISUAL" => array(
						"ID" => $arItemIDs["ID"]
					),
					"PRODUCT" => array(
						"ID" => $arElement["ID"],
						"NAME" => $arElement["NAME"]
					)
				);
			endif;				
			if(isset($arElement["SELECT_PROPS"]) && !empty($arElement["SELECT_PROPS"])):
				$arJSParams["VISUAL"]["SELECT_PROP_ID"] = $arItemIDs["SELECT_PROP_DIV"];
				$arJSParams["VISUAL"]["SELECT_PROP_ITEM_ID"] = $arItemIDs["SELECT_PROP"];
				$arJSParams["SELECT_PROPS"] = $arSelProps;
			endif;?>				
			<script type="text/javascript">
				var <?=$strObName;?> = new JCCatalogSection(<?=CUtil::PhpToJSObject($arJSParams, false, true);?>);
			</script>
		<?endif;
	endforeach;?>
	
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"];?>
	<?endif;?>

    <? // блок сео поднят
    global $seobottom;?>
    <div class="seo-bottom">
        <?=$seobottom?>
    </div>

	<?if(!empty($arResult["DESCRIPTION"])):?>
		<?if(empty($_REQUEST["PAGEN_1"]) || (!empty($_REQUEST["PAGEN_1"]) && $_REQUEST["PAGEN_1"]=="1")):?>
            <?//вызов описания для категорий?>
            <? $APPLICATION->IncludeComponent("mainpage:section_description", "",
                Array(
                        'section' => $arResult["ID"],
                        'items' => $arResult["ITEMS"]
                ),
                false,
                Array()
            ); ?>
		<?endif;?>
	<?endif;?>
</div>
<div class="clr"></div>

<script>
$(document).ready(function(){
    $('.catalog-item-card').hover(function(){
        if($(this).find('.item_img_hover').length != 0) 
        {
            $(this).find('.item_img_first').stop().fadeTo(500, 0);
            $(this).find('.item_img_hover').stop().fadeTo(500, 1);
        }
    },function(){
        if($(this).find('.item_img_hover').length != 0) 
        {
            $(this).find('.item_img_first').stop().fadeTo(500, 1);
            $(this).find('.item_img_hover').stop().fadeTo(500, 0);
        }
    });
});    
</script>

<?else:?>

<div id="catalog">
	<p><?=GetMessage("CATALOG_EMPTY_RESULT")?></p>
	<?if(!empty($arResult["DESCRIPTION"])):?>
		<div class="catalog_description">
            <!--noindex-->
			<?=$arResult["DESCRIPTION"]?>
            <!--/noindex-->
		</div>
	<?endif;?>
</div>
<div class="clr"></div>

<?endif;?>
