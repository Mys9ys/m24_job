<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->addExternalCss(SITE_TEMPLATE_PATH.'/m24_bigdata_new.css');
$frame = $this->createFrame("bigdata")->begin("");
	
$injectId = "bigdata_recommeded_products_".rand();?>
<script type="application/javascript">
	BX.cookie_prefix = '<?=CUtil::JSEscape(COption::GetOptionString("main", "cookie_name", "BITRIX_SM"))?>';
	BX.cookie_domain = '<?=$APPLICATION->GetCookieDomain()?>';
	BX.current_server_time = '<?=time()?>';

	BX.ready(function(){
		bx_rcm_recommendation_event_attaching(BX('<?=$injectId?>_items'));
	});

</script>

<?if(isset($arResult["REQUEST_ITEMS"])) {
	CJSCore::Init(array('ajax'));

	//component parameters
	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedParameters = $signer->sign(
		base64_encode(serialize($arResult["_ORIGINAL_PARAMS"])),
		"bx.bd.products.recommendation"
	);
	$signedTemplate = $signer->sign($arResult["RCM_TEMPLATE"], "bx.bd.products.recommendation");?>

	<div id="<?=$injectId?>" class="bigdata_recommended_products_container"></div>

	<script type="application/javascript">
		BX.ready(function(){
			bx_rcm_get_from_cloud(
				'<?=CUtil::JSEscape($injectId)?>',
				<?=CUtil::PhpToJSObject($arResult['RCM_PARAMS'])?>,
				{
					'parameters':'<?=CUtil::JSEscape($signedParameters)?>',
					'template': '<?=CUtil::JSEscape($signedTemplate)?>',
					'site_id': '<?=CUtil::JSEscape(SITE_ID)?>',
					'rcm': 'yes'
				}
			);
		});
	</script>
	
	<?$frame->end();
	return;
}

if(!empty($arResult["ITEMS"])):?>	
	<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function() {
			$(".add2basket_bigdata_form").submit(function() {
				var form = $(this);
				
				<?if(!isset($arParams["SHOW_POPUP"]) || (isset($arParams["SHOW_POPUP"]) && $arParams["SHOW_POPUP"] == "Y")):?>
					$(".more_options_body").css({"display":"none"});
					$(".more_options").css({"display":"none"});

					imageItem = form.find(".item_image").attr("value");
					$("#addItemInCart .item_image_full").html(imageItem);

					titleItem = form.find(".item_title").attr("value");
					$("#addItemInCart .item_title").text(titleItem);				

					var ModalName = $("#addItemInCart");
					CentriredModalWindow(ModalName);
					OpenModalWindow(ModalName);
				<?endif;?>

				$.post($(this).attr("action"), $(this).serialize(), function(data) {
					try {
						$.post("/ajax/basket_line.php", function(data) {
							$("#cart_line").replaceWith(data);
						});
						$.post("/ajax/delay_line.php", function(data) {
							$("#delay").replaceWith(data);
						});
						form.children(".btn_buy").addClass("hidden");
						form.children(".result").removeClass("hidden");
						<?if(isset($arParams["SHOW_POPUP"]) && $arParams["SHOW_POPUP"] == "N"):?>
							location = "<?=$arParams['BASKET_URL']?>";
						<?endif;?>
					} catch (e) {}
				});
				return false;
			});
		});
		//]]>
	</script>
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
	<div id="<?=$injectId?>_items" class="bigdata_recommended_products_items">
		<input type="hidden" name="bigdata_recommendation_id" value="<?=htmlspecialcharsbx($arResult['RID'])?>">
        <!--noindex-->
		<div class="bigdata-items">

			<div class="h3"><?=GetMessage("CATALOG_BIGDATA_ITEMS")?></div>
			
                        <div class="catalog-item-table-view">
                            <?foreach($arResult["ITEMS"] as $key => $arElement):

                                    // BEGIN Товары от Relaxa не выводятся на сайте для Тулы (КВ) --> 
                                    if($_SERVER['HTTP_HOST'] == 'xn--80avue.xn--24-6kcazf3bybfa8i.xn--p1ai') {
                                            $mnr_name = $arResult["ITEMS"][$key]["PROPERTIES"]["MANUFACTURER"]["NAME"];
                                            //echo '<script>console.log("'.$mnr_name.'");</script>';
                                            if($mnr_name == 'Ogawa' || $mnr_name == 'OTO') continue;
                                    }
                                    // END

                                    $strMainID = $this->GetEditAreaId($arElement["ID"]);
                                    $arItemIDs = array(
                                            "ID" => $strMainID
                                    );

                                    $bPicture = is_array($arElement["PREVIEW_IMG"]);

                                    $sticker = "";
                                    if(array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"])):
                                            if(array_key_exists("NEWPRODUCT", $arElement["PROPERTIES"]) && !$arElement["PROPERTIES"]["NEWPRODUCT"]["VALUE"] == false):
                                                    $sticker .= "<span class='new'>".GetMessage("CATALOG_ELEMENT_NEWPRODUCT")."</span>";
                                            endif;
                                            if(array_key_exists("SALELEADER", $arElement["PROPERTIES"]) && !$arElement["PROPERTIES"]["SALELEADER"]["VALUE"] == false):
                                                    $sticker .= "<span class='hit'>".GetMessage("CATALOG_ELEMENT_SALELEADER")."</span>";
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
                                            <div class="catalog-item-info">							
                                                    <div class="item-image">
                                                            <?if($bPicture):?>
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
                                                            <?else:?>
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
                                                            <?if(isset($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):
                                                                    $price = CCurrencyLang::GetCurrencyFormat($arElement["OFFERS_MIN_PRICE"]["CURRENCY"], "ru");
                                                                    if(empty($price["THOUSANDS_SEP"])):
                                                                            $price["THOUSANDS_SEP"] = " ";
                                                                    endif;
                                                                    $currency = str_replace("#", " ", $price["FORMAT_STRING"]);

                                                                    if($arElement["OFFERS_MIN_PRICE"]["VALUE"] == 0):?>
                                                                            <div class="item-no-price">			
                                                                                    <span class="unit">
                                                                                            <?=GetMessage("CATALOG_ELEMENT_NO_PRICE")?>
                                                                                            <span><?=(!empty($arElement["OFFERS_MIN_PRICE"]["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arElement["OFFERS_MIN_PRICE"]["CATALOG_MEASURE_NAME"] : "";?></span>
                                                                                    </span>
                                                                            </div>
                                                                    <?elseif($arElement["OFFERS_MIN_PRICE"]["DISCOUNT_VALUE"] < $arElement["OFFERS_MIN_PRICE"]["VALUE"]):?>
                                                                            <div class="item-price" itemscope itemtype="http://schema.org/Offer" itemprop="offers">
                                                                                    <span class="catalog-item-price-old">
                                                                                            <?=number_format($arElement["OFFERS_MIN_PRICE"]["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
                                                                                            <?=$currency;?>
                                                                                    </span>
                                                                                    <span class="catalog-item-price-percent">
                                                                                            <?=GetMessage("CATALOG_ELEMENT_SKIDKA")." ".$arElement["OFFERS_MIN_PRICE"]["PRINT_DISCOUNT_DIFF"];?>
                                                                                    </span>
                                                                                    <span class="catalog-item-price">
                                                                                            <?=number_format($arElement["OFFERS_MIN_PRICE"]["DISCOUNT_VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
                                                                                            <span class="unit">
                                                                                                    <?=$currency?>
                                                                                                    <span><?=(!empty($arElement["OFFERS_MIN_PRICE"]["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arElement["OFFERS_MIN_PRICE"]["CATALOG_MEASURE_NAME"] : "";?></span>
                                                                                            </span>
                                                                                    </span>
                                                                                    <meta itemprop="price" content="<?=$arElement["OFFERS_MIN_PRICE"]["DISCOUNT_VALUE"]?>" />
                                                                                    <meta itemprop="priceCurrency" content="<?=$arElement["OFFERS_MIN_PRICE"]["CURRENCY"]?>" />
                                                                            </div>
                                                                    <?else:?>
                                                                            <div class="item-price" itemscope itemtype="http://schema.org/Offer" itemprop="offers">
                                                                                    <span class="catalog-item-price">
                                                                                            <?=number_format($arElement["OFFERS_MIN_PRICE"]["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
                                                                                            <span class="unit">
                                                                                                    <?=$currency?>
                                                                                                    <span><?=(!empty($arElement["OFFERS_MIN_PRICE"]["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arElement["OFFERS_MIN_PRICE"]["CATALOG_MEASURE_NAME"] : "";?></span>
                                                                                            </span>
                                                                                    </span>
                                                                                    <meta itemprop="price" content="<?=$arElement["OFFERS_MIN_PRICE"]["VALUE"]?>" />
                                                                                    <meta itemprop="priceCurrency" content="<?=$arElement["OFFERS_MIN_PRICE"]["CURRENCY"]?>" />
                                                                            </div>
                                                                    <?endif;
                                                            else:
                                                                    foreach($arElement["PRICES"] as $code=>$arPrice):
                                                                            if($arPrice["MIN_PRICE"] == "Y"):
                                                                                    if($arPrice["CAN_ACCESS"]):

                                                                                            $price = CCurrencyLang::GetCurrencyFormat($arPrice["CURRENCY"], "ru");
                                                                                            if(empty($price["THOUSANDS_SEP"])):
                                                                                                    $price["THOUSANDS_SEP"] = " ";
                                                                                            endif;
                                                                                            $currency = str_replace("#", " ", $price["FORMAT_STRING"]);

                                                                                            if($arPrice["VALUE"] == 0):?>
                                                                                                    <?$arElement["ASK_PRICE"]=1;?>
                                                                                                    <div class="item-no-price">	
                                                                                                            <span class="unit">
                                                                                                                    <?=GetMessage("CATALOG_ELEMENT_NO_PRICE")?>
                                                                                                                    <span><?=(!empty($arElement["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arElement["CATALOG_MEASURE_NAME"] : "";?></span>
                                                                                                            </span>
                                                                                                    </div>
                                                                                            <?elseif($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                                                                                    <div class="item-price" itemscope itemtype="http://schema.org/Offer" itemprop="offers">
                                                                                                            <span class="mobile-hidden">Цена <span class="catalog-item-price-old">
                                                                                                                    &nbsp;<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>&nbsp;
                                                                                                            </span></span>
                                                                                                            <span class="catalog-item-price">
                                                                                                                    <?=number_format($arPrice["DISCOUNT_VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
                                                                                                                    <span class="unit">
                                                                                                                            <i class="fa fa-rub"></i>
                                                                                                                    </span>
                                                                                                            </span>
                                                                                                            <meta itemprop="price" content="<?=$arPrice["DISCOUNT_VALUE"]?>" />
                                                                                                            <meta itemprop="priceCurrency" content="<?=$arPrice["CURRENCY"]?>" />
                                                                                                    </div>
                                                                                            <?else:?>
                                                                                                    <div class="item-price" itemscope itemtype="http://schema.org/Offer" itemprop="offers">
                                                                                                            <span class="mobile-hidden">Цена</span>
                                                                                                            <span class="catalog-item-price">
                                                                                                                    <?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
                                                                                                                    <span class="unit">
                                                                                                                            <i class="fa fa-rub"></i>
                                                                                                                    </span>
                                                                                                            </span>
                                                                                                            <meta itemprop="price" content="<?=$arPrice["VALUE"]?>" />
                                                                                                            <meta itemprop="priceCurrency" content="<?=$arPrice["CURRENCY"]?>" />
                                                                                                    </div>
                                                                                            <?endif;?>
                                                                                    <?endif;
                                                                            endif;
                                                                    endforeach;
                                                            endif;?>
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
                            <?endforeach;?>
                    </div>
                        
			<div class="clr"></div>
		</div>
        <!--/noindex-->
	</div>
<?endif;

$frame->end();?>