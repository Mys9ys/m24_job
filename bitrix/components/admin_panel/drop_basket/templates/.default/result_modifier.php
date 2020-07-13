<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock"))
    return;
if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog"))
    return;

$now = new DateTime();
$dbBasketItems = CSaleBasket::GetList(
    array(
        "DATE_INSERT" => "DESC",
//        "ID" => "ASC"
    ),
    array(
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
    ),
    false,
    false,
    array()
);

//use Bitrix\Sale\Internals\DiscountTable;
//$res = DiscountTable::getList();
//dd($res);
$UserAr = array();
$arDropBasket = array();
$arOperation = array();
while ($arItems = $dbBasketItems->Fetch()) {
//    dd($arItems['NOTES']);
//    dd($arItems);
    if(!empty($arItems['USER_ID'])){
        $arProps = array();
        $rsUser = CUser::GetByID($arItems['USER_ID']);
        $arUser = $rsUser->Fetch();
//        dd($arUser['PERSONAL_PHONE']);

        $arProps['phone'] = $arUser['PERSONAL_PHONE'];
        $arProps['FULL_NAME'] = $arUser['NAME'] . ' ' . $arUser['LAST_NAME'];
        $arProps['DATE_INSERT'] = explode(' ', $arItems['DATE_INSERT']);
        $arProps['roistat_id'] = $arUser['PERSONAL_PAGER'];

        $arDropBasket[$arItems['FUSER_ID']]['phone'] =$arUser['PERSONAL_PHONE'];
        $arItem['NAME'] = $arItems['NAME'];
        $arItem['DETAIL_PAGE_URL'] = $arItems['DETAIL_PAGE_URL'];
        $arItem['ID'] = $arItems['ID'];

        $arDropBasket[$arItems['FUSER_ID']]['USER'] = $arProps;
        $arDropBasket[$arItems['FUSER_ID']]['items'][] = $arItem;
        if($arItems['RECOMMENDATION'] != ''){
            $arDropBasket[$arItems['FUSER_ID']]['operation'] = $arItems['RECOMMENDATION'];

        } else {
            $arDropBasket[$arItems['FUSER_ID']]['operation'] = 'not_processed';
        }
    }

    $arDropBasket[$arItems['FUSER_ID']]['price_basket'] +=ceil($arItems['PRICE'])*ceil($arItems['QUANTITY']);
    $arDropBasket[$arItems['FUSER_ID']]['DATE_INSERT'] = MakeTimeStamp($arItems['DATE_INSERT'],"DD.MM.YYYY HH:MI:SS");
}

foreach ($arDropBasket as $basket){
//    dd($basket);
    $date = time() - $basket['DATE_INSERT'];
    if ($date < 172800 && $date > 86400) {
        if(!empty($basket['phone'])){
            $arResult['dayLogin'] ++;
        } else {
            $arResult['dayUnLogin'] ++;
        }
    }
    if ($date < 691200 && $date > 86400) {
        if(!empty($basket['phone'])){
            $arResult['weekLogin'] ++;
        } else {
            $arResult['weekUnLogin'] ++;
        }
    }
    if ($date < 2678400 && $date > 0) {
//    if ($date < 2678400 && $date > 86400) {
        if(!empty($basket['phone'])){
            $arResult['monthLogin'] ++;
            $arResult['LOGIN'][] = $basket;
            $arOperation[$basket['operation']]++;
        } else {
            $arResult['monthUnLogin'] ++;
        }
    }
    if ($date > 0) {
        if(!empty($basket['phone'])){
            $arResult['allLogin'] ++;
        } else {
            $arResult['allUnLogin'] ++;
        }
    }
}
$arResult['operation'] = $arOperation;

//$arFields = array(
//    "RECOMMENDATION" => 'qerqwer'
//);
//dd(CSaleBasket::Update(1748, $arFields));
//dd(count($arDropBasket));
//dd( $arResult);
//dd( $arResult['LOGIN'][0]);
//dd( $arResult['LOGIN']);
//dd($arItems);

//dd(time()-$b);



//$now = new DateTime();
//$arFilter = array(">DATE_UPDATE" => $b->modify('-7 day'));
//dd(time());