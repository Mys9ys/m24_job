<?php
$event = $_REQUEST;

// Помечаем удаленные сделки в MySQL
if(isset($event['contacts']['delete'])) {
    $mysqli = new mysqli("91.240.85.195", "****", "******", "*****");

    $arLeads = $event['contacts']['delete'];
    $arLeadIDs = Array();
    foreach($arLeads as $lead) {
        $arLeadIDs[] = intval($lead['id']);
    }
    $query = "UPDATE `contacts` SET `is_deleted` = 1 WHERE `id` IN (".implode(',', $arLeadIDs).")";
    $mysqli->query($query);
}

$fp = fopen(__DIR__.'/contacts.json', 'a');
fwrite($fp, json_encode($event));
fclose($fp);