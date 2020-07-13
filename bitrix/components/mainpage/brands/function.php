<?php
function brandsLink(){
    $res = CIBlockElement::GetList(
        array("SORT"=>"ASC"),
        Array("IBLOCK_ID" => 37, "ACTIVE"=>"Y" ),
        false,
        false,
        array('CODE', 'DETAIL_PICTURE'));
    while ($Elem = $res->GetNext()) {
//        $Elem = $ob->GetFields();
        if($Elem['DETAIL_PICTURE']){
            $result[$Elem['CODE']] = $Elem['DETAIL_PICTURE'];
        }
    }
    return $result;
}