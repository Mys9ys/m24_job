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

    global $USER;
    if (!is_object($USER)) $USER = new CUser;
    $arAuthResult = $USER->Login($_POST['login'], $_POST['password'], "Y");
    $APPLICATION->arAuthResult = $arAuthResult;
    echo $arAuthResult;
}

