<?php
function getPublicationID($id){
    $res = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => "39", 'ID' => $id), false, $arSelect = array("UF_*"));
    if($ar_res = $res->GetNext()){
        $result = $ar_res['UF_PUBLICATION'];
    }
    return $result;
}
function getSectionInfo($id){
    $res = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => "39", 'ID' => $id), false, $arSelect = array("UF_*"));
    if($ar_res = $res->GetNext()){
        $result = $ar_res;
    }
    return $result;
}