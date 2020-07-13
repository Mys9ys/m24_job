<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if(!empty($arResult["DELIVERY"])):?>
	<div class="order-info">
        <div class="block_basket_title"><?=GetMessage("SOA_TEMPL_DELIVERY")?></div>
        <?$count =1;?>
        <?foreach($arResult["DELIVERY"] as $delivery_id => $arDelivery){?>
            <div class="delivery_item" data-delivery="<?=$delivery_id?>" id="delivery_id_<?=$delivery_id?>" data-paysystem="<?=$arResult['DELIVERY_NEW'][$delivery_id]?>">
                <div class="check_delivery_item"><div class="check_elem_delivery <?if($count == 1) {echo 'delivery_check_elem_active'; $count++; $cheked =$delivery_id;}?>"></div></div>
                <img src="<?=$arDelivery['PSA_LOGOTIP']['SRC']?>" alt="">
                <div class="delivery_info">
                    <div class="name">
                        <?=$arDelivery['NAME']?>
                    </div>
                    <?if($arDelivery['PRICE']>0){?>
                        <span><?echo GetMessage("SALE_DELIV_PRICE")." ".$arDelivery["PRICE_FORMATED"]?></span>
                    <?}?>
                    <p><?=$arDelivery['DESCRIPTION']?>
                    </p>
                </div>
            </div>
        <?}?>
        <input type="hidden" id="DELIVERY_ID" name="DELIVERY_ID" value="<?=$cheked?>">
    </div>
<?endif;?>


