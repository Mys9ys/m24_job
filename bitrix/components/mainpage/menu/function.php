<?php
function responseOnMain()
{
    $Iblock_response = 41;
    $res = CIBlockElement::GetList(
        Array("RAND"=>"ASC"),
        Array("IBLOCK_ID" => $Iblock_response,
            "ACTIVE" => "Y"
        ),
        false,
        false,
        array());
    while ($ob = $res->GetNextElement()) {
        $response = $ob->GetFields();
        $response["PROPERTIES"] = $ob->GetProperties();
    }
    return $response;
}