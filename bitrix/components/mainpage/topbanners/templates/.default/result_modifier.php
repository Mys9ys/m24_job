<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule("iblock"))
    return;
if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog"))
    return;

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$Iblock_response = 41;
$res = CIBlockElement::GetList(
    Array("RAND"=>"ASC"),
    Array("IBLOCK_ID" => $Iblock_response,
        "ACTIVE" => "Y"
    ),
    false,
    array('nTopCount'=>1),
    array(
        'PROPERTY_repute',
        'PROPERTY_rating',
        'PROPERTY_OBJECT_ID',
    ));
while ($response = $res->GetNext()) {
    if(strlen($response["PROPERTY_REPUTE_VALUE"]) > 280){
        $arResult['repute'] = substr($response["PROPERTY_REPUTE_VALUE"], 0 , 280) . ' ...';
    } else {
        $arResult['repute'] =  $response["PROPERTY_REPUTE_VALUE"];
    }
    $arResult['rating'] =  $response["PROPERTY_RATING_VALUE"];
    $arResult['item'] = getItemResponseInfo($response["PROPERTY_OBJECT_ID_VALUE"]);
}

//проверяем нет ли брошенной корзины
$dbBasketItems = CSaleBasket::GetList(
    array(),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL"
    ),
    false,
    false,
    array()
);
$arResult['drop_basket'] = $dbBasketItems->Fetch();
if(!empty($arResult['drop_basket'])){
    // если пролежала более 2 часов
    if(time() - MakeTimeStamp($arResult['drop_basket']['DATE_UPDATE'],"DD.MM.YYYY HH:MI:SS") >7200){
        $arResult['drop_basket'] = true;
    } else {
        $arResult['drop_basket'] = false;
    }
}


function getItemResponseInfo($id){
    $Iblock_product = 39;
    $res = CIBlockElement::GetList(
        Array(),
        Array("IBLOCK_ID"=>$Iblock_product,
            "ACTIVE"=>"Y",
            'ID' => $id
        ),
        false,
        false,
        array(
            'ID',
            'NAME',
            'PROPERTY_short_name',
            'DETAIL_PICTURE',
            'PREVIEW_PICTURE',
            'DETAIL_PAGE_URL',
        ));
    while ($Elem = $res->GetNext()) {

        if (!empty($Elem['PROPERTY_SHORT_NAME_VALUE'])) {
            $item["short_name"] = $Elem['PROPERTY_SHORT_NAME_VALUE'];
        } else {
            $item["short_name"] = $Elem['NAME'];
        }
        if (!empty($Elem['PREVIEW_PICTURE'])) {
            $result['img'] = imageFormatTopBannerResponse($Elem['PREVIEW_PICTURE'], 80, 66);
        } else {
            $result['img'] = imageFormatTopBannerResponse($Elem['DETAIL_PICTURE'], 80, 66);
        }
        $result['link'] = $Elem["DETAIL_PAGE_URL"];
    }
    return $result;
}

// форматирование изображения

function imageFormatTopBannerResponse($id, $width, $height)
{
    $arFileTmp = CFile::ResizeImageGet(
        $id,
        array("width" => $width, "height" => $height),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true,
        array(
            "name" => "sharpen",
            "precision" => 15
        ),
        true,
        80
    );
    return $arFileTmp["src"];
}
?>


