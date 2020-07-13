<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
global $LOCATION_CITY_ID, $LOCATION_CITY_NAME;
$arParams["CITY"] = $LOCATION_CITY_NAME;
 // выбор id инфоблока для тестового шаблона и продакшена
$Iblock_city = 53;
$Iblock_shops = 54;

if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $Iblock_city = 57;
    $Iblock_shops = 56;
    $arParams["CITY"] = "Москва";
//    $arParams["CITY"] = "Видное";
}


 // определяем ID города
$res_city = CIBlockElement::GetList(
    Array(),
    Array("IBLOCK_ID" => $Iblock_city, "ACTIVE" => "Y", "NAME" => $arParams['CITY']),
    false,
    false,
    array(
        "ID",
        "PROPERTY_geo",
        "PROPERTY_zoom"));
while ($ob = $res_city->GetNextElement()) {
    $city_ID = $ob->GetFields();
}

// заполняем координаты и масштаб для города
$geo = explode(',', $city_ID["PROPERTY_GEO_VALUE"]);

$Result['map_marker'] = array(
    'yandex_lat' => str_replace(' ', '', $geo[0]),
    'yandex_lon' => str_replace(' ', '', $geo[1]),
    'yandex_scale' => intval($city_ID["PROPERTY_ZOOM_VALUE"])
);
$arResult['CITY'] = $Result['CITY'] = $arParams["CITY"];


if($arParams["PRODUCT_NAME"]){
    $Result['product'] = array(
        'PRODUCT_NAME' => $arParams["PRODUCT_NAME"],
        'PRODUCT_ID' => $arParams["PRODUCT_ID"],
        'PRICE' => $arParams["PRICE"],
    );
}

$arFilters = array(
    "IBLOCK_ID" => $Iblock_shops,
    "ACTIVE" => "Y",
    "PROPERTY_city" => $city_ID["ID"],
    "PROPERTY_brand" => $arParams['BRAND_ID'],
    "PROPERTY_showroom_VALUE" => 'Y'
);

if($arParams['shop_id']){
    $arFilters['ID'] = $arParams['shop_id'];
}


// оформляем фильтр магазинов
$res_shops = CIBlockElement::GetList(
    Array("SORT" => "ASC"),
    $arFilters,
    false,
    false,
    array()
);
while ($ob = $res_shops->GetNextElement()) {
    $brands = array();
    $shops_m24 = $ob->GetFields();
    $shops_m24["PROPERTIES"] = $ob->GetProperties();

    foreach ($shops_m24["PROPERTIES"]["brand"]["VALUE"] as $brandID){
        $brands[] = getBrands($brandID);
    };

    $geoshops = explode(',', $shops_m24["PROPERTIES"]["geo"]["VALUE"]);
    // массив для отображения информации о магазине
    $arShop = [
        'shopID' => $shops_m24["ID"],
        'LAT' => str_replace(' ', '', $geoshops[0]),
        'LON' => str_replace(' ', '', $geoshops[1]),
        "NAME" => $shops_m24["NAME"],
        "metro" => $shops_m24["PROPERTIES"]["metro"]["VALUE"],
        "city" => $arParams['CITY'],
        "adress" => $shops_m24["PROPERTIES"]["adress"]["VALUE"],
        "work_time" => $shops_m24["PROPERTIES"]["work_time"]["VALUE"],
        "photos" => $shops_m24["PROPERTIES"]["photos"]["VALUE"],
    ];

    /// блок на карантин
    if(!empty($shops_m24["PROPERTIES"]["quarantine_cancel"]["VALUE"])) {
        $arShop["quarantine"] = $shops_m24["PROPERTIES"]["quarantine_cancel"]["VALUE"];
    } else {
        $arShop["quarantine"] ='';
    }
    /// блок на карантин END

    $Result['shops'][] = $arShop;
    $arShop['brands'] = $brands;
    $arResult['shops'][] = $arShop;
}

$arResult['data_js'] = $Result;
$arSelect = Array("ID", "NAME", "PREVIEW_TEXT");
$arFilter = Array("IBLOCK_ID"=>46, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    if($arFields['NAME']== $LOCATION_CITY_NAME) {
        $contact_text = $arFields['PREVIEW_TEXT'];
//	 print_r($arFields);
    }
}
$arResult['contact_text'] = $contact_text;

function getBrands($id){
    $result = CIBlockElement::GetList(
        Array(),
        Array("IBLOCK_ID"=>37, "ACTIVE"=>"Y",
            "ID"=> $id
        ),
        false,
        false,
        array(
            "NAME", "DETAIL_PICTURE", "DETAIL_TEXT", "PREVIEW_TEXT"
        )
    );
    while($ob = $result->GetNextElement())
    {
        $brand = $ob->GetFields();
    }
    $brand = preg_replace("/(\r\n){3,}/", "\r\n\r\n", $brand);
    return $brand;
}