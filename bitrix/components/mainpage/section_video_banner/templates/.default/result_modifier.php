<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
    return;
if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog"))
    return;
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$Iblock_videoreview = 64;
if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $Iblock_videoreview = 69;
}

$filterProductEmpty = array(
    "IBLOCK_ID" => $Iblock_videoreview,
    "ACTIVE" => "Y",
);

if (!empty($arParams['ID'])) {
    if (intval($arParams['ID']) != 0) {
        $filterProductEmpty["=PROPERTY_catalog_section"] = $arParams['ID'];
    } else {
        $filterProductEmpty = array(
            "!PROPERTY_catalog_section" => false
        );
    }
}

$res = CIBlockElement::GetList(
    Array("RAND" => "ASC"),
    $filterProductEmpty,
    false,
    Array("nTopCount" => 1),
    array(
        'PREVIEW_PICTURE',
        'PROPERTY_vidID',
        'PROPERTY_timeStart',
        'PREVIEW_TEXT'
    ));
while ($response = $res->GetNext()) {
    $item = array();

    $item['pic']['max'] = imageFormatVideoBanner($response['PREVIEW_PICTURE'], 610, 302);
    $item['pic']['min'] = imageFormatVideoBanner($response['PREVIEW_PICTURE'], 380, 214);

    $item['vidID'] = $response['PROPERTY_VIDID_VALUE'];
    $item['timeStart'] = $response['PROPERTY_TIMESTART_VALUE'];

    $arResult = $item;
}


// форматирование изображения

function imageFormatVideoBanner($id, $width, $height)
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