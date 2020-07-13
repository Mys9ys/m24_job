<?php

error_reporting(0);

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

// экранируем полученную информацию
foreach ($_POST as $key => $field) {
    $_POST[$key] = addslashes($field);
}

if (!$_POST['phone']){
    $msg['error'] = true;
}

//dd($_POST);

// если нет ошибок
if (!$msg['error']) {
//    $adminemail = 'info@massagery24.ru';
    $adminemail = 'kdkdil@yandex.ru';
//    $msg = $_POST['text'].'<br>'.$_POST['name'].'<br>'.$_POST['phone'].'<br>'.$_POST['email'];
    $arEventFields = array(
//        "ID"                  => $CONTRACT_ID,
        "IN_MAIL"            => $_POST['email'],
        "TO_MAIL"            => $adminemail,
        "NAME"            => $_POST['name'],
        "TEXT"            => $_POST['text'],
        "PHONE"            => $_POST['phone'],
//        "ADMIN_EMAIL"         => implode(",", $ADMIN_EMAIL),
//        "ADD_EMAIL"           => implode(",", $ADD_EMAIL),
//        "STAT_EMAIL"          => implode(",", $VIEW_EMAIL),
//        "EDIT_EMAIL"          => implode(",", $EDIT_EMAIL),
//        "OWNER_EMAIL"         => implode(",", $OWNER_EMAIL),
//        "BCC"                 => implode(",", $BCC),
//        "INDICATOR"           => GetMessage("AD_".strtoupper($arContract["LAMP"]."_CONTRACT_STATUS")),
//        "ACTIVE"              => $arContract["ACTIVE"],
//        "NAME"                => $arContract["NAME"],
//        "DESCRIPTION"         => $description,
//        "MAX_SHOW_COUNT"      => $arContract["MAX_SHOW_COUNT"],
//        "SHOW_COUNT"          => $arContract["SHOW_COUNT"],
//        "MAX_CLICK_COUNT"     => $arContract["MAX_CLICK_COUNT"],
//        "CLICK_COUNT"         => $arContract["CLICK_COUNT"],
//        "BANNERS"             => $arContract["BANNER_COUNT"],
//        "DATE_SHOW_FROM"      => $arContract["DATE_SHOW_FROM"],
//        "DATE_SHOW_TO"        => $arContract["DATE_SHOW_TO"],
//        "DATE_CREATE"         => $arContract["DATE_CREATE"],
//        "CREATED_BY"          => $CREATED_BY,
//        "DATE_MODIFY"         => $arContract["DATE_MODIFY"],
//        "MODIFIED_BY"         => $MODIFIED_BY
    );

    $res = CEvent::Send(
        'PARTNERSHIP',
        SITE_ID,
        $arEventFields,
        N,
        39
    );
//    CEvent::CheckEvents();
//
//    dd($arEventFields);
//    $msg = $_POST['text'].'<br>'.$_POST['name'].'<br>'.$_POST['phdubone'].'<br>'.$_POST['email'];
//    $headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
//    $headers .= "From: " . $_POST['email'] . "\r\n";
//    $subject = '"Заявка на сотрудничество от "'.$_POST['name'];
//    if (mail($adminemail, $subject, $msg, $headers)){
//        echo 1;
//    } else {
//        echo 0;
//    }
if (!empty($res)){
    echo 1;
} else {
    echo 0;
}



}