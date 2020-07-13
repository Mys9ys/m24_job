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
if (empty($_POST['products'])) {
    // экранируем полученную информацию
    foreach ($_POST as $key => $field) {
        $_POST[$key] = addslashes($field);
    }
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


    // регистрируем пользователя по номеру телефона
    if($_POST['operation']=='phone'){
        // проверярем наличие пользователя в базе либо создаем нового
        registerUserByPhone($_POST['phone'], $_POST['roistat_id']);
    }

    // добовляем фио и емайл
    if($_POST['operation']=='fio'){

        $user = new CUser;
        $fields = Array(
            "NAME"              => $_POST['fullname'],
            "EMAIL"             => $_POST['email'],
        );
        $user->Update($USER->GetID(), $fields);
    }

    // оформляем заказ
    if($_POST['operation']=='ordered' || $_POST['operation']=='cl-ordered'){


        // для рассрочки
    if($_POST['operation']=='cl-ordered'){
        registerUserByPhone($_POST['phone'], $_POST['roistat_id']);
        $user = new CUser;
        $fields = Array(
            "NAME"              => $_POST['fullname'],
            "EMAIL"             => $_POST['email'],
        );
        $user->Update($USER->GetID(), $fields);
    }

        $arUser = $USER->GetID();
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

        CSaleBasket::OrderBasket($ORDER_ID, CSaleBasket::GetBasketUserID(), s1);
        if(empty($_POST['discount_price'])) $_POST['discount_price'] = 0;
        $arFields = array(
            "PRICE" => $_POST['summary_price'],
            "CURRENCY" => "RUB",
            "USER_ID" => $arUser,
            "PAY_SYSTEM_ID" => $_POST['paysystem'],
            "PRICE_DELIVERY" => $_POST['delivery_price'],
            "DELIVERY_ID" => $_POST['delivery'],
            "DISCOUNT_VALUE" => $_POST['discount_price'],
            "TAX_VALUE" => 0.0,
//            "USER_DESCRIPTION" => $_POST['city'], $_POST['all_address']
        );
        CSaleOrder::Update($ORDER_ID, $arFields);
//
//        $Name_string = $_POST['name'].' '.$_POST['surname'].' '.$_POST['second_name'];
        $arFields = array(
            array("ORDER_PROPS_ID" => 1, "VALUE" => $_POST['fullname'], "NAME" => "Ф.И.О.", 'CODE'=> 'FIO'),
            array("ORDER_PROPS_ID" => 2, "VALUE" => $_POST['email'], "NAME" => "E-Mail", 'CODE'=> 'EMAIL'),
            array("ORDER_PROPS_ID" => 3, "VALUE" => $_POST['phone'], "NAME" => "Телефон", 'CODE'=> 'PHONE'),
//            array("ORDER_PROPS_ID" => 20, "VALUE" => 0, "NAME" => "Экспорт в amoCRM", 'CODE'=> 'amo_export'),
//            array("ORDER_PROPS_ID" => 5, "VALUE" => 'Москва', "NAME" => "Город", 'CODE'=> 'CITY'),
            array("ORDER_PROPS_ID" => 7, "VALUE" => $_POST['adress'], "NAME" => "Адрес доставки", 'CODE'=> 'ADDRESS'),
        );
        foreach ($arFields as $item){
            $item['ORDER_ID'] = $ORDER_ID;
            CSaleOrderPropsValue::Add($item);
        }

        $arOrder['order'] = $ORDER_ID;
        echo json_encode($arOrder);


        // вывод ошибок
//        if($ex = $APPLICATION->GetException());
//        dd($ex->GetString());
    }

    // проверка на изменение цены(длительное хранение в корзине)
    if($_POST['operation']=='price_check'){
        $arFields = array(
            "QUANTITY" => $_POST['quantity'],
        );
        dd(CSaleBasket::Update($_POST['basket_id'], $arFields));
        $reload_flag = 0;
        $arBasketItems = array();

        $dbBasketItems = CSaleBasket::GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
            false,
            false,
            array("ID", "CALLBACK_FUNC", "MODULE",
                "PRODUCT_ID", "QUANTITY", "DELAY",
                "CAN_BUY", "PRICE", "WEIGHT")
        );
        while ($arItems = $dbBasketItems->Fetch())
        {
            if (strlen($arItems["CALLBACK_FUNC"]) > 0)
            {
                CSaleBasket::UpdatePrice(
                    $arItems["ID"],
                    $arItems["CALLBACK_FUNC"],
                    $arItems["MODULE"],
                    $arItems["PRODUCT_ID"],
                    $arItems["QUANTITY"]);
                $arItems = CSaleBasket::GetByID($arItems["ID"]);
            }

            $arBasketItems[$arItems["PRODUCT_ID"]] = $arItems["PRICE"];
        }
    }

    foreach ($_POST['products'] as $id=>$price){
        if(empty($arBasketItems[$id])){
            $reload_flag = 1;
        }
        if($arBasketItems[$id] != $price){
            $reload_flag = 1;
        }
    }
//    echo $reload_flag;
}

/**
 * регистрирует пользователя по номеру телефона
 * на входе номер, на выходе id пользователя в любом случае
 */
function registerUserByPhone($phone,$roistat_id)
{
    if(checkUserByPhone($phone) == false){ // если пользователь не зарегистрирован
        $password = 123456;
        $user = new CUser;
        $fields = Array(
            "NAME" => "",
            "LAST_NAME" => "",
            "EMAIL" => "buyer-".date('ymdhis')."@massagery24.ru",
            "LOGIN" => $phone, // логин - номер телефона без +
            "LID" => "ru",
            "ACTIVE" => "Y",
            "GROUP_ID" => array(3),
            "PASSWORD" => $password,
            "CONFIRM_PASSWORD" => $password,
            "PERSONAL_PHONE" => $phone,
            "PERSONAL_PAGER" => $roistat_id
        );
        $ID = $user->Add($fields);
        if (intval($ID) > 0){
            global $USER;
            $USER->Authorize($ID);// сразу же авторизуем
            return $ID;
        }
    } else { // если пользователь зарегистрирован
        return checkUserByPhone($phone, $roistat_id);
    }
}
/**
 * id пользователя по номеру телефона
 * возвращает false если не существует
 * возвращает id если существует
 */
function checkUserByPhone($phone,$roistat_id)
{
    $by = "ID";
    $order = "ASC";
    $rsUser = CUser::GetList(($by="ID"), ($order="desc"), array("PERSONAL_PHONE"=>$phone),array());
    $arUser = $rsUser->Fetch();

    if(!empty($arUser['ID']))
    {
        global $USER;
        $USER->Authorize($arUser['ID']);// сразу же авторизуем
        $user = new CUser;
        $fields = Array(
            "PERSONAL_PAGER" => $roistat_id,
        );
        $user->Update($arUser['ID'], $fields);
        return $arUser['ID']; // пользователь существует
    }
    else
    {
        return false; // пользователь не существует
    }
}