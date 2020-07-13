<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$Iblock_slider = 45;
$arFilter = array(
   "IBLOCK_ID" => $Iblock_slider,
    "ACTIVE" => "Y",
    "PROPERTY_339_VALUE" =>$arParams['SECTION_ID']
);
if($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $Iblock_slider = 45;
    $arFilter['PROPERTY_381_VALUE'] = $arParams['SECTION_ID'];
}

$res = CIBlockElement::GetList(
    Array("SORT"=> 'ASC'),
    $arFilter,
    false,
    false,
    array()
);
while ($ob = $res->GetNextElement()) {
    $response = $ob->GetFields();
    if(!empty($response['DETAIL_PICTURE'])){
        $elem['IMG'] =CFile::GetPath($response['DETAIL_PICTURE']);
        $elem['Prop'] =$ob->GetProperties();
        $arResult = $elem;
    }
}
?>