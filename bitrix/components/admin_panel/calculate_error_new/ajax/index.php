<?php
error_reporting(0);
set_time_limit(500);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/amocrm/functions.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));
$ts1 = microtime(true);
// Массив ответа
$msg = array(
    'error' => false,
    'text' => ''
);
// экранируем полученную информацию
foreach ($_POST as $key => $field) {
    $_POST[$key] = addslashes($field);
}

if ($_POST['type'] == 'lead_check') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/api/leads_profit/index.php");
}

if ($_POST['type'] == 'catalog') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/amocrm/catalog_error_scan.php");
}

if ($_POST['type'] == 'lead') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/amocrm/leads_scan.php");
}

if ($_POST['type'] == 'profit') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/amocrm/error_scan.php");
}



## 236099 розничная цена
## 602895 закупочная
## 602897 маржа
## 602899 Цена Супер-дистрибьютор
## 587463 стоимость доставки
## 513307 маржа со сделки