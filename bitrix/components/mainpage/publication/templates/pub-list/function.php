<?php
function arPublications($page = 1){
    $Iblock = 43;
    $navparams = array(
        'nTopCount' => false,
        'nPageSize' => 10,
        'iNumPage' => $page,
        'checkOutOfRange' => true
    );
    $res = CIBlockElement::GetList(
        array("SORT"=> 'ASC'),
        Array("IBLOCK_ID" => $Iblock, "ACTIVE"=>"Y", ),
        false,
        $navparams,
        array());
    while ($ob = $res->GetNextElement()) {
        $elem = $ob->GetFields();
        $elem["PROPERTIES"] = $ob->GetProperties();
        $result[] = $elem;
    }
    return $result;
}

function arPublication($id = ''){
    $Iblock = 43;
    $res = CIBlockElement::GetList(
        array("SORT"=> 'ASC'),
        Array("IBLOCK_ID" => $Iblock, "ACTIVE"=>"Y", "CODE"=> $id),
        false,
        false,
        array());
    while ($ob = $res->GetNextElement()) {
        $elem = $ob->GetFields();
        $elem["PROPERTIES"] = $ob->GetProperties();
        $result[] = $elem;
    }
    return $result;
}