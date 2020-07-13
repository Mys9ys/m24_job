<?
?>

<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->IncludeFile("/actions/set/functions.php", array(), array()); ?>

<?php
//массив комплектов(акционных позиций)

$arFilter = array(
    'TYPE' => CCatalogProductSet::TYPE_GROUP,
);
if (!empty($set)) {
    $arFilter['OWNER_ID'] = $set;
}
$arSets = CCatalogProductSet::getList(
    array("RAND" => "ASC"),
    $arFilter, false, false, array()
);
$item = array();
while ($set = $arSets->Fetch()) {

    if ($set['OWNER_ID'] == $set['ITEM_ID']) {
        $elem['OWNER_ID'] = $set['OWNER_ID'];
        if (getSetInfo($set['OWNER_ID']) == false) {
            continue;
        } else {
            foreach (getSetInfo($set['OWNER_ID']) as $key => $info) {
                $elem[$key] = $info;
            }
            $elem['items'] = getSetItem($elem['OWNER_ID']);
            $item[] = $elem;
        }
    }
    $arResult['elems'] = $item;
}

////START баннер 23\8 марта START?>
<?

$arrActionProdIDs = array(
    'product' => 317019,
    'first' => 313312,
    'second' => 315454
);
if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $arrActionProdIDs = array(
        'product' => 1404,
        'first' => 956,
        'second' => 1088
    );
}

//if($arParams['product_ID'] == $arrActionProdIDs['product']){
// на всех страницах
if (false) { // false убирает банер
    foreach ($arrActionProdIDs as $key => $id) {
        $res = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_ID" => 39,
                'ID' => $id
            ),
            false,
//        false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $item = array();
            $Elem = $ob->GetFields();
            $Elem['PROPERTIES'] = $ob->GetProperties();


//Название
            if (!empty($Elem['PROPERTIES']['short_name']['VALUE'])) {
                $item["name"] = $Elem['PROPERTIES']['short_name']['VALUE'];
            } else {
                $item["name"] = $Elem['NAME'];
            }

//картинка товара
            if (!empty($Elem["PREVIEW_PICTURE"])) {
                $item['img'] = CFile::GetPath($Elem["PREVIEW_PICTURE"]);
            } else {
                $item['img'] = CFile::GetPath($Elem["DETAIL_PICTURE"]);
            }

//цены
            $arDiscount = CCatalogDiscount::GetDiscountByProduct($Elem['ID']);
            $prc = intval($Elem['PROPERTIES']['MINIMUM_PRICE']['VALUE']);
            $item['PRICE'] = $prc;
            $item['PRICE_DISCOUNT'] = '';
            if (!empty($arDiscount)) {
                foreach ($arDiscount as $discount) {
                    if ($discount['VALUE_TYPE'] == 'S') {
                        $prc = intval($discount['VALUE']);
                    } elseif ($discount['VALUE_TYPE'] == 'F') {
                        $prc -= intval($discount['VALUE']);
                    } elseif ($discount['VALUE_TYPE'] == 'P') {
                        $prc *= ((100 - intval($discount['VALUE'])) / 100);
                    }
                }
                $item['PRICE_DISCOUNT'] = $prc;
            }
            if (!empty($item['PRICE_DISCOUNT'])) {
                $item['PRICE'] = $item['PRICE_DISCOUNT'];
            }

            $item["url"] = $Elem['DETAIL_PAGE_URL'];
            $item["id"] = $Elem['ID'];

            $arResult['spring_banner'][$key] = $item;
        }
    }
}
//dd($arResult['spring_banner']);
?>

<? ////END баннер баннер 23\8 марта END?>

