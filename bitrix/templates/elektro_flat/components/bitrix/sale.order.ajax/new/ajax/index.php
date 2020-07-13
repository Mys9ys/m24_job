<?php
error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));



// Массив ответа
$msg = array(
    'error' => false,
    'text' => ''
);
// экранируем полученную информацию
foreach ($_POST as $key => $field) {
    $_POST[$key] = addslashes($field);
}

if (!$_POST['operation']){
    $msg['error'] = true;
}

// если нет ошибок
if (!$msg['error']) {
    if($_POST['operation']=='delete'){
        $arFields = array(
            "QUANTITY" => 0,
        );
        CSaleBasket::Update($_POST['id'], $arFields);
//        echo json_encode($delete_func);
    }
    if($_POST['operation']=='plus'){
        $arFields = array(
            "QUANTITY" => $_POST['QUANTITY']+1,
        );
        CSaleBasket::Update($_POST['id'], $arFields);
    }
    if($_POST['operation']=='minus' && $_POST['QUANTITY']>1){
        $arFields = array(
            "QUANTITY" => $_POST['QUANTITY']-1,
        );
        CSaleBasket::Update($_POST['id'], $arFields);
    }
    if($_POST['operation']=='delivery'){
        $arFields = array(
            "PRICE" => $_POST['price'],
        );
        CSaleBasket::Update($_POST['id'], $arFields);
    }

    if($_POST['operation']=='ordered'){

        // проверярем наличие пользователя в базе либо создаем нового
        $filter = array(
            'EMAIL' => $_POST['mail']
        );
        $order = '';
        $tmp = ''; // параметр проигнорируется методом, но обязан быть
        $rsUsers = CUser::GetList($order, $tmp, $filter);

        while($elementsResult = $rsUsers->GetNext()) {
            $arUser = $elementsResult['ID'];
        }

        if(empty($arUser)){
            // регистрируем пользователя в Битрикс
            $count = CUser::GetCount()+1;
            $user = new CUser;
            $arFields = Array(
                "NAME"              => $_POST['name'],
                "EMAIL"             => $_POST['mail'],
                "PASSWORD"          => "123456",
                "CONFIRM_PASSWORD"  => "123456",
                "LOGIN"         => 'buyer'.$count,
                "PERSONAL_PHONE"    => $_POST['phone'],
                "PERSONAL_CITY"     => 'Москва',
                "PERSONAL_STREET "  => $_POST['all_address'],
                "LID"               => s1,
                "ACTIVE"            => "Y",
                "GROUP_ID"          => 5,
            );
            $ID = $user->add($arFields);
            if (intval($ID) > 0)
                $arUser = $ID;
            else
                echo $user->LAST_ERROR;
        }

        $arFields = array(
            "LID" => s1,
            "PERSON_TYPE_ID" => 1,
            "PAYED" => "N",
            "CANCELED" => "N",
            "STATUS_ID" => "N",
//            "PRICE" => $_POST['order_price'],
            "CURRENCY" => "RUB",
            "USER_ID" => $arUser,
        );

// add Guest ID
        if (CModule::IncludeModule("statistic"))
            $arFields["STAT_GID"] = CStatistic::GetEventParam();

        $ORDER_ID = CSaleOrder::Add($arFields);

        CSaleBasket::OrderBasket($ORDER_ID, $_SESSION["SALE_USER_ID"], s1);

        $arFields = array(
            "PRICE" => $_POST['order_price'],
            "CURRENCY" => "RUB",
            "USER_ID" => $arUser,
            "PAY_SYSTEM_ID" => 16,
            "PRICE_DELIVERY" => $_POST['PRICE_DELIVERY'],
            "DELIVERY_ID" => $_POST['DELIVERY_ID'],
            "DISCOUNT_VALUE" => $_POST['DISCOUNT_VALUE'],
            "TAX_VALUE" => 0.0,
            "USER_DESCRIPTION" => $_POST['city'], $_POST['all_address']
        );
        CSaleOrder::Update($ORDER_ID, $arFields);

        $Name_string = $_POST['name'].' '.$_POST['surname'].' '.$_POST['second_name'];
        $arFields = array(
            array("ORDER_PROPS_ID" => 1, "VALUE" => $Name_string, "NAME" => "Ф.И.О.", 'CODE'=> 'FIO'),
            array("ORDER_PROPS_ID" => 2, "VALUE" => $_POST['mail'], "NAME" => "E-Mail", 'CODE'=> 'EMAIL'),
            array("ORDER_PROPS_ID" => 3, "VALUE" => $_POST['phone'], "NAME" => "Телефон", 'CODE'=> 'PHONE'),
            array("ORDER_PROPS_ID" => 5, "VALUE" => 'Москва', "NAME" => "Город", 'CODE'=> 'CITY'),
            array("ORDER_PROPS_ID" => 7, "VALUE" => $_POST['all_address'], "NAME" => "Адрес доставки", 'CODE'=> 'ADDRESS'),
        );
        foreach ($arFields as $item){
            $item['ORDER_ID'] = $ORDER_ID;
            CSaleOrderPropsValue::Add($item);
        }

        $arOrder['order'] = $ORDER_ID;


        // вывод ошибок
//        if($ex = $APPLICATION->GetException());
//        dd($ex->GetString());
    }
}
