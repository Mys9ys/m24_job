<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock"))
    return;
if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog"))
    return;

$basketProductCount = '';
$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    ),
    false,
    false,
    array()
);

//use Bitrix\Sale\Internals\DiscountTable;
//$res = DiscountTable::getList();
//dd($res);

while ($arItems = $dbBasketItems->Fetch()) {
    if ('' != $arItems['PRODUCT_PROVIDER_CLASS'] || '' != $arItems["CALLBACK_FUNC"]) {
//        dd($arItems);
        $basketProductCount += ceil($arItems["QUANTITY"]);
        CSaleBasket::UpdatePrice($arItems["ID"],
            $arItems["CALLBACK_FUNC"],
            $arItems["MODULE"],
            $arItems["PRODUCT_ID"],
            $arItems["QUANTITY"],
            "N",
            $arItems["PRODUCT_PROVIDER_CLASS"]
        );

        $arResult['ORDER_PRICE'] +=($arItems['PRICE'])*$arItems["QUANTITY"];
        if($arItems['DISCOUNT_PRICE']>0){
            $arResult['summary_old_price'] +=$arItems['old_price'] = ($arItems['PRICE']+$arItems['DISCOUNT_PRICE'])*$arItems["QUANTITY"];
            $arResult['summary_profit'] +=($arItems['DISCOUNT_PRICE'])*$arItems["QUANTITY"];
            $arItems['stickers']['sticker_sale'] = 'Скидка';
        } else {
            $arResult['summary_old_price'] +=$arItems['old_price'] = ($arItems['PRICE'])*$arItems["QUANTITY"];
        }
        $arResult['BASKET_ITEMS'][] = $arItems;
    }
}

$arResult['FUSER_ID'] = CSaleBasket::GetBasketUserID();

// количество товаров в корзине
$arResult["count_poducts"] = $basketProductCount;


// Эквайринг включен по умолчанию
$arResult["ACQUIRING_AVAILABLE"] = true;
$arResult["credit_line"] = true;
$myself_delivery = true;
/***PICTURE***/
foreach ($arResult["BASKET_ITEMS"] as $key => $arBasketItems) {
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
    if ($ar["PROPERTY_ACQUIRING_AVAILABLE_VALUE"] != 'Y') {
        $arResult["ACQUIRING_AVAILABLE"] = false;
    } else {
        $arResult["BASKET_ITEMS"][$key]['stickers']['sticker_credit'] = 'Оплата картой';
    }

// Если есть хотя бы один товар в корзине с отключенным эквайрингом, то платежная система не показывается
    if ($ar["PROPERTY_CREDIT_LINE_VALUE"] != 'Y') {
        $arResult["credit_line"] = false;
    } else {
        $arResult["BASKET_ITEMS"][$key]['stickers']['sticker_card'] = 'Рассрочка';
    }
}?>

<? // Добавляем дополнительные данные в #arResult
foreach ($arResult["BASKET_ITEMS"] as $key => $arBasketItems) {
    $Iblock_product = 39;
    $res = CIBlockElement::GetList(
        Array(),
        Array("IBLOCK_ID" => $Iblock_product,
            'ID' => $arBasketItems["PRODUCT_ID"]
        ),
        false,
        false,
        array());
    while ($ob = $res->GetNextElement()) {
        $product = $ob->GetFields();
        $product["PROPERTIES"] = $ob->GetProperties();

        if($product["PROPERTIES"]['MANUFACTURER']['VALUE'] != '923'){
            $myself_delivery = false;
        }
        if (!empty($product["PROPERTIES"]["short_name"]["VALUE"])) {
            $arResult["BASKET_ITEMS"][$key]["name"] = $product["PROPERTIES"]["short_name"]["VALUE"];
        } else {
            $arResult["BASKET_ITEMS"][$key]["name"] = $product['NAME'];
        }
        if (!empty($product['PREVIEW_PICTURE'])) {
            $arResult["BASKET_ITEMS"][$key]["DETAIL_PICTURE"] = CFile::GetPath($product['PREVIEW_PICTURE']);
        } else {
            $arResult["BASKET_ITEMS"][$key]["DETAIL_PICTURE"] = CFile::GetPath($product['DETAIL_PICTURE']);
        }
//        $result['link']=$product["DETAIL_PAGE_URL"];
    }
}




// Выведем все активные платежные системы для текущего сайта,
$db_ptype = CSalePaySystem::GetList(array("SORT" => "ASC", "PSA_NAME" => "ASC"), array("ACTIVE" => "Y", "PERSON_TYPE_ID" => 1), false, false, array());

while ($ptype = $db_ptype->getNext()) {
    $arPay[] = $ptype['ID'];
    $elem['img'] = CFile::GetPath($ptype['PSA_LOGOTIP']);
    $elem['NAME'] = $ptype['NAME'];
    $elem['DESCRIPTION'] = strip_tags(html_entity_decode($ptype['DESCRIPTION']));
    $elem['ID'] = $ptype['ID'];
    $Pay[$ptype['ID']] = $elem;
}
$arResult['PAY_SYSTEM_NEW'] = $Pay;
//dd($arResult["credit_line"]);


// Выберем способы ддоставки
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
while ($ar_dtype = $db_dtype->Fetch()) {
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
    $arDeliv2[$ar_dtype['ID']] = getPaySystem_m24($ar_dtype["ID"], $arPay);
    $deliv[] = $ar_dtype;
    if(!empty($ar_dtype['PRICE']) && $ar_dtype['PRICE']>0) $arResult['DELIVERY_PRICE']=$ar_dtype['PRICE'];

}
$arResult['ORDER_PRICE'] += $arResult['DELIVERY_PRICE'];
$arResult['DELIVERY'] = $deliv;

$arResult['DELIVERY_NEW'] = $arDeliv2;

//if($USER->IsAdmin()) {} else {
//    $arResult["ACQUIRING_AVAILABLE"] = false;// удалена на этом сайте
//}

// удаляяем возможность оплаты картой
if ($arResult["ACQUIRING_AVAILABLE"] == false) {
    unset($arResult['PAY_SYSTEM_NEW']['14']);
}

if ($arResult["credit_line"] == false) {
    unset($arResult['PAY_SYSTEM_NEW']['16']);
}

//// добавляем возможность рассрочки
//if ($arResult["credit_line"] == true) {
////    dd('mi tyt');
//    $arResult['PAY_SYSTEM_NEW'][315] = array(
//        "img" => "/bitrix/components/chairs24/sale_order/images/paylate.png/",
//        "NAME" => "Оплата в рассрочку",
//        "DESCRIPTION" => "web-служба CreditLine",
//        "ID" => "315"
//    );
//    $delivery = '';
//    foreach ($arResult['DELIVERY_NEW'] as $key => $item) {
//        $delivery[$key] = $item . '315';
//    }
//    $arResult['DELIVERY_NEW'] = $delivery;
//}

//выбираем доступные платежные системы для определенной доставки
function getPaySystem_m24($id, $arPay)
{
    $pay_string = '';
    $db_dtype = CSaleDelivery::GetDelivery2PaySystem(
        array(
            "ACTIVE" => "Y",
            "DELIVERY_ID" => $id
        )
    );
    while ($ar_dtype = $db_dtype->Fetch()) {
        if (in_array($ar_dtype['PAYSYSTEM_ID'], $arPay)) {
            $pay_string = $pay_string . $ar_dtype['PAYSYSTEM_ID'] . ',';
        }
    }
    return $pay_string;
}





