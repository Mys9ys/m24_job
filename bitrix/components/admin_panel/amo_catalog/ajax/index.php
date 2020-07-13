<?php
error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));

if( isset( $_POST['my_file_upload'] ) ){
    // ВАЖНО! тут должны быть все проверки безопасности передавемых файлов и вывести ошибки если нужно

    $uploaddir = '/bitrix/components/admin_panel/amo_catalog/data'; // . - текущая папка где находится submit.php

    // cоздадим папку если её нет
    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

    $files      = $_FILES; // полученные файлы
    $done_files = array();

    // переместим файлы из временной директории в указанную
    foreach( $files as $file ){
        $file_name = $file['name'];

        if( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ){
            $done_files[] = realpath( "$uploaddir/$file_name" );
        }
    }

    $data = $done_files ? array('files' => $done_files ) : array('error' => 'Ошибка загрузки файлов.');

    die( json_encode( $data ) );
}