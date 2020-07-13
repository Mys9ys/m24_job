<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

global $LOCATION_CITY_NAME;


 // выбор id инфоблока для тестового шаблона и продакшена
$Iblock_city = 53;
$Iblock_shops = 54;
if($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $Iblock_city = 57;
    $Iblock_shops = 56;
    $LOCATION_CITY_NAME = 'Москва';
}

$arFilters = array(
    "IBLOCK_ID"=>$Iblock_shops,
    "ACTIVE"=>"Y",
    "PROPERTY_test_drive_VALUE" => 'Y',
);
if(!empty($_REQUEST['shop'])){
    $arFilters['ID'] = $_REQUEST['shop'];
}

$res_shops = CIBlockElement::GetList(
    Array("SORT"=>"ASC"),
    $arFilters,
    false,
    false,
    array()
);
while($ob = $res_shops->GetNextElement())
{
    $shops_m24 = $ob->GetFields();
    $shops_m24["PROPERTIES"] = $ob->GetProperties();
    foreach ($shops_m24["PROPERTIES"]["brand"]["VALUE"] as $brandID){
        $brands[] = getBrandsInfoByRegion($brandID);
    };
    // массив для отображения информации о магазине
    $arShop = [
        'shopID' => $shops_m24["ID"],
        "banner_img" => CFile::GetPath($shops_m24["PROPERTIES"]["banner_img"]["VALUE"]),
        "banner_mini" => CFile::GetPath($shops_m24["PROPERTIES"]["banner_mini"]["VALUE"]),
        "photos" => $shops_m24["PROPERTIES"]["photos"]["VALUE"],
    ];
    $arShop['brands'] = $brands;
    $arResult['shop'] = $arShop;
}

function getBrandsInfoByRegion($id){
    $result = CIBlockElement::GetList(
        Array(),
        Array("IBLOCK_ID"=>37, "ACTIVE"=>"Y",
            "ID"=> $id
        ),
        false,
        false,
        array(
            "ID", "NAME", "PREVIEW_PICTURE", "DETAIL_TEXT", "PREVIEW_TEXT"
        )
    );
    while($ob = $result->GetNextElement())
    {
        $brand = $ob->GetFields();
    }
    $brand = preg_replace("/(\r\n){3,}/", "\r\n\r\n", $brand);
    return $brand;
}