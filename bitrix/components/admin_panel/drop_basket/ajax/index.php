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

if (!$_POST['actions']){
    $msg['error'] = true;
}

// если нет ошибок
if (!$msg['error']) {
    if ($_POST['operation'] != '') {
        $arID = explode(',', $_POST['ids']);
        foreach ($arID as $item_id){
            $arFields = array(
                "RECOMMENDATION" => $_POST['operation'],
            );
            CSaleBasket::Update($item_id, $arFields);
        }
//        echo count($arID);
    }
}

