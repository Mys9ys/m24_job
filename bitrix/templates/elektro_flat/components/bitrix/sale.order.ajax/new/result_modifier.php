<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!CModule::IncludeModule("iblock"))
	return;
//dd($arResult["BASKET_ITEMS"]);
// Эквайринг включен по умолчанию
$arResult["ACQUIRING_AVAILABLE"] = true;
$arResult["credit_line"] = true;
$myself_delivery = true;
/***PICTURE***/
foreach($arResult["BASKET_ITEMS"] as $key => $arBasketItems):
    $profit = $profit + ceil($arBasketItems['DISCOUNT_PRICE'])*ceil($arBasketItems['QUANTITY']);
	$ar = CIBlockElement::GetList(
		array(), 
		array("=ID" => $arBasketItems["PRODUCT_ID"]), 
		false, 
		false, 
		array(
			"ID", 
			"IBLOCK_ID", 
			"NAME", 
			"DETAIL_PICTURE",
			"PROPERTY_CML2_LINK",
			"PROPERTY_ACQUIRING_AVAILABLE",
            "PROPERTY_credit_line",
		)
	)->Fetch();
        // Если есть хотя бы один товар в корзине с отключенным эквайрингом, то платежная система не показывается
        if($ar["PROPERTY_ACQUIRING_AVAILABLE_VALUE"] != 'Y') 
        {
            $arResult["ACQUIRING_AVAILABLE"] = false;
        }

		// Если есть хотя бы один товар в корзине с отключенным эквайрингом, то платежная система не показывается
		if($ar["PROPERTY_CREDIT_LINE_VALUE"] != 'Y')
		{
			$arResult["credit_line"] = false;
		}

	if($ar["DETAIL_PICTURE"] > 0) {
		$ar["DETAIL_PICTURE"] = CFile::ResizeImageGet($ar["DETAIL_PICTURE"], array("width" => 30, "height" => 30), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arResult["BASKET_ITEMS"][$key]["DETAIL_PICTURE"] = $ar["DETAIL_PICTURE"];
	} else {
		if(!empty($ar["PROPERTY_CML2_LINK_VALUE"])) {
			$ar2 = CIBlockElement::GetList(
				array(), 
				array("=ID" => $ar["PROPERTY_CML2_LINK_VALUE"]), 
				false, 
				false, 
				array(
					"ID", 
					"IBLOCK_ID", 
					"NAME", 
					"DETAIL_PICTURE"
				)
			)->Fetch();
			if($ar2["DETAIL_PICTURE"] > 0) {
				$ar2["DETAIL_PICTURE"] = CFile::ResizeImageGet($ar2["DETAIL_PICTURE"], array("width" => 30, "height" => 30), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				$arResult["BASKET_ITEMS"][$key]["DETAIL_PICTURE"] = $ar2["DETAIL_PICTURE"];
			}
		}
	}
endforeach;

/***AUTH_SERVICES***/
$arResult["AUTH_SERVICES"] = false;
if(!$USER->IsAuthorized() && CModule::IncludeModule("socialservices")) {
	$oAuthManager = new CSocServAuthManager();
	$arServices = $oAuthManager->GetActiveAuthServices($arResult);

	if(!empty($arServices)) {
		$arResult["AUTH_SERVICES"] = $arServices;
	}
}?>

<?// Добавляем дополнительные данные в #arResult
foreach($arResult["BASKET_ITEMS"] as $key => $arBasketItems):
$Iblock_product = 39;
$res = CIBlockElement::GetList(
    Array(),
    Array("IBLOCK_ID"=>$Iblock_product,
        'ID' => $arBasketItems["PRODUCT_ID"]
    ),
    false,
    false,
    array());
while($ob = $res->GetNextElement())
{
    $product = $ob->GetFields();

    $product["PROPERTIES"] = $ob->GetProperties();
    $arResult["BASKET_ITEMS"][$key]["old_price"] = CPrice::GetBasePrice($arBasketItems["PRODUCT_ID"])['PRICE'];

    if($product["PROPERTIES"]['MANUFACTURER']['VALUE'] != '923'){
        $myself_delivery = false;
    }
    if(!empty($product["PROPERTIES"]["short_name"]["VALUE"])){
        $arResult["BASKET_ITEMS"][$key]["name"] = $product["PROPERTIES"]["short_name"]["VALUE"];
    } else {
        $arResult["BASKET_ITEMS"][$key]["name"] = $product['NAME'];
    }
    if(!empty($product['PREVIEW_PICTURE'])){
        $arResult["BASKET_ITEMS"][$key]["DETAIL_PICTURE"] = CFile::GetPath($product['PREVIEW_PICTURE']);
    } else {
        $arResult["BASKET_ITEMS"][$key]["DETAIL_PICTURE"] = CFile::GetPath($product['DETAIL_PICTURE']);
    }
//        $result['link']=$product["DETAIL_PAGE_URL"];

}
endforeach;
$arResult['summary_profit'] = $profit;



CModule::IncludeModule('sale');
// Выведем все активные платежные системы для текущего сайта,
$db_ptype = CSalePaySystem::GetList(array("SORT"=>"ASC", "PSA_NAME"=>"ASC"), array("ACTIVE"=>"Y", "PERSON_TYPE_ID"=>1), false, false, array());

while ($ptype = $db_ptype->getNext())
{
    $arPay[] = $ptype['ID'];
    $elem['img'] = CFile::GetPath($ptype['PSA_LOGOTIP']);
    $elem['NAME'] = $ptype['NAME'];
    $elem['DESCRIPTION'] = strip_tags(html_entity_decode($ptype['DESCRIPTION']));
    $elem['ID'] = $ptype['ID'];
    $Pay[$ptype['ID']] = $elem;
}
$arResult['PAY_SYSTEM_NEW'] = $Pay;

// Выберем отсортированные по индексу сортировки, а потом (при равных индексах) по имени
$db_dtype = CSaleDelivery::GetList(
    array(
        "SORT" => "ASC",
    ),
    array(
        "ACTIVE" => "Y",
    ),
    false,
    false,
    array()
);
while ($ar_dtype = $db_dtype->Fetch())
{
    if($ar_dtype['ORDER_PRICE_TO']>0 && $ar_dtype['ORDER_PRICE_TO']<$arResult['ORDER_PRICE']){
        continue;
    }
    if($ar_dtype['ORDER_PRICE_FROM']>0 && $ar_dtype['ORDER_PRICE_FROM']>$arResult['ORDER_PRICE']){
        continue;
    }
    // убираем самовывоз для товаров не casada
    if($myself_delivery == false && $ar_dtype['ID']== 2){
        continue;
    }
    $arDeliv2[$ar_dtype["ID"]] = getPaySystem_m24($ar_dtype["ID"], $arPay);
    $deliv[$ar_dtype["ID"]] = $ar_dtype;
    if(!empty($ar_dtype['PRICE']) && $ar_dtype['PRICE']>0) $arResult['DELIVERY_PRICE']=$ar_dtype['PRICE'];
}

$arResult['DELIVERY'] = $deliv;

function getPaySystem_m24($id,$arPay){
	$pay_string = '';
    $db_dtype = CSaleDelivery::GetDelivery2PaySystem(
        array(
            "ACTIVE" => "Y",
            "DELIVERY_ID" => $id
        )
    );
    while ($ar_dtype = $db_dtype->Fetch())
    {
        if(in_array($ar_dtype['PAYSYSTEM_ID'],$arPay)){
            $pay_string = $pay_string . $ar_dtype['PAYSYSTEM_ID'] . ',';
        }
    }
    return $pay_string;
}

$arResult['DELIVERY_NEW'] = $arDeliv2;

// отключил оплату картой
//$arResult["ACQUIRING_AVAILABLE"] = false;
// удаляяем возможность оплаты картой
if($arResult["ACQUIRING_AVAILABLE"] == false){
    unset($arResult['PAY_SYSTEM']['14']);
    unset($arResult['PAY_SYSTEM_NEW']['14']);
}

// добавляем возможность рассрочки
if($arResult["credit_line"]==true){
//    dd('mi tyt');
    $arResult['PAY_SYSTEM_NEW'][315] = array(
        "img" => "/bitrix/templates/elektro_flat_copy/components/bitrix/sale.order.ajax/new/image/paylate.png",
        "NAME" => "Оплата в рассрочку",
        "DESCRIPTION" => "Возможность оплатить товар в рассрочку (заявка будет рассмотрена одним из 7 банков)",
        "ID" => "315"
    );
    $delivery ='';
    foreach ($arResult['DELIVERY_NEW'] as $key=>$item){
        $delivery[$key] = $item.'315';
    }
    $arResult['DELIVERY_NEW'] = $delivery;
}
?>

