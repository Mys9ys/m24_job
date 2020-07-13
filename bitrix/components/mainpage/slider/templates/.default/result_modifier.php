<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$Iblock_response = 45;
$res = CIBlockElement::GetList(
    Array("SORT"=> 'ASC'),
    Array("IBLOCK_ID" => $Iblock_response,
        "ACTIVE" => "Y"
    ),
    false,
    false,
    array(
        'PREVIEW_PICTURE',
        'PROPERTY_URL'
    ));
while ($response = $res->GetNext()) {
    if(!empty($response['PREVIEW_PICTURE'])){
        $elem['IMG']['max'] = imageFormatImgSlider($response['PREVIEW_PICTURE'], 716, 353);
        $elem['IMG']['min'] = imageFormatImgSlider($response['PREVIEW_PICTURE'], 415, 205);
        $elem['URL'] =$response['PROPERTY_URL_VALUE'];
        $arResult[] = $elem;
    }
}

// форматирование изображения

function imageFormatImgSlider($id, $width, $height)
{
    $arFileTmp = CFile::ResizeImageGet(
        $id,
        array("width" => $width, "height" => $height),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
    return $arFileTmp["src"];
}
?>