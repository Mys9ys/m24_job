<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;?>
<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?$APPLICATION->IncludeFile("/actions/set/functions.php", array(), array()); ?>
<?
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
?>



<?//акционные баннеры

//выбираем информацию
$rsElem = CCatalogProductSet::getList(
    array("SORT"=> 'ASC'),
    array(
        'TYPE' => CCatalogProductSet::TYPE_GROUP,
        'ITEM_ID' => $arParams['product_ID'],
        'ACTIVE' => 'Y'),
    false,
    false,
    array()
);
while ($set = $rsElem->Fetch() ){
    if(getSetInfo($set['OWNER_ID']) == false){
        continue;
    } else {
        foreach (getSetInfo($set['OWNER_ID']) as $key =>$info){
            $elem[$key]=$info;
        }
        $elem['items'] = getSetItem($set['OWNER_ID']);
        $arResult['sets'][]=$elem;
    }
}?>
<?//акционные баннеры END?>

<?//START баннер для регионального магазина START?>
<?global $LOCATION_CITY_NAME;
//$LOCATION_CITY_NAME = 'Москва';
// выбор id инфоблока для тестового шаблона и продакшена
$Iblock_city = 53;
$Iblock_shops = 54;
if($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $Iblock_city = 57;
    $Iblock_shops = 56;
}
//
$filter = array(
    "IBLOCK_ID"=>$Iblock_city,
    "ACTIVE"=>"Y",
    "NAME" => $LOCATION_CITY_NAME
);

$res = CIBlockElement::GetList(
    Array("SORT"=>"ASC"),
    $filter,
    false,
    false,
    array()
);
while($ob = $res->GetNextElement())
{
    $city_id = $ob->GetFields();
}
$arFilters = array(
    "IBLOCK_ID"=>$Iblock_shops,
    "ACTIVE"=>"Y",
    "PROPERTY_city" => $city_id["ID"],
    "PROPERTY_test_drive_VALUE" => 'Y',
);

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
    $content =
        '<a class="banner_region owlElement" href="/content/region_shops/?shop='.$shops_m24["ID"].'">'.
            '<img src="'.CFile::GetPath($shops_m24["PROPERTIES"]["banner_mini"]["VALUE"]).'" alt="">'.
        '</a>';
    $arResult['region'] = $content;
}?>
<?////END баннер для регионального магазина END?>

<?//START баннер для акций касада(кресла) START?>
<?
$res = CIBlockElement::GetList(
    array(),
    array(
        "IBLOCK_ID" => 39,
        'ID' => $arParams['product_ID']
    ),
    false,
//        false,
    false,
    array());
while ($ob = $res->GetNextElement()) {
    $Elem = $ob->GetFields();
    $Elem['PROPERTIES'] = $ob->GetProperties();
    if($Elem["PROPERTIES"]["MANUFACTURER"]["VALUE"] == 923 && $Elem['IBLOCK_SECTION_ID']==325) $arResult['snowflake'] ='Y';
}
?>
<?////END баннер для акций касада(кресла) END?>

<?////START баннер 23\8 марта START?>
<?

$arrActionProdIDs = array(
    'product'=>317019,
    'first'=> 313312,
    'second'=> 315454
);
if($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $arrActionProdIDs = array(
        'product'=>1404,
        'first'=> 956,
        'second'=> 1088
    );
}

//if($arParams['product_ID'] == $arrActionProdIDs['product']){
// на всех страницах
if(false){ // false убирает банер
   foreach ($arrActionProdIDs as $key=>$id){
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
           if(!empty($item['PRICE_DISCOUNT'])){
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

<?////END баннер баннер 23\8 марта END?>

