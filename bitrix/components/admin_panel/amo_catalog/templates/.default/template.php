<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? $APPLICATION->SetAdditionalCSS('/bitrix/components/admin_panel/amo_catalog/style.css'); ?>
<?php
set_time_limit(300);
require_once($_SERVER['DOCUMENT_ROOT'] . "/api/class/Amo2.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/api/config.php");
$crm = new AmoCRMClient($config['login'], $config['apikey'], $config['root']);

?>
<div class="wrapper">
    <div class="left_box">
        <a class="btn_load_amo lamp_sale" href="/content/admin_panel/amo_catalog.php?load=true">Выгрузить каталог из amoCRM</a>
    </div>
    <div class="rigth_box">

        <? if (!empty($_FILES)) { ?>
            <? if ($_FILES["upload_file"]["error"] > 0) { ?>
                <span class="lamp_error message_style">Ошибка загрузки!</span><br/>
            <? } else { ?>
                <? if (empty($error_array)) { ?>
                    <span class="lamp_sale message_style">Файл успешно загружен!</span>
                <? } ?>
            <? } ?>
        <? } ?>

        <form action="/content/admin_panel/amo_catalog.php" method="POST" enctype="multipart/form-data">
            <input class="btn_load_amo lamp_consultation" type="file" name="upload_file"><br>
            <input class="btn_load_amo lamp_sale" type="submit" value="Загрузить"><br>
        </form>
    </div>
    <div style="clear: both;"></div>

</div>


<?


if ($_GET['load'] == true) {
    loadAmoProducts($crm);
}

// ограничение размера файла
$limit_size = 1 * 1024 * 1024; // 1 Mb
// корректные форматы файлов
$valid_format = array("csv");
// хранилище ошибок
$error_array = array();
// путь до нового файла
$path_file = $_SERVER['DOCUMENT_ROOT'] . "/bitrix/components/admin_panel/amo_catalog/data/";
// имя нового файла
$rand_name = 'load.csv';

// если есть отправленные файлы
if ($_FILES) {

    // валидация размера файла
    if ($_FILES["upload_file"]["size"] > $limit_size) {
        $error_array = "Размер файла превышает допустимый!";
    }
    // валидация формата файла
    $format = end(explode(".", $_FILES["upload_file"]["name"]));
    if (!in_array($format, $valid_format)) {
        $error_array = "Формат файла не допустимый!";
    }


    // если не было ошибок
    if (empty($error_array)) {
        // проверяем загружен ли файл
        if (is_uploaded_file($_FILES["upload_file"]["tmp_name"])) {
            // сохраняем файл
            move_uploaded_file($_FILES["upload_file"]["tmp_name"], $path_file . $rand_name);
            UpdateCatalogCRM($crm, $path_file . $rand_name);
        } else {
            // Если файл не загрузился
            $error_array = "Ошибка загрузки!";
        }
    }
}

$file_error = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/arError.json';
if (file_exists($file_error)) {
    $json_request = file_get_contents($file_error);
    $arCatalog = json_decode($json_request, true);
    ?>
    <div class="merge_error_box">
        <?= $arCatalog ?>
    </div>
    <?
    unlink($file_error);
}


function UpdateCatalogCRM($crm, $file)
{
    ## кодируем поля для проверки изменений
    $arCustomField = array(
        236303 => 0,
        236323 => 2,
        236095 => 3,
        236141 => 4,
        236099 => 5,
        236489 => 6,
        602895 => 7,
        602897 => 8,
        602899 => 9,
    );

    ## выгружаем каталог для проверки
    $arControl = array();
    for ($i = 0; $i < 15; $i++) {
        set_time_limit(30);
        $arProducts = $crm->GetCatalogElementsList($i);
        foreach ($arProducts as $product) {
            set_time_limit(30);
            $arProductField = array(
                0 => '',
                1 => '',
                2 => '',
                3 => '',
                4 => '',
                5 => '',
                6 => '',
                7 => '',
                8 => '',
                9 => '',
            );
            $arProductField[1] = $product['name'];
            foreach ($product['custom_fields'] as $field) {
                $arField[$field['id']] = $field['name'];
                $arProductField[$arCustomField[$field['id']]] = $field['values'][0]['value'];
            }
            $arControl[$arProductField[2]] = $arProductField;
        }
    }

    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/arrControl.json', 'w');
    fwrite($fp, json_encode($arControl));
    fclose($fp);

    $json_request = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/arrControl.json');
    $arCatalog = json_decode($json_request, true);

    ## Обрабатываем загруженный файл
    $csv = file_get_contents($file);

    if (strpos($csv, PHP_EOL) != false) {
        $rows = explode(PHP_EOL, $csv);
    } else {
        $rows = preg_split("/\r\n|\n|\r/", $csv);
    }
    $arCatalogCSV = [];
    $delimiter = ';';
    foreach ($rows as $row) {
        $arCatalogCSV[] = explode($delimiter, iconv("windows-1251", "utf-8", str_replace('"', '', $row)));
    }

//    dd($arCatalogCSV);
    ## проводим сравнение
    $arUpdateItems = array();
    foreach ($arCatalogCSV as $catalogItem) {

        $result = array_diff($catalogItem, $arCatalog[$catalogItem[2]]);

        if (!empty($result)) {
            $arUpdateItems[$catalogItem[2]] = $result;
            $arUpdateItems[$catalogItem[2]][1] = $catalogItem[1];
        } else {
            if (array_key_exists($catalogItem[2], $arCatalog) == false) {
                if (is_numeric($catalogItem[2])) {
                    ## записываем все отличия
                    $arUpdateItems[$catalogItem[2]] = $catalogItem;
                }
            };
        }
    }

    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/arUpdateItems.json', 'w');
    fwrite($fp, json_encode($arUpdateItems));
    fclose($fp);

    $json_request = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/arUpdateItems.json');
    $arUpdateItems = json_decode($json_request, true);

    ## массив для декодирования
    $arCustomFieldsDecode = array(
        0 => 236303,
        2 => 236323,
        3 => 236095,
        4 => 236141,
        5 => 236099,
        6 => 236489,
        7 => 602895,
        8 => 602897,
        9 => 602899,
    );

    $all = array();
    $arErrorInfo = '';

    ## выбираем товары, которые изменены (по bitrix_id)
    foreach ($arUpdateItems as $bitrix_id => $fields) {
        $itemSearch = $crm->GetCatalogElementsByField($bitrix_id);
        set_time_limit(30);

        ## найден один элемент
        if (count($itemSearch) == 1) {
            $custom_fields = array();
            foreach ($fields as $id_decode => $field) {
                ## заполняем кастомные поля
                if (!empty($arCustomFieldsDecode[$id_decode])) {
                    $custom_fields[] = array(
                        "id" => $arCustomFieldsDecode[$id_decode],
                        "values" => array(
                            Array(
                                "value" => $field
                            ),
                        )
                    );
                }
            }

            if (findBitrixID($bitrix_id, $itemSearch[0]['custom_fields']) == true) {
                $arUpdate = array(
                    "catalog_id" => 4307,
                    "updated_at" => time(),
                    "id" => $itemSearch[0]['id'],
                    "name" => $itemSearch[0]['name'],
                    "custom_fields" => $custom_fields,
                );
                $req["update"] = array(
                    $arUpdate
                );
            }
        }

        ## найдено более одного элемента каталога
        if (count($itemSearch) > 1) {
            foreach ($itemSearch as $item) {
                if (findBitrixID($bitrix_id, $item['custom_fields']) == true) {
                    $custom_fields = array();
                    foreach ($fields as $id_decode => $field) {
                        ## заполняем кастомные поля
                        if (!empty($arCustomFieldsDecode[$id_decode])) {
                            $custom_fields[] = array(
                                "id" => $arCustomFieldsDecode[$id_decode],
                                "values" => array(
                                    Array(
                                        "value" => $field
                                    ),
                                )
                            );
                        }
                    }

                    $arUpdate = array(
                        "catalog_id" => 4307,
                        "updated_at" => time(),
                        "id" => $item['id'],
                        "name" => $item['name'],
                        "custom_fields" => $custom_fields
                    );
                    $req["update"] = array(
                        $arUpdate
                    );
                }
            }
        }


        ## если не находится – создаем новую запись
        if (empty($itemSearch)) {
            $custom_fields = array();
            foreach ($fields as $id_decode => $field) {
                if (!empty($arCustomFieldsDecode[$id_decode])) {
                    $custom_fields[] = array(
                        "id" => $arCustomFieldsDecode[$id_decode],
                        "values" => array(
                            Array(
                                "value" => $field
                            ),
                        )
                    );
                }
            }
            if (!empty($fields[1])) {
                $name = $fields[1];
            } else {
                $name = 'Уточнить название';
            }

            $arAdd = array(
                "catalog_id" => 4307,
                "updated_at" => time(),
                "name" => $name,
                "custom_fields" => $custom_fields
            );
            $req["add"] = array(
                $arAdd
            );
        }


        if (empty($ErrDouble)) {
            set_time_limit(30);
            $crm->CatalogElementsSave($req);
        } else {
            $arErrorInfo .= $ErrDouble;
        }
    }
    if (!empty($arErrorInfo)) {
        $TodayError = 'error_' . time();
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/arError.json', 'w');
        fwrite($fp, json_encode($arErrorInfo));
        fclose($fp);
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/' . $TodayError . '.json', 'w');
        fwrite($fp, json_encode($arErrorInfo));
        fclose($fp);
    }
}


function findBitrixID($bid, $custom_fields)
{
    foreach ($custom_fields as $field) {
        if ($field['id'] == 236323) {
            if ($field['values'][0]['value'] == $bid) {
                return true;
            } else {
                return false;
            }
        }
    }
}

function loadAmoProducts($crm)
{
    $TodayLogName = 'arCatalogElem_' . date('d_m_Y');

    $arAmoContactsAll = array();
    $arError = array();

## загружаем элементы каталога из амо
    for ($i = 0; $i < 15; $i++) {
        set_time_limit(30);
        $arProducts = $crm->GetCatalogElementsList($i);
        foreach ($arProducts as $product) {
            $bitrixFlag = false;
            ## выбираем с заполненым полем битрикс id
            foreach ($product['custom_fields'] as $field) {
                if ($field['id'] == 601167 || $field['id'] == 236323) {
                    $arAmoContactsAll[$field['values'][0]['value']] = $product;
                    $bitrixFlag = true;
                }
            }
            if ($bitrixFlag == false) {
                $arError[$product['id']] = $product;
            }
        }
    }

    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/data.json', 'w');
    fwrite($fp, json_encode($arAmoContactsAll));
    fclose($fp);

    $json_request = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/data.json');
    $arCatalog = json_decode($json_request, true);


## создаем файл csv
    $file_load = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/admin_panel/amo_catalog/data/data.csv';
    $fp = fopen($file_load, 'w');
## подписываем выгружаемые столбцы
    $header = array(
        0 => iconv("utf-8", "windows-1251", "Категория"),
        1 => iconv("utf-8", "windows-1251", "Название"),
        2 => iconv("utf-8", "windows-1251", "ID битрикс"),
        3 => iconv("utf-8", "windows-1251", "Артикул"),
        4 => iconv("utf-8", "windows-1251", "Цвет"),
        5 => iconv("utf-8", "windows-1251", "Розничная цена"),
        6 => iconv("utf-8", "windows-1251", "Производитель"),
        7 => iconv("utf-8", "windows-1251", "Закупочная цена"),
        8 => iconv("utf-8", "windows-1251", "Маржа"),
        9 => iconv("utf-8", "windows-1251", "Супер-дистрибьютор"),
    );

    fputcsv($fp, $header, ';');

## парсим кастомные поля - если пустые - сохраняем пустые
    foreach ($arCatalog as $item) {
        set_time_limit(30);
        $arCSV = array();

        $arCSV[1] = iconv("utf-8", "windows-1251", trim($item['name'], '"'));
        if (empty($arCSV[1])) $arCSV[1] = '';
        foreach ($item['custom_fields'] as $field) {

            ## категория
            if ($field['id'] == 236303) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[0] = iconv("utf-8", "windows-1251", trim($field['values'][0]['value'], '"'));
                }
            }
            if (empty($arCSV[0])) $arCSV[0] = '';

            ## id
            if ($field['id'] == 236323) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[2] = iconv("utf-8", "windows-1251", trim($field['values'][0]['value'], '"'));
                }
            }
            if (empty($arCSV[2])) $arCSV[2] = '';

            ## Артикул
            if ($field['id'] == 236095) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[3] = iconv("utf-8", "windows-1251", $field['values'][0]['value']);
                }
            }
            if (empty($arCSV[3])) $arCSV[3] = '';

            ##  Цвет
            if ($field['id'] == 236141) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[4] = iconv("utf-8", "windows-1251", $field['values'][0]['value']);
                }
            }
            if (empty($arCSV[4])) $arCSV[4] = '';

            ## Розничная цена
            if ($field['id'] == 236099) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[5] = iconv("utf-8", "windows-1251", $field['values'][0]['value']);
                }
            }
            if (empty($arCSV[5])) $arCSV[5] = '';

            ## Производитель
            if ($field['id'] == 236489) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[6] = iconv("utf-8", "windows-1251", $field['values'][0]['value']);
                }
            }
            if (empty($arCSV[6])) $arCSV[6] = '';

            ## Закупочная цена
            if ($field['id'] == 602895) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[7] = iconv("utf-8", "windows-1251", $field['values'][0]['value']);
                }
            }
            if (empty($arCSV[7])) $arCSV[7] = '';

            ## Маржа
            if ($field['id'] == 602897) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[8] = iconv("utf-8", "windows-1251", $field['values'][0]['value']);
                }
            }
            if (empty($arCSV[8])) $arCSV[8] = '';

            ## Цена Супер-дистрибьютор
            if ($field['id'] == 602899) {
                if (!empty($field['values'][0]['value'])) {
                    $arCSV[9] = iconv("utf-8", "windows-1251", $field['values'][0]['value']);
                }
            }
            if (empty($arCSV[9])) $arCSV[9] = '';
        }

        ## сортируем массив
        ksort($arCSV, SORT_NUMERIC);
        fputcsv($fp, $arCSV, ';');

    }

    fclose($fp);

    ## выгружаем файл пользователю
    if (file_exists($file_load)) {
        if (ob_get_level()) {
            ob_end_clean();
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_load) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_load));
        readfile($file_load);
        unlink($file_load);
        exit;
    }
}


?>





<? $APPLICATION->AddHeadScript("/bitrix/components/admin_panel/amo_catalog/script.js"); ?>

