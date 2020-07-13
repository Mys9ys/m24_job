<?php
error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$msg = array(
    'error' => false,
    'text' => ''
);

// экранируем полученную информацию
foreach ($_POST as $key => $field) {
    $_POST[$key] = addslashes($field);
}

if (!$_POST['verify']){
    $msg['error'] = true;
}




// если нет ошибок
if (!$msg['error']) {

    if($_POST['request']){
        $Iblock_videoreview = 64;
        if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
            $Iblock_videoreview = 69;
        }
        $filter = Array("IBLOCK_ID"=>$Iblock_videoreview,
            "ACTIVE"=>"Y",
            "%SEARCHABLE_CONTENT" => $_POST['request']);

        $res = CIBlockElement::GetList(
            Array("CREATED" => 'DESC'),
            $filter,
            false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $response = $ob->GetFields();
            $arTags = explode(";", $response['PREVIEW_TEXT']);
            $Tags = '';

            foreach ($arTags as $key => $tag) {
                $tag = trim($tag);
                if (!empty($tag)) {
                    if(strpos(strtolower($tag),$_POST['request'])>-1) {
                        $elem[] = $response['NAME'];
                    }
                    $result = array_unique($elem);
                }
            }
        }
    }
    if($_POST['selector']){
        $allTags = array();

        $Iblock_videoreview = 64;
        if ($_SERVER['SERVER_NAME'] == 'massagery2018'  || $_SERVER['SERVER_NAME'] == 'massagery2019') {
            $Iblock_videoreview = 69;
        }
        $filter = Array("IBLOCK_ID" => $Iblock_videoreview,
            "ACTIVE" => "Y",
        );
        if ($_POST['selector'] == '.ajax_get_vids_all') {
            $filter["!PROPERTY_Vblog_VALUE"] = "Y";
        } elseif ($_POST['selector'] == '.ajax_get_vids_blogs') {
            $filter["PROPERTY_Vblog_VALUE"] = "Y";
        }
        // количество на странице
        $arNavStartParams = array(
            'nTopCount' => false,
            'nPageSize' => 9,
            'iNumPage' => $_POST['pagen'],
            'checkOutOfRange' => true
        );
        $res = CIBlockElement::GetList(
            Array("CREATED" => 'DESC'),
            $filter,
            false,
            $arNavStartParams,
            array());
        while ($ob = $res->GetNextElement()) {
            $response = $ob->GetFields();
            $response["PROPERTIES"] = $ob->GetProperties();
            $elem['Pict'] = CFile::GetPath($response['PREVIEW_PICTURE']);
            $arTags = explode(";", $response['PREVIEW_TEXT']);
            $Tags = '';
            foreach ($arTags as $key => $tag) {
                $tag = trim($tag);
                if (!empty($tag)) {
                    $Tags[$key] = $tag;
                }
            }
            $elem['ID'] = $response["ID"];
            $elem['NAME'] = $response["NAME"];
            $elem['vidID'] = $response['PROPERTIES']['vidID']['VALUE'];
            $elem['timeStart'] = $response['PROPERTIES']['timeStart']['VALUE'];

            $elem['tags'] = $Tags;
            $elem['products'] = '';
            foreach ($response["PROPERTIES"]["productID"]["VALUE"] as $product) {
                $elem['products'][] = AjaxProductInfoVideoReview($product);
            }
            $result[] = $elem;

        }
    }

    // добавляем просмотры
    if($_POST['props'] == 'views'){
        $Iblock_videoreview = 64;
        $vblog = 268;
        if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
            $Iblock_videoreview = 69;
            $vblog = 266;
        }

        $filter = Array("IBLOCK_ID" => $Iblock_videoreview,
            "PROPERTY_vidID" => $_POST['id'],
        );

        $res = CIBlockElement::GetList(
            array(),
            $filter,
            false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $response = $ob->GetFields();
            $response["prop"] = $ob->GetProperties();
            $video = $response["prop"];
        }

        foreach($video as $item){

            if($item['CODE'] == 'views'){
                $prop[$item['CODE']] = $item['VALUE'] + 1;
            } else {
                $prop[$item['CODE']] = $item['VALUE'];
            }
            if($item['CODE'] =='Vblog') {
                if($item['VALUE'] == 'Y'){
                    $prop[$item['CODE']] = array($vblog);
                }
            }

        }

        $Element = new CIBlockElement();
        $arLoadProductArray = Array(
            "PROPERTY_VALUES"=> $prop
            );
        $el = $Element->Update($response['ID'], $arLoadProductArray);
    }
}

echo json_encode($result);


function AjaxProductInfoVideoReview($id){
    $Iblock_product = 39;
    $res = CIBlockElement::GetList(
        Array(),
        Array("IBLOCK_ID"=>$Iblock_product,
            'ID' => $id
        ),
        false,
        false,
        array());
    while($ob = $res->GetNextElement())
    {
        $product = $ob->GetFields();

        $product["PROPERTIES"] = $ob->GetProperties();

        if(!empty($product["PROPERTIES"]["short_name"]["VALUE"])){
            $result['name'] = $product["PROPERTIES"]["short_name"]["VALUE"];
        } else {
            $result['name'] = $product['NAME'];
        }
        if(!empty($product['PREVIEW_PICTURE'])){
            $result['img'] = CFile::GetPath($product['PREVIEW_PICTURE']);
        } else {
            $result['img'] = CFile::GetPath($product['DETAIL_PICTURE']);
        }
        $result['link']=$product["DETAIL_PAGE_URL"];
    }
    return $result;
}