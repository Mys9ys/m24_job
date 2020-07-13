<?php
function getProductSets($id){
    $rsElem = CCatalogProductSet::getList(
        array(),
        array(
            'TYPE' => CCatalogProductSet::TYPE_GROUP,
            'ITEM_ID' => $id),
        false,
        false,
        array('SET_ID', 'OWNER_ID', 'ITEM_ID')
    );
    while ( $set = $rsElem->Fetch() ){
        $result[] = $set;
    }
    return $result;
}

//function getSecondItemID($set, $id){
//    $arSets = CCatalogProductSet::getList(
//        array(), array(
//        'TYPE' => CCatalogProductSet::TYPE_GROUP,
//        "OWNER_ID" => $set
//    ), false, false, array("OWNER_ID", "ITEM_ID")
//    );
//    while( $set2 = $arSets->Fetch() ){
//        if( $set2["OWNER_ID"]!=$set2["ITEM_ID"]){
//            if($set2["ITEM_ID"]!=$id){
//
//                $result['ITEM_ID'] = $set2['ITEM_ID'];
//                $result['info'] = getSecondItemLink($result['ITEM_ID']);
//            }
//        }
//    }
//    return $result;
//}
//
//function getSecondItemLink($id){
//    $res = CIBlockElement::GetList(
//        array(),
//        Array("IBLOCK_ID" => 39, "ACTIVE"=>"Y", "ID"=>$id ),
//        false,
//        false,
//        array('DETAIL_PAGE_URL', 'NAME'));
//    while ($ob = $res->GetNextElement()) {
//        $Elem = $ob->GetFields();
//    }
//    return $Elem;
//}