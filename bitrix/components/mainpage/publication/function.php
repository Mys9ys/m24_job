<?php
function publicationGet($count=''){
    if($count>0){
        $arNavStartParams = array(
            'nTopCount' => $count,
        );
    }
    $res = CIBlockElement::GetList(
        array("SORT"=> 'ASC'),
        Array("IBLOCK_ID" => 43, "ACTIVE"=>"Y" ),
        false,
        $arNavStartParams,
        array('CODE', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_TEXT'));
    while ($ob = $res->GetNextElement()) {
        $Elem = $ob->GetFields();
        $item['CODE'] = $Elem['CODE'];
        $item['pic']['max'] = imageFormatPublication($Elem['PREVIEW_PICTURE'],500, 250);
        $item['pic']['min'] = imageFormatPublication($Elem['PREVIEW_PICTURE'], 408, 204);
        $item['DETAIL_TEXT'] = substr($Elem['DETAIL_TEXT'], 0, 405);
        $item['NAME'] = $Elem['NAME'];
        $result[] = $item;

    }
    return $result;
}

function publicationIDGet($arItems){
    $res = CIBlockElement::GetList(
        array("SORT"=> 'ASC'),
        Array("ID" =>  $arItems),
        false,
        false,
        array());
    while ($ob = $res->GetNextElement()) {
        $Elem = $ob->GetFields();
        $result[] = $Elem;

    }
    return $result;
}

// форматирование изображения

function imageFormatPublication($id, $width, $height)
{
    $arFileTmp = CFile::ResizeImageGet(
        $id,
        array("width" => $width, "height" => $height),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true,
        array(
            "name" => "sharpen",
            "precision" => 15
        ),
        true,
        55
    );
    return $arFileTmp["src"];
}