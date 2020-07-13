<?php
//define("NO_KEEP_STATISTIC", true);
//define("NOT_CHECK_PERMISSIONS", true);
//$_SERVER['DOCUMENT_ROOT'] = '/var/www/www-root/data/www';
//if(isset($_REQUEST['leads']))
//{
//    require_once($_SERVER['DOCUMENT_ROOT'] . "/amocrm/config_backup.php");
//    $mysqli = new mysqli($config['host'], $config['username'], $config['passwd'], $config['dbname']);
////Выводим любую ошибку соединения
//
//    if ($mysqli->connect_errno) {
//        echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error . PHP_EOL;
//    }
//    foreach ($_REQUEST['leads']['delete'] as $lead){
//        $query = "UPDATE leads SET is_deleted = 1 WHERE id = " . $lead['id'];
//        $mysqli->query($query);
//    }
//}

$event = $_REQUEST;

// Помечаем удаленные сделки в MySQL
if(isset($event['leads']['delete'])) {
    $mysqli = new mysqli("91.240.85.195", "****", "******", "*****");

    $arLeads = $event['leads']['delete'];
    $arLeadIDs = Array();
    foreach($arLeads as $lead) {
        $arLeadIDs[] = intval($lead['id']);
    }
    $query = "UPDATE `leads` SET `is_deleted` = 1 WHERE `id` IN (".implode(',', $arLeadIDs).")";
    $mysqli->query($query);
}

$fp = fopen(__DIR__.'/leads.json', 'a');
fwrite($fp, json_encode($event));
fclose($fp);