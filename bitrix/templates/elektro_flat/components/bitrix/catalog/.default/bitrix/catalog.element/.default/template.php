<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

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

?>
<? $APPLICATION->SetAdditionalCSS("/bitrix/templates/elektro_flat/tooltipster-master/css/tooltipster.css"); ?>
<script type="text/javascript" src="/bitrix/templates/elektro_flat/tooltipster-master/js/jquery.tooltipster.min.js"></script>

  <script>
        $(document).ready(function() {
            $('.tooltipza').tooltipster();
        });
    </script>

<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function() {
		$("#accessories-from").appendTo("#accessories-to").css({"display":"block"});
		$("#catalog-reviews-from").appendTo("#catalog-reviews-to").css({"display":"block"});
		$(".add2basket_form").submit(function() {
			var form = $(this);

			imageItem = form.find(".item_image").attr("value");
			$("#addItemInCart .item_image_full").html(imageItem);

			titleItem = form.find(".item_title").attr("value");
			$("#addItemInCart .item_title").text(titleItem);			

			var ModalName = $("#addItemInCart");
			CentriredModalWindow(ModalName);
			OpenModalWindow(ModalName);

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
				} catch (e) {}
			});
			document.location.href = '/personal/cart/';			
			return false;
		});
		$(function() {
			$("div.catalog-detail-pictures a").fancybox({
				"transitionIn": "elastic",
				"transitionOut": "elastic",
				"speedIn": 600,
				"speedOut": 200,
				"overlayShow": false,
				"cyclic" : true,
				"padding": 20,
				"titlePosition": "over",
				"onComplete": function() {
					$("#fancybox-title").css({"top":"100%", "bottom":"auto"});
					$("#fancybox-inner").css("overflow", "hidden");
				} 
			});
		});
	});
	//]]>
</script>

<?$strMainID = $this->GetEditAreaId($arResult["ID"]);
$arItemIDs = array(
	"ID" => $strMainID,
	"PICT" => $strMainID."_picture",
	"PRICE" => $strMainID."_price",
	"BUY" => $strMainID."_buy",
	"DELAY" => $strMainID."_delay",
	"STORE" => $strMainID."_store",
	"PROP_DIV" => $strMainID."_skudiv",
	"PROP" => $strMainID."_prop_",
	"SELECT_PROP_DIV" => $strMainID."_propdiv",
	"SELECT_PROP" => $strMainID."_select_prop_",
);
$strObName = "ob".preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData["JS_OBJ"] = $strObName;

$sticker = "";
if(array_key_exists("PROPERTIES", $arResult) && is_array($arResult["PROPERTIES"])) {
	if(array_key_exists("NEWPRODUCT", $arResult["PROPERTIES"]) && !$arResult["PROPERTIES"]["NEWPRODUCT"]["VALUE"] == false) {
		$sticker .= "<span class='new'>".GetMessage("CATALOG_ELEMENT_NEWPRODUCT")."</span>";
	}
	if(array_key_exists("SALELEADER", $arResult["PROPERTIES"]) && !$arResult["PROPERTIES"]["SALELEADER"]["VALUE"] == false) {
		$sticker .= "<span class='hit'>".GetMessage("CATALOG_ELEMENT_SALELEADER")."</span>";
	}
	if(array_key_exists("DISCOUNT", $arResult["PROPERTIES"]) && !$arResult["PROPERTIES"]["DISCOUNT"]["VALUE"] == false) {
		if(isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])) {						
			
		} else {
			if($arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] > 0) {
				$sticker .= "<span class='discount'>-".$arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]."%</span>";
			} else {
				$sticker .= "<span class='discount'>%</span>";
			}
		}
	}
}?>

<div id="<?=$arItemIDs['ID']?>" class="catalog-detail-element" itemscope itemtype="http://schema.org/Product">
	<meta content="<?=$arResult['NAME']?>" itemprop="name" />
	<meta content="<?=$arResult['NAME']?>" property="og:title" />
	<div class="catalog-detail">
		<div class="column first">
			<div class="catalog-detail-pictures">
				<div class="catalog-detail-picture" id="<?=$arItemIDs['PICT']?>">
					<?if(isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):
						foreach($arResult["OFFERS"] as $key => $arOffer):?>
							<div id="detail_picture_<?=$arOffer['ID']?>" class="detail_picture <?=$arResult['ID']?> hidden">
								<?if(is_array($arOffer["DETAIL_IMG"])):?>
									<meta content="<?=$arOffer['DETAIL_PICTURE']['SRC']?>" itemprop="image" />
									<meta content="<?=$arOffer['DETAIL_PICTURE']['SRC']?>" property="og:image" />
									<a rel="" class="catalog-detail-images" id="catalog-detail-images-<?=$arOffer['ID']?>" href="<?=$arOffer['DETAIL_PICTURE']['SRC']?>"> 
										<img src="<?=$arOffer['DETAIL_IMG']['SRC']?>" width="<?=$arOffer['DETAIL_IMG']['WIDTH']?>" height="<?=$arOffer['DETAIL_IMG']['HEIGHT']?>" alt="<?=$arResult['NAME']?>" />
										<div class="sticker">
											<?=$sticker?>
										</div>
										<?if(!empty($arResult["PROPERTIES"]["MANUFACTURER"]["PREVIEW_IMG"]["SRC"])):?>
											<img class="manufacturer" src="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['SRC']?>" width="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['WIDTH']?>" height="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arResult['PROPERTIES']['MANUFACTURER']['NAME']?>" />
										<?endif;?>
									</a>
								<?else:?>
									<meta content="<?=$arResult['DETAIL_PICTURE']['SRC']?>" itemprop="image" />
									<meta content="<?=$arResult['DETAIL_PICTURE']['SRC']?>" property="og:image" />
									<a rel="" class="catalog-detail-images" id="catalog-detail-images-<?=$arOffer['ID']?>" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>"> 
										<img src="<?=$arResult['DETAIL_IMG']['SRC']?>" width="<?=$arResult['DETAIL_IMG']['WIDTH']?>" height="<?=$arResult['DETAIL_IMG']['HEIGHT']?>" alt="<?=$arResult['NAME']?>" />
										<div class="sticker">
											<?=$sticker?>
										</div>
										<?if(!empty($arResult["PROPERTIES"]["MANUFACTURER"]["PREVIEW_IMG"]["SRC"])):?>
											<img class="manufacturer" src="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['SRC']?>" width="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['WIDTH']?>" height="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arResult['PROPERTIES']['MANUFACTURER']['NAME']?>" />
										<?endif;?>
									</a>
								<?endif;?>
							</div>
						<?endforeach;
					else:
						if(is_array($arResult["DETAIL_IMG"])):?>
							<div class="detail_picture">
									<?if(!empty($arResult["PROPERTIES"]["video_new"]["~VALUE"][0]["TEXT"])) {?>
								<div id="kv_video_top" style="display:block;width:100%;overflow:hidden">
										
											<!-- Масштабирование видео -->
											<script>
												$(document).ready(function() {
													videoInitialWidth = parseInt($('#kv_video_top iframe').attr("width"));
													videoInitialHeight = parseInt($('#kv_video_top iframe').attr("height"));
													$('#kv_video_top iframe').css('max-width', videoInitialWidth);
													$('#kv_video_top iframe').css('max-height', videoInitialHeight);
													videoAspectRatio = videoInitialHeight / videoInitialWidth;
													//$('.description').css('max-width', '100%');
													//$('.description iframe').css('max-width', '100%');
													//$('.description img').css('max-width', '100%');
													$(window).resize(function(){
														var videoWidth = parseInt($('#kv_video_top').outerWidth());
														var videoHeight = parseInt(videoWidth*videoAspectRatio);
														$('#kv_video_top iframe').attr('width', videoWidth);
														$('#kv_video_top iframe').attr('height', videoHeight);
													});
												});
											</script>
											<?
											
											$videoFrame = str_replace('frameborder="0"', 'style="border:0px"', $arResult["PROPERTIES"]["video_new"]["~VALUE"][0]["TEXT"]);
											echo $videoFrame;
												
											?>
										</div>
									<? } else {?>
										<meta content="<?=$arResult['DETAIL_PICTURE']['SRC']?>" itemprop="image" />
										<meta content="<?=$arResult['DETAIL_PICTURE']['SRC']?>" property="og:image" />
										<a rel="lightbox" class="catalog-detail-images" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>"> 
											<img class="test_class" src="<?=$arResult['DETAIL_IMG']['SRC']?>" width="<?=$arResult['DETAIL_IMG']['WIDTH']?>" height="<?=$arResult['DETAIL_IMG']['HEIGHT']?>" alt="<?=$arResult['NAME']?>" />
											<div class="sticker">
												<?=$sticker?>
											</div>
											<?if(!empty($arResult["PROPERTIES"]["MANUFACTURER"]["PREVIEW_IMG"]["SRC"])):?>
												<img class="manufacturer" src="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['SRC']?>" width="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['WIDTH']?>" height="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arResult['PROPERTIES']['MANUFACTURER']['NAME']?>" />
											<?endif;?>
										</a>
									<? } ?>
							</div>
						<?else:?>
							<div class="detail_picture">
								<meta content="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" itemprop="image" />
								<meta content="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" property="og:image" />
								<div class="catalog-detail-images">
									<img src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" width="150" height="150" alt="<?=$arResult['NAME']?>" />
									<div class="sticker">
										<?=$sticker?>
									</div>
									<?if(!empty($arResult["PROPERTIES"]["MANUFACTURER"]["PREVIEW_IMG"]["SRC"])):?>
										<img class="manufacturer" src="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['SRC']?>" width="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['WIDTH']?>" height="<?=$arResult['PROPERTIES']['MANUFACTURER']['PREVIEW_IMG']['HEIGHT']?>" alt="<?=$arResult['PROPERTIES']['MANUFACTURER']['NAME']?>" />
									<?endif;?>
								</div>
							</div>
						<?endif;
					endif;?>
				</div>
				<?if(!empty($arResult["PROPERTIES"]["video_new"]) || count($arResult["MORE_PHOTO"])>0):?>
					<div class="clr"></div>
					<div class="more_photo">
						<ul>
							<?if(!empty($arResult["PROPERTIES"]["video_new"]["~VALUE"][1])):?>
								<? foreach($arResult["PROPERTIES"]["video_new"]["~VALUE"] as $vkey => $arVideo) { 
									if($vkey == 0) continue;
									$vCode = preg_replace("/^.*\"https:\/\/www\.youtube\.com\/embed\/([a-zA-Z0-9_\-]+)\".*$/", "$1", $arVideo["TEXT"]);
								?>
								<li class="catalog-detail-video" style="width:120px;background-image:url('http://img.youtube.com/vi/<?=$vCode?>/default.jpg')">
									<a rel="lightbox" class="catalog-detail-images" href="#video<?=$vkey?>" style="width:120px">
										<i class="fa fa-play-circle-o" style="color:#9cc218"></i>
										<span style="color:#9cc218"><?=GetMessage("CATALOG_ELEMENT_VIDEO")?></span>
									</a>
									<div id="video<?=$vkey?>">
										<?

											$videoFrame = str_replace('frameborder="0"', 'style="border:0px"', $arVideo["TEXT"]);
											echo $videoFrame;
						
										?>
									</div>
								</li>
								
								<? } ?>
							<?endif;
							
							if(!empty($arResult["PROPERTIES"]["video_new"]["~VALUE"][0]["TEXT"])) 
							{
								$img_resized = CFile::ResizeImageGet(
										$arResult['DETAIL_PICTURE'],
										array('width'=>'86', 'height'=>'86'),
										BX_RESIZE_IMAGE_PROPORTIONAL,
										true
									);
								?>
								<li>
										<meta content="<?=$arResult['DETAIL_PICTURE']['SRC']?>" property="og:image" />
										<a rel="lightbox" class="catalog-detail-images" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>">
											<img src="<?=$img_resized['src']?>" width="<?=$img_resized['width']?>" height="<?=$img_resized['height']?>" alt="<?=$arResult['NAME']?>" />
										</a>
									</li>
								<?
							}
							
							if(count($arResult["MORE_PHOTO"]) > 0):
								foreach($arResult["MORE_PHOTO"] as $PHOTO):?>
									<li>
										<meta content="<?=$PHOTO['SRC']?>" property="og:image" />
										<a rel="lightbox" class="catalog-detail-images" href="<?=$PHOTO['SRC']?>">
											<img src="<?=$PHOTO['PREVIEW']['SRC']?>" width="<?=$PHOTO['PREVIEW']['WIDTH']?>" height="<?=$PHOTO['PREVIEW']['HEIGHT']?>" alt="<?=$arResult['NAME']?>" />
										</a>
									</li>
								<?endforeach;
							endif;?>
						</ul>
					</div>
				<?endif?>
			</div>
		</div>
		<div class="column second">
			<div class="price_buy_detail" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<div class="catalog-detail-price" id="<?=$arItemIDs['PRICE'];?>">
					<?if(isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):
						foreach($arResult["OFFERS"] as $key => $arOffer):?>
							<div id="detail_price_<?=$arOffer['ID']?>" class="detail_price <?=$arResult['ID']?> hidden">
								<?foreach($arOffer["PRICES"] as $code => $arPrice):
									if($arPrice["MIN_PRICE"] == "Y"):
										if($arPrice["CAN_ACCESS"]):
											
											$price = CCurrencyLang::GetCurrencyFormat($arPrice["CURRENCY"], "ru");
											if(empty($price["THOUSANDS_SEP"])):
												$price["THOUSANDS_SEP"] = " ";
											endif;
											$currency = str_replace("#", " ", $price["FORMAT_STRING"]);

											if($arPrice["VALUE"] == 0):
												$arResult["OFFERS"][$key]["ASK_PRICE"] = 1;?>										
												<span class="catalog-detail-item-no-price">
													<?=GetMessage("CATALOG_ELEMENT_NO_PRICE")?>
													<?=(!empty($arOffer["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arOffer["CATALOG_MEASURE_NAME"] : "";?>
												</span>																				
											<?elseif($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
												<span class="catalog-detail-item-price-old">
													<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
													<?=$currency;?>
												</span>
												<span class="catalog-detail-item-price-percent">
													<?=GetMessage('CATALOG_ELEMENT_SKIDKA')." ".$arPrice["PRINT_DISCOUNT_DIFF"];?>
												</span>
												<span class="catalog-detail-item-price">
													<?=number_format($arPrice["DISCOUNT_VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
													<span class="unit">
														<?=$currency?>
														<?=(!empty($arOffer["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arOffer["CATALOG_MEASURE_NAME"] : "";?>
													</span>
												</span>
												<meta itemprop="price" content="<?=$arPrice['DISCOUNT_VALUE']?>" />
												<meta itemprop="priceCurrency" content="<?=$arPrice['CURRENCY']?>" />
											<?else:?>											
												<span class="catalog-detail-item-price">
													<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
													<span class="unit">
														<?=$currency?>
														<?=(!empty($arOffer["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arOffer["CATALOG_MEASURE_NAME"] : "";?>
													</span>
												</span>
												<meta itemprop="price" content="<?=$arPrice['VALUE']?>" />
												<meta itemprop="priceCurrency" content="<?=$arPrice['CURRENCY']?>" />
											<?endif;
										endif;
									endif;
								endforeach;?>
								<div class="available">
									<?if($arOffer["CAN_BUY"]):?>
										<meta content="InStock" itemprop="availability" />
										<div class="avl">
											<i class="fa fa-check-circle"></i>
											<span><?=GetMessage("CATALOG_ELEMENT_AVAILABLE")/*." ".$arOffer["CATALOG_QUANTITY"]*/?></span>
										</div>
									<?elseif(!$arOffer["CAN_BUY"]):?>
										<meta content="OutOfStock" itemprop="availability" />
										<div class="not_avl">
											<i class="fa fa-times-circle"></i>
											<span><?=GetMessage("CATALOG_ELEMENT_NOT_AVAILABLE")?></span>
										</div>
									<?endif;?>
								</div>
							</div>
						<?endforeach;
					else:
						foreach($arResult["PRICES"] as $code => $arPrice):
							if($arPrice["MIN_PRICE"] == "Y"):
								if($arPrice["CAN_ACCESS"]):
											
									$price = CCurrencyLang::GetCurrencyFormat($arPrice["CURRENCY"], "ru");
									if(empty($price["THOUSANDS_SEP"])):
										$price["THOUSANDS_SEP"] = " ";
									endif;
									$currency = str_replace("#", " ", $price["FORMAT_STRING"]);

									if($arPrice["VALUE"] == 0):
										$arResult["ASK_PRICE"] = 1;?>										
										<span class="catalog-detail-item-no-price">
											<?=GetMessage("CATALOG_ELEMENT_NO_PRICE")?>
											<?=(!empty($arResult["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arResult["CATALOG_MEASURE_NAME"] : "";?>
										</span>																	
									<?elseif($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
										<span class="catalog-detail-item-price-old">
											<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
											<?=$currency;?>
										</span>
										<span class="catalog-detail-item-price-percent">
											<?=GetMessage('CATALOG_ELEMENT_SKIDKA')." ".$arPrice["PRINT_DISCOUNT_DIFF"];?>
										</span>
										<span class="catalog-detail-item-price">
											<?=number_format($arPrice["DISCOUNT_VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
											<span class="unit">
												<?=$currency?>
												<?=(!empty($arResult["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arResult["CATALOG_MEASURE_NAME"] : "";?>
											</span>
										</span>
										<meta itemprop="price" content="<?=$arPrice['DISCOUNT_VALUE']?>" />
										<meta itemprop="priceCurrency" content="<?=$arPrice['CURRENCY']?>" />
									<?else:?>
										<span class="catalog-detail-item-price">
											<?=number_format($arPrice["VALUE"], $price["DECIMALS"], $price["DEC_POINT"], $price["THOUSANDS_SEP"]);?>
											<span class="unit">
												<?=$currency?>
												<?=(!empty($arResult["CATALOG_MEASURE_NAME"])) ? GetMessage("CATALOG_ELEMENT_UNIT")." ".$arResult["CATALOG_MEASURE_NAME"] : "";?>
											</span>
										</span>
										<meta itemprop="price" content="<?=$arPrice['VALUE']?>" />
										<meta itemprop="priceCurrency" content="<?=$arPrice['CURRENCY']?>" />
									<?endif;
								endif;
							endif;
						endforeach;?>
						<div class="available">
							<?if($arResult["CAN_BUY"]):?>
								<meta content="InStock" itemprop="availability" />
								<div class="avl">
									<i class="fa fa-check-circle"></i>
									<span><?=GetMessage("CATALOG_ELEMENT_AVAILABLE")/*." ".$arResult["CATALOG_QUANTITY"]*/?></span>
								</div>
							<?elseif(!$arResult["CAN_BUY"]):?>
								<meta content="OutOfStock" itemprop="availability" />
								<div class="not_avl">
									<i class="fa fa-times-circle"></i>
									<span><?=GetMessage("CATALOG_ELEMENT_NOT_AVAILABLE")?></span>
								</div>
							<?endif;?>
						</div>
					<?endif;?>
				</div>
				<div class="catalog-detail-buy" id="<?=$arItemIDs['BUY'];?>">
					<?if(isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):
						foreach($arResult["OFFERS"] as $key => $arOffer):?>
							<div id="buy_more_detail_<?=$arOffer['ID']?>" class="buy_more_detail <?=$arResult['ID']?> hidden">
								<?if($arOffer["CAN_BUY"]):
									if($arOffer["ASK_PRICE"]):?>
										<a class="btn_buy apuo_detail" id="ask_price_anch_<?=$arOffer['ID']?>" href="javascript:void(0)" rel="nofollow"><i class="fa fa-comment-o"></i><?=GetMessage("CATALOG_ELEMENT_ASK_PRICE")?></a>
										<?$properties = false;
										foreach($arOffer["DISPLAY_PROPERTIES"] as $propOffer) {
											$properties[] = $propOffer["NAME"].": ".strip_tags($propOffer["DISPLAY_VALUE"]);
										}
										$properties = implode("; ", $properties);
										if(!empty($properties)):
											$offer_name = $arResult["NAME"]." (".$properties.")";
										else:
											$offer_name = $arResult["NAME"];
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
											<form action="<?=SITE_DIR?>ajax/add2basket.php" class="add2basket_form" id="add2basket_form_<?=$arOffer['ID']?>">
												<div class="qnt_cont">
													<a href="javascript:void(0)" class="minus" onclick="if (BX('quantity_<?=$arOffer["ID"]?>').value > <?=$arOffer["CATALOG_MEASURE_RATIO"]?>) BX('quantity_<?=$arOffer["ID"]?>').value = parseFloat(BX('quantity_<?=$arOffer["ID"]?>').value)-<?=$arOffer["CATALOG_MEASURE_RATIO"]?>;"><span>-</span></a>
													<input type="text" id="quantity_<?=$arOffer['ID']?>" name="quantity" class="quantity" value="<?=$arOffer['CATALOG_MEASURE_RATIO']?>"/>
													<a href="javascript:void(0)" class="plus" onclick="BX('quantity_<?=$arOffer["ID"]?>').value = parseFloat(BX('quantity_<?=$arOffer["ID"]?>').value)+<?=$arOffer["CATALOG_MEASURE_RATIO"]?>;"><span>+</span></a>
												</div>
												<input type="hidden" name="ID" class="offer_id" value="<?=$arOffer['ID']?>" />
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
												<?if(!empty($arResult["SELECT_PROPS"])):?>
													<input type="hidden" name="SELECT_PROPS" id="select_props_<?=$arOffer['ID']?>" value="" />													
												<?endif;?>
												<?if(!empty($arOffer["PREVIEW_IMG"]["SRC"])):?>							
													<input type="hidden" name="item_image" class="item_image" value="&lt;img class='item_image' src='<?=$arOffer["PREVIEW_IMG"]["SRC"]?>' alt='<?=$arResult["NAME"]?>'/&gt;"/>
												<?else:?>
													<input type="hidden" name="item_image" class="item_image" value="&lt;img class='item_image' src='<?=$arResult["PREVIEW_IMG"]["SRC"]?>' alt='<?=$arResult["NAME"]?>'/&gt;"/>
												<?endif;?>
												<input type="hidden" name="item_title" class="item_title" value="<?=$arResult['NAME']?>"/>												
												<input type="hidden" name="item_props" class="item_props" value="
													<?foreach($arOffer["DISPLAY_PROPERTIES"] as $propOffer): 
														echo '&lt;span&gt;'.$propOffer["NAME"].': '.strip_tags($propOffer["DISPLAY_VALUE"]).'&lt;/span&gt;';
													endforeach;?>
												"/>
												<button type="submit" name="add2basket" class="btn_buy detail" value="<?=GetMessage('CATALOG_ELEMENT_ADD_TO_CART')?>"><i class="fa fa-shopping-cart"></i><?=GetMessage('CATALOG_ELEMENT_ADD_TO_CART')?></button>
												<small class="result detail hidden"><i class="fa fa-check"></i><?=GetMessage('CATALOG_ELEMENT_ADDED')?></small>
											</form>
											<button name="boc_anch" id="boc_anch_<?=$arOffer['ID']?>" class="btn_buy boc_anch" value="<?=GetMessage('CATALOG_ELEMENT_BOC')?>"><i class="fa fa-bolt"></i><?=GetMessage('CATALOG_ELEMENT_BOC')?></button>
											<?$APPLICATION->IncludeComponent("altop:buy.one.click", ".default", 
												array(
													"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
													"IBLOCK_ID" => $arParams["IBLOCK_ID"],
													"ELEMENT_ID" => $arOffer["ID"],
													"ELEMENT_PROPS" => $props,
													"REQUIRED_ORDER_FIELDS" => array(
														0 => "NAME",
														1 => "TEL",
													),
													"DEFAULT_PERSON_TYPE" => "1",
													"DEFAULT_DELIVERY" => "0",
													"DEFAULT_PAYMENT" => "0",
													"DEFAULT_CURRENCY" => "RUB",
													"BUY_MODE" => "ONE",
													"PRICE_ID" => "1",
													"DUPLICATE_LETTER_TO_EMAILS" => array(
														0 => "a",
													),
												),
												false,
												array("HIDE_ICONS" => "Y")
											);?>
										</div>
									<?endif;
								elseif(!$arOffer["CAN_BUY"]):?>
									<a class="btn_buy apuo_detail" id="order_anch_<?=$arOffer['ID']?>" href="javascript:void(0)" rel="nofollow"><i class="fa fa-clock-o"></i><?=GetMessage("CATALOG_ELEMENT_UNDER_ORDER")?></a>
									<?$properties = false;
									foreach($arOffer["DISPLAY_PROPERTIES"] as $propOffer) {
										$properties[] = $propOffer["NAME"].": ".strip_tags($propOffer["DISPLAY_VALUE"]);
									}
									$properties = implode("; ", $properties);
									if(!empty($properties)):
										$offer_name = $arResult["NAME"]." (".$properties.")";
									else:
										$offer_name = $arResult["NAME"];
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
									<?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", "", 
										array(
											"NOTIFY_ID" => $arOffer["ID"],
											"NOTIFY_URL" => htmlspecialcharsback($arOffer["SUBSCRIBE_URL"]),
											"NOTIFY_USE_CAPTHA" => "Y"
										),									
										false
									);?>
								<?endif;?>								
							</div>
						<?endforeach;
					else:?>
						<div class="buy_more_detail">
							<?if($arResult["CAN_BUY"]):
								if($arResult["ASK_PRICE"]):?>
									<a class="btn_buy apuo_detail" id="ask_price_anch_<?=$arResult['ID']?>" href="javascript:void(0)" rel="nofollow"><i class="fa fa-comment-o"></i><?=GetMessage("CATALOG_ELEMENT_ASK_PRICE")?></a>
									<?$APPLICATION->IncludeComponent("altop:ask.price", "",
										Array(
											"ELEMENT_ID" => $arResult["ID"],		
											"ELEMENT_NAME" => $arResult["NAME"],
											"EMAIL_TO" => "",				
											"REQUIRED_FIELDS" => array("NAME", "TEL", "TIME")
										),
										false
									);?>
								<?elseif(!$arResult["ASK_PRICE"]):?>
									<form action="<?=SITE_DIR?>ajax/add2basket.php" class="add2basket_form" id="add2basket_form_<?=$arResult['ID']?>">
										<div class="qnt_cont">
											<a href="javascript:void(0)" class="minus" onclick="if(BX('quantity_<?=$arResult["ID"]?>').value > <?=$arResult["CATALOG_MEASURE_RATIO"]?>) BX('quantity_<?=$arResult["ID"]?>').value = parseFloat(BX('quantity_<?=$arResult["ID"]?>').value)-<?=$arResult["CATALOG_MEASURE_RATIO"]?>;"><span>-</span></a>
											<input type="text" id="quantity_<?=$arResult['ID']?>" name="quantity" class="quantity" value="<?=$arResult['CATALOG_MEASURE_RATIO']?>"/>
											<a href="javascript:void(0)" class="plus" onclick="BX('quantity_<?=$arResult["ID"]?>').value = parseFloat(BX('quantity_<?=$arResult["ID"]?>').value)+<?=$arResult["CATALOG_MEASURE_RATIO"]?>;"><span>+</span></a>
										</div>
										<input type="hidden" name="ID" class="id" value="<?=$arResult['ID']?>" />
										<?if(!empty($arResult["SELECT_PROPS"])):?>
											<input type="hidden" name="SELECT_PROPS" id="select_props_<?=$arResult['ID']?>" value="" />											
										<?endif;?>												
										<input type="hidden" name="item_image" class="item_image" value="&lt;img class='item_image' src='<?=$arResult["PREVIEW_IMG"]["SRC"]?>' alt='<?=$arResult["NAME"]?>'/&gt;"/>
										<input type="hidden" name="item_title" class="item_title" value="<?=$arResult['NAME']?>"/>	
										<button type="submit" name="add2basket" class="btn_buy detail" value="<?=GetMessage('CATALOG_ELEMENT_ADD_TO_CART')?>"><i class="fa fa-shopping-cart"></i><?=GetMessage('CATALOG_ELEMENT_ADD_TO_CART')?></button>
										
										<button type="submit" name="add2basket" class="btn_buy kupivkredit_button" value="<?=GetMessage('CATALOG_ELEMENT_ADD_TO_CART')?>"><span class="kpv-logo">КупиВкредит</span></button>
<meta content="/images/tcs_promo.png" property="og:image">
<a rel="lightbox" href="/images/tcs_promo.png" class="btn_buy kupivkredit_info tks_ifo"><img src="/images/info_ico_tcs.png" title="tsc logo" alt="tsc logo"></a>
<script type="text/javascript">
$(document).ready(function(){
	$("a.tks_ifo").fancybox();
});
</script>
										
										
										<small class="result detail hidden"><i class="fa fa-check"></i><?=GetMessage('CATALOG_ELEMENT_ADDED')?></small>								
									</form>									
									<button name="boc_anch" id="boc_anch_<?=$arResult['ID']?>" class="btn_buy boc_anch" value="<?=GetMessage('CATALOG_ELEMENT_BOC')?>"><i class="fa fa-bolt"></i><?=GetMessage('CATALOG_ELEMENT_BOC')?></button>
									<?$APPLICATION->IncludeComponent("altop:buy.one.click", ".default", 
										array(
											"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
											"IBLOCK_ID" => $arParams["IBLOCK_ID"],
											"ELEMENT_ID" => $arResult["ID"],
											"ELEMENT_PROPS" => "",
											"REQUIRED_ORDER_FIELDS" => array(
												0 => "NAME",
												1 => "TEL",
											),
											"DEFAULT_PERSON_TYPE" => "1",
											"DEFAULT_DELIVERY" => "0",
											"DEFAULT_PAYMENT" => "0",
											"DEFAULT_CURRENCY" => "RUB",
											"BUY_MODE" => "ONE",
											"PRICE_ID" => "1",
											"DUPLICATE_LETTER_TO_EMAILS" => array(
												0 => "a",
											),
										),
										false
									);?>
								<?endif;
							elseif(!$arResult["CAN_BUY"]):?>
								<a class="btn_buy apuo_detail" id="order_anch_<?=$arResult['ID']?>" href="javascript:void(0)" rel="nofollow"><i class="fa fa-clock-o"></i><?=GetMessage("CATALOG_ELEMENT_UNDER_ORDER")?></a>
								<?$APPLICATION->IncludeComponent("altop:ask.price", "order",
									Array(
										"ELEMENT_ID" => $arResult["ID"],		
										"ELEMENT_NAME" => $arResult["NAME"],
										"EMAIL_TO" => "",				
										"REQUIRED_FIELDS" => array("NAME", "TEL", "TIME")
									),
									false
								);?>
								<?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", "", 
									array(
										"NOTIFY_ID" => $arResult["ID"],
										"NOTIFY_URL" => htmlspecialcharsback($arResult["SUBSCRIBE_URL"]),
										"NOTIFY_USE_CAPTHA" => "Y"
									),									
									false
								);?>
							<?endif;?>										
						</div>
					<?endif;?>					
				</div>				
				
				<!--div style="float:right; clear: right; margin: 5px 20px 0 0;">
				<form action="<?=SITE_DIR?>ajax/add2basket.php" class="add2basket_form" id="add2basket_form_<?=$arResult['ID']?>">
					<button type="submit" name="add2basket" class="btn_buy kupivkredit_button" value="<?=GetMessage('CATALOG_ELEMENT_ADD_TO_CART')?>"><span class="kpv-logo">КупиВкредит</span></button>
				</form>
				</div-->

				
				<div class="compare_delay">
					<?if($arParams["USE_COMPARE"]=="Y"):?>
						<div class="compare">
							<a href="javascript:void(0)" class="catalog-item-compare" id="catalog_add2compare_link_<?=$arResult['ID']?>" onclick="return addToCompare('<?=$arResult["COMPARE_URL"]?>', 'catalog_add2compare_link_<?=$arResult["ID"]?>');" rel="nofollow"><span class="compare_cont"><i class="fa fa-bar-chart"></i><i class="fa fa-check"></i><span class="compare_text"><?=GetMessage('CATALOG_ELEMENT_ADD_TO_COMPARE')?></span></span></a>
						</div>
					<?endif;?>
					<div class="catalog-detail-delay" id="<?=$arItemIDs['DELAY']?>">
						<?if(isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):
							foreach($arResult["OFFERS"] as $key => $arOffer):
								if($arOffer["CAN_BUY"]):
									foreach($arOffer["PRICES"] as $code => $arPrice):
										if($arPrice["MIN_PRICE"] == "Y"):
											if($arPrice["VALUE"] > 0):
												$props = array();
												foreach($arOffer["DISPLAY_PROPERTIES"] as $propOffer) {
													$props[] = array(
														"NAME" => $propOffer["NAME"],
														"CODE" => $propOffer["CODE"],
														"VALUE" => strip_tags($propOffer["DISPLAY_VALUE"])
													);
												}
												$props = strtr(base64_encode(addslashes(gzcompress(serialize($props),9))), '+/=', '-_,');?>
												<div id="delay_<?=$arOffer['ID']?>" class="delay <?=$arResult['ID']?> hidden">
													<a href="javascript:void(0)" id="catalog-item-delay-<?=$arOffer['ID']?>" class="catalog-item-delay" onclick="return addToDelay('<?=$arOffer["ID"]?>', '<?=$arOffer["CATALOG_MEASURE_RATIO"]?>', '<?=$props?>', '', 'catalog-item-delay-<?=$arOffer["ID"]?>')" rel="nofollow"><span class="delay_cont"><i class="fa fa-heart-o"></i><i class="fa fa-check"></i><span class="delay_text"><?=GetMessage('CATALOG_ELEMENT_ADD_TO_DELAY')?></span></span></a>
												</div>
											<?endif;
										endif;
									endforeach;
								endif;
							endforeach;
						else:
							if($arResult["CAN_BUY"]):
								foreach($arResult["PRICES"] as $code => $arPrice):
									if($arPrice["MIN_PRICE"] == "Y"):
										if($arPrice["VALUE"] > 0):?>
											<div class="delay">
												<a href="javascript:void(0)" id="catalog-item-delay-<?=$arResult['ID']?>" class="catalog-item-delay" onclick="return addToDelay('<?=$arResult["ID"]?>', '<?=$arResult["CATALOG_MEASURE_RATIO"]?>', '', '', 'catalog-item-delay-<?=$arResult["ID"]?>')" rel="nofollow"><span class="delay_cont"><i class="fa fa-heart-o"></i><i class="fa fa-check"></i><span class="delay_text"><?=GetMessage('CATALOG_ELEMENT_ADD_TO_DELAY')?></span></span></a>
											</div>
										<?endif;
									endif;
								endforeach;
							endif;
						endif?>
					</div>
				</div>
			</div>			
			
			<div class="article_rating">
				<div class="article">
					<?=GetMessage("CATALOG_ELEMENT_ARTNUMBER")?><?=!empty($arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]) ? $arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"] : "-";?>
				</div>
				<div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
					<?$APPLICATION->IncludeComponent("bitrix:iblock.vote", "ajax",
						Array(
							"DISPLAY_AS_RATING" => "vote_avg",
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"ELEMENT_ID" => $arResult["ID"],
							"ELEMENT_CODE" => "",
							"MAX_VOTE" => "5",
							"VOTE_NAMES" => array("1","2","3","4","5"),
							"SET_STATUS_404" => "N",
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_NOTES" => "",
							"READ_ONLY" => "N"
						),
						false
					);?>
					<?if($arResult["PROPERTIES"]["vote_count"]["VALUE"]):?>
						<meta content="<?=round($arResult['PROPERTIES']['vote_sum']['VALUE']/$arResult['PROPERTIES']['vote_count']['VALUE'], 2);?>" itemprop="ratingValue" />
						<meta content="<?=$arResult['PROPERTIES']['vote_count']['VALUE']?>" itemprop="ratingCount" />
					<?else:?>
					<? /*
						<meta content="0" itemprop="ratingValue" />
						<meta content="0" itemprop="ratingCount" />
					*/ ?>
					<?endif;?>					
				</div>				
			</div>			
			
			<?/*if(!empty($arResult["PREVIEW_TEXT"])):?>
				<meta content="<?=strip_tags($arResult['PREVIEW_TEXT'])?>" property="og:description" />
				<div class="catalog-detail-preview-text" itemprop="description">
					<?=$arResult["PREVIEW_TEXT"]?>
				</div>
			<?endif;*/?>
	
	<?global $LOCATION_CITY_ID, $LOCATION_CITY_NAME; //echo $LOCATION_CITY_NAME;
		
	?>		
			
			<?$APPLICATION->IncludeComponent("m24:deliveryblock", ".default", 
				array(
				"SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
				"PRODUCT_PRICE" => $arPrice["VALUE"]
				)
				,false );?>			
			
			
			<?if(isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"]) && !empty($arResult["OFFERS_PROP"])) {
				$arSkuProps = array();?>
				<div class="catalog-detail-offers" id="<?=$arItemIDs['PROP_DIV'];?>">
					<?foreach($arResult["SKU_PROPS"] as &$arProp) {
						if(!isset($arResult["OFFERS_PROP"][$arProp["CODE"]]))
							continue;
						$arSkuProps[] = array(
							"ID" => $arProp["ID"],
							"SHOW_MODE" => $arProp["SHOW_MODE"]
						);?>
						<div class="offer_block" id="<?=$arItemIDs['PROP'].$arProp['ID'];?>_cont">
							<div class="h3"><?=htmlspecialcharsex($arProp["NAME"]);?></div>
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
						</div>
					<?}
					unset($arProp);?>
				</div>
			<?}?>
			
			<?if(isset($arResult["SELECT_PROPS"]) && !empty($arResult["SELECT_PROPS"])):
				$arSelProps = array();?>
				<div class="catalog-detail-offers" id="<?=$arItemIDs['SELECT_PROP_DIV'];?>">
					<?foreach($arResult["SELECT_PROPS"] as $key => $arProp):
						$arSelProps[] = array(
							"ID" => $arProp["ID"]
						);?>
						<div class="offer_block" id="<?=$arItemIDs['SELECT_PROP'].$arProp['ID'];?>">
							<div class="h3"><?=htmlspecialcharsex($arProp["NAME"]);?></div>
							<ul class="<?=$arProp['CODE']?>">
								<?$props = array();
								foreach($arProp["DISPLAY_VALUE"] as $arOneValue) {
									$props[$key] = array(
										"NAME" => $arProp["NAME"],
										"CODE" => $arProp["CODE"],
										"VALUE" => strip_tags($arOneValue)
									);
									$props[$key] = strtr(base64_encode(addslashes(gzcompress(serialize($props[$key]),9))), '+/=', '-_,');?>
									<li data-select-onevalue="<?=$props[$key]?>">
										<span title="<?=$arOneValue;?>"><?=$arOneValue?></span>
									</li>
								<?}?>
							</ul>
						</div>
					<?endforeach;
					unset($arProp);?>
				</div>
			<?endif;?>
									
			<?/*if(!empty($arResult["DISPLAY_PROPERTIES"])):?>
				<div class="catalog-detail-properties">
					<div class="h4"><?=GetMessage("CATALOG_ELEMENT_PROPERTIES")?></div>
					<?foreach($arResult["DISPLAY_PROPERTIES"] as $k => $v):?>
						<div class="catalog-detail-property">
							<span class="name"><?=$v["NAME"]?></span> 
							<span class="val"><?=is_array($v["DISPLAY_VALUE"]) ? implode(", ", $v["DISPLAY_VALUE"]) : $v["DISPLAY_VALUE"];?></span>
						</div>
					<?endforeach;?>
				</div>
			<?endif;*/?>	

<div class="catalog-detail-properties">
<?  
if(!empty($arResult[PROPERTIES][P19][VALUE][0])) {
$ste=0;
 ?>

<div class="catalog-detail-property picprop">
<span class="namepic"><? echo $arResult[PROPERTIES][P19][NAME]; ?></span> 
<div class="picsliderso">
<? foreach($arResult[PROPERTIES][P19][VALUE] as $prod1) { ?>
<img class="tooltipza" title="<? echo $prod1; ?>"  alt="<? echo $prod1; ?>" src="/upload/pictovar/<? echo $arResult[PROPERTIES][P19][VALUE_ENUM_ID][$ste]; ?>.png">
<?
$ste++;
 } 
$ste=0;
?>
</div>


</div>

<? } ?>



<?  
if(!empty($arResult[PROPERTIES][P20][VALUE][0])) {
$ste=0;
 ?>

<div class="catalog-detail-property picprop">
<span class="namepic"><? echo $arResult[PROPERTIES][P20][NAME]; ?></span> 
<div class="picsliderso">
<? foreach($arResult[PROPERTIES][P20][VALUE] as $prod1) { ?>
<img class="tooltipza" title="<? echo $prod1; ?>"  alt="<? echo $prod1; ?>" src="/upload/pictovar/<? echo $arResult[PROPERTIES][P20][VALUE_ENUM_ID][$ste]; ?>.png">
<?
$ste++;
 } 
$ste=0;
?>
</div>


</div>

<? } ?>



<?  
if(!empty($arResult[PROPERTIES][P21][VALUE][0])) {
$ste=0;
 ?>

<div class="catalog-detail-property picprop">
<span class="namepic"><? echo $arResult[PROPERTIES][P21][NAME]; ?></span> 
<div class="picsliderso">
<? foreach($arResult[PROPERTIES][P21][VALUE] as $prod1) { ?>
<img class="tooltipza" title="<? echo $prod1; ?>"  alt="<? echo $prod1; ?>" src="/upload/pictovar/<? echo $arResult[PROPERTIES][P21][VALUE_ENUM_ID][$ste]; ?>.png">
<?
$ste++;
 } 
$ste=0;
?>
</div>


</div>

<? } ?>


<?  
if(!empty($arResult[PROPERTIES][P22][VALUE][0]) || !empty($arResult[PROPERTIES][P17][VALUE]) || !empty($arResult[PROPERTIES][P18][VALUE]) || !empty($arResult[PROPERTIES][P36][VALUE]) || !empty($arResult[PROPERTIES][P37][VALUE]) || !empty($arResult[PROPERTIES][P39][VALUE]) ) {
$ste=0;
 ?>

<div class="catalog-detail-property picprop">
<span class="namepic">Функционал</span> 
<div class="picsliderso">


<? foreach($arResult[PROPERTIES][P22][VALUE] as $prod1) { ?>
<img class="tooltipza" title="<? echo $prod1; ?>"  alt="<? echo $prod1; ?>" src="/upload/pictovar/<? echo $arResult[PROPERTIES][P22][VALUE_ENUM_ID][$ste]; ?>.png">
<?
$ste++;
 } 
$ste=0;


if(!empty($arResult[PROPERTIES][P17][VALUE])) { 
echo '<img class="tooltipza" title="'.$arResult[PROPERTIES][P17][NAME].'"  alt="'.$arResult[PROPERTIES][P17][NAME].'" src="/upload/pictovar/'.$arResult[PROPERTIES][P17][VALUE_ENUM_ID].'.png">';
 }
if(!empty($arResult[PROPERTIES][P18][VALUE])) { 
echo '<img class="tooltipza" title="'.$arResult[PROPERTIES][P18][NAME].'"  alt="'.$arResult[PROPERTIES][P18][NAME].'" src="/upload/pictovar/'.$arResult[PROPERTIES][P18][VALUE_ENUM_ID].'.png">';
 }
if(!empty($arResult[PROPERTIES][P36][VALUE])) { 
echo '<img class="tooltipza" title="'.$arResult[PROPERTIES][P36][NAME].'"  alt="'.$arResult[PROPERTIES][P36][NAME].'" src="/upload/pictovar/'.$arResult[PROPERTIES][P36][VALUE_ENUM_ID].'.png">';
 }
if(!empty($arResult[PROPERTIES][P37][VALUE])) { 
echo '<img class="tooltipza" title="'.$arResult[PROPERTIES][P37][NAME].'"  alt="'.$arResult[PROPERTIES][P37][NAME].'" src="/upload/pictovar/'.$arResult[PROPERTIES][P37][VALUE_ENUM_ID].'.png">';
 }
if(!empty($arResult[PROPERTIES][P39][VALUE])) { 
echo '<img class="tooltipza" title="'.$arResult[PROPERTIES][P39][NAME].'"  alt="'.$arResult[PROPERTIES][P39][NAME].'" src="/upload/pictovar/'.$arResult[PROPERTIES][P39][VALUE_ENUM_ID].'.png">';
 }

?>
</div>


</div>

<? } ?>

<div class="clear"></div>

</div>
<span style="padding-left:20px; display:block; width:300px"><strong>Подсказка:</strong> Для того, что бы узнать подробнее о функционале наведите на иконку. </span>






			
		</div>
	</div>

	<div class="section">
		<ul class="tabs">
			<li class="current">
				<a href="#tab1"><span><?=GetMessage("CATALOG_ELEMENT_FULL_DESCRIPTION")?></span></a>
			</li>
			<?/*
			<li style="<?if(empty($arResult["PROPERTIES"]["FREE_TAB"]["VALUE"])){ echo 'display:none;'; }?>">
				<a href="#tab2"><span><?=$arResult["PROPERTIES"]["FREE_TAB"]["NAME"]?></span></a>
			</li>*/?>
			<li>
				<a href="#tab2"><span>Характеристики</span></a>
			</li>
            <li>
				<a href="#tab3"><span>Комментарии</span></a>
			</li>

			<li style="<?if(empty($arResult["PROPERTIES"]["ACCESSORIES"]["VALUE"])){ echo 'display:none;'; }?>">
				<a href="#tab4"><span><?=$arResult["PROPERTIES"]["ACCESSORIES"]["NAME"]?></span></a>
			</li>
<!--			<li>-->
<!--				<a href="#tab5"><span>--><?//=GetMessage("CATALOG_ELEMENT_REVIEWS")?><!-- <span class="reviews_count">(--><?//=$arResult["REVIEWS"]["COUNT"]?><!--)</span></span></a>-->
<!--			</li>-->

<?/*   Временно скрытый раздел с магазинами ГДЕ КУПИТЬ
			<li>
				<a href="#tab6"><span><?=GetMessage("CATALOG_ELEMENT_SHOPS")?></span></a>
			</li>
*/?>			
		</ul>
		<div class="box visible">
            <div class="description">
                <!--noindex-->
                <?
                $text = str_replace('#ВГОРОДЕ#', $v_regione, htmlspecialcharsBack($arResult["DETAIL_TEXT"]));
                //mb_regex_encoding("UTF-8");
                //$text = preg_replace('/<(h[1-6]{1})>(.*)<\/h[1-6]{1}>/i', "<div class='$1'>$2</div>", $text);
                echo $text;
                ?>
                <!--/noindex-->
            </div>
		</div>
		<div class="box" style="display:none;">
            <div class="tab_properties">
                <?foreach($arResult["DISPLAY_PROPERTIES"] as $k => $v):?>
                    <div class="catalog-detail-property">
                        <span class="name"><?=$v["NAME"]?></span>
                        <span class="val"><?=is_array($v["DISPLAY_VALUE"]) ? implode(", ", $v["DISPLAY_VALUE"]) : $v["DISPLAY_VALUE"];?></span>
                    </div>
                <?endforeach;?>
            </div>
		</div>
        <div class="box">
            <!-- BEGIN пользовательские комментарии '<?=$arItemIDs['ID']?>' -->
            <div class="section">
                <? // cackle.comments
                $APPLICATION->IncludeComponent("cackle.comments", ".default",
                    array("CHANNEL_ID" => $arResult['ID']),false);
                ?>

                <?/*$APPLICATION->IncludeComponent("bitrix:catalog.comments","",
Array(
        "TEMPLATE_THEME" => "blue",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "39",
        "ELEMENT_ID" => $arResult["ID"],
        "ELEMENT_CODE" => "",
        "URL_TO_COMMENT" => $_SERVER['REQUEST_URI'],
        "WIDTH" => "",
        "COMMENTS_COUNT" => "10",
        "BLOG_USE" => "Y",
        "FB_USE" => "N",
        "VK_USE" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "0",
        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
        "EMAIL_NOTIFY" => "N",
        "AJAX_POST" => "N",
        "SHOW_SPAM" => "Y",
        "SHOW_RATING" => "Y",
        "RATING_TYPE" => "like_graphic",
        "FB_TITLE" => "Facebook",
        "FB_USER_ADMIN_ID" => "100011479263514",
        "FB_APP_ID" => "817461318365626",
        "FB_COLORSCHEME" => "dark",
        "FB_ORDER_BY" => "time",
        "VK_TITLE" => "Вконтакте",
        "VK_API_ID" => "5315693"
    )
);*/
                ?>

            </div>
            <!-- END пользовательские комментарии -->
        </div>
		<div class="box" id="accessories-to" style="<?if(empty($arResult["PROPERTIES"]["ACCESSORIES"]["VALUE"])){ echo 'display:none;'; }?>"></div>
		<div class="box" id="catalog-reviews-to"></div>

		<div class="box">
			<div id="<?=$arItemIDs['STORE'];?>">
				<?if(isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])):
					foreach($arResult["OFFERS"] as $key => $arOffer):?>
						<div id="catalog-detail-stores-<?=$arOffer['ID']?>" class="catalog-detail-stores <?=$arResult['ID']?> hidden">
				
							<?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount",	".default",
								array(
									"ELEMENT_ID" => $arOffer["ID"],
									"STORE_PATH" => $arParams["STORE_PATH"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"MAIN_TITLE" => $arParams["MAIN_TITLE"],
									"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
									"SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
									"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
									"MIN_AMOUNT" => $arParams["MIN_AMOUNT"]
								),
								false,
								array("HIDE_ICONS" => "Y")
							);?>
						</div>
					<?endforeach;
				else:?>
					<div class="catalog-detail-stores">
						<?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount",	".default",
							array(
								"ELEMENT_ID" => $arResult["ID"],
								"STORE_PATH" => $arParams["STORE_PATH"],
								"CACHE_TYPE" => $arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"MAIN_TITLE" => $arParams["MAIN_TITLE"],
								"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
								"SCHEDULE" => $arParams["USE_STORE_SCHEDULE"],
								"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
								"MIN_AMOUNT" => $arParams["MIN_AMOUNT"]
							),
							false,
							array("HIDE_ICONS" => "Y")
						);?>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
	<div class="clr"></div>
</div>

<?if(isset($arResult["OFFERS"]) && !empty($arResult["OFFERS"])) {
	$arJSParams = array(
		"CONFIG" => array(
			"USE_CATALOG" => $arResult["CATALOG"],
		),
		"PRODUCT_TYPE" => $arResult["CATALOG_TYPE"],
		"VISUAL" => array(
			"ID" => $arItemIDs["ID"],
			"PICT_ID" => $arItemIDs["PICT"],
			"PRICE_ID" => $arItemIDs["PRICE"],
			"BUY_ID" => $arItemIDs["BUY"],
			"DELAY_ID" => $arItemIDs["DELAY"],
			"STORE_ID" => $arItemIDs["STORE"],
			"TREE_ID" => $arItemIDs["PROP_DIV"],
			"TREE_ITEM_ID" => $arItemIDs["PROP"],
		),
		"PRODUCT" => array(
			"ID" => $arResult["ID"],
			"NAME" => $arResult["~NAME"]
		),
		"OFFERS" => $arResult["JS_OFFERS"],
		"OFFER_SELECTED" => $arResult["OFFERS_SELECTED"],
		"TREE_PROPS" => $arSkuProps
	);
} else {
	$arJSParams = array(
		"CONFIG" => array(
			"USE_CATALOG" => $arResult["CATALOG"]
		),
		"PRODUCT_TYPE" => $arResult["CATALOG_TYPE"],	
		"VISUAL" => array(
			"ID" => $arItemIDs["ID"],
		),
		"PRODUCT" => array(
			"ID" => $arResult["ID"],
			"NAME" => $arResult["~NAME"]
		)
	);	
}

if(isset($arResult["SELECT_PROPS"]) && !empty($arResult["SELECT_PROPS"])) {
	$arJSParams["VISUAL"]["SELECT_PROP_ID"] = $arItemIDs["SELECT_PROP_DIV"];
	$arJSParams["VISUAL"]["SELECT_PROP_ITEM_ID"] = $arItemIDs["SELECT_PROP"];
	$arJSParams["SELECT_PROPS"] = $arSelProps;
}?>

<script type="text/javascript">
	var <?=$strObName;?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($arJSParams, false, true);?>);
	BX.message({
		SITE_ID: "<?=SITE_ID;?>"
	});
</script>