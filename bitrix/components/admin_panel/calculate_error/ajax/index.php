<?php
error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");
CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));

// Массив ответа
$msg = array(
    'error' => false,
    'text' => ''
);
// экранируем полученную информацию
foreach ($_POST as $key => $field) {
    $_POST[$key] = addslashes($field);
}

if (empty($_POST['type']) && $_POST['type'] != 'handmade'){
    $msg['error'] = true;
}

if (!$msg['error']) {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/api/class/Amo2.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . '/api/config.php');
    $crm = new AmoCRMClient($config['login'], $config['apikey'], $config['root']);

    $LogsLeadsProfit = 'arProfitLeads_' . date('d_m_Y');
    $arErrAllToday = 'err_' . time();

## <-----BEGIN-----> выборка сделок для учета маржинальности
    $type1 = array(
        1279749,
    );
    $type2 = array(
        1279743,
        1279745,
        1279747
    );
    $type3 = array(
        1279751,
        1279753,
        1279755,
        1279757,
        1280111
    );
    $type4deliv = array(
        1276125
    );

    $task_lead = '';
    $arGetLeads = array();
    ## выбираем сделки за период
    if(!empty($_POST['count'])){
        for ($i = 0; $i < 20; $i++) {
            set_time_limit(30);
            $part = $crm->GetMonthLeads($i,$_POST['count']);
            if (!empty($part)) {
                $arGetLeads = array_merge($arGetLeads, $part);
            }
        }
    } else {
        ## выбираем сделки за сутки
        $arGetLeads=$crm->GetTodayLeads();
    }

//$arGetLeads=$crm->GetLeadsByID(20629717);

//$arGetLeads = array();
    $arLeadsCompleteMerge = array();    ## сделки с заполненой маржой
    $arErrorCalculate = array();        ## не заполнены поля в сделках
    $arNewError = array();              ## в сделках есть скидки или удержания по рассрочке или банковской карте
    $arCalculateLeads = array();

    foreach ($arGetLeads as $lead) {
        set_time_limit(30);
        ## если нет товара - пропускаем
        $flag = true;
        $flag_sale_prop = false;
        foreach ($lead['custom_fields'] as $field) {
            if ($field['id'] == 513307) {
                if ($field['values'][0]['value'] > -1) {
                    $flag = false;
                }
            }
            ## обозначаем что в сделке есть рассрочка CrediLine
            if ($field['id'] == 569257) {
                if(!empty($field['values'][0]['value'])){
                    $arNewError[$lead['id']]['error'] = 'в сделке присутствует процент рассрочки';
                    $arNewError[$lead['id']]['status_id'] = $lead['status_id'];
                }
            }
            ## обозначаем что в сделке есть Инд. скидка %
            if ($field['id'] == 525527) {
                if(!empty($field['values'][0]['value'])){
                    $arNewError[$lead['id']]['error'] = 'в сделке присутствует Инд. скидка %';
                    $arNewError[$lead['id']]['status_id'] = $lead['status_id'];
                }
            }
            ## проверка на вариант продажи
            if ($field['id'] == 601121) {
                $flag_sale_prop = true;
            }
            ## проверка на вариант доставки
            if ($field['id'] == 584777) {
                $flag_delivery_prop = true;
            }
        }

        $flag_delivery_prop = false;
        if ($flag == true && !empty($lead['catalog_elements'])) {
            foreach ($lead['custom_fields'] as $field) {
                set_time_limit(30);
                ### если заполнено - пропускаем
                if ($field['id'] != 513307) {
                    ## проверка на вариант продажи
                    if ($field['id'] == 601121) {

//                dd($field);
                        if (in_array($field['values'][0]['enum'], $type1)) {
                            $lead['type'] = 'type1';
                            $arCalculateLeads[$lead['id']] = $lead;
                        }
                        if (in_array($field['values'][0]['enum'], $type2)) {
                            $lead['type'] = 'type2';
                            $arCalculateLeads[$lead['id']] = $lead;
                        }
                        if (in_array($field['values'][0]['enum'], $type3)) {
                            $lead['type'] = 'type3';
                            $arCalculateLeads[$lead['id']] = $lead;
                        }
                    }

                    ## проверка на вариант доставки
                    if ($field['id'] == 584777) {
                        if (in_array($field['values'][0]['enum'], $type4deliv)) {
                            $lead['type'] = 'type4';
                            $arCalculateLeads[$lead['id']] = $lead;
                        }
                    }

                }
            }
        }
        if ($flag_sale_prop == false) {
            $task_lead = $lead['id'];
            $arErrorCalculate[$lead['id']]['status1'] = 'не заполнен вид продажи';
            $arErrorCalculate[$lead['id']]['status_id'] = $lead['status_id'];
            ##'не заполнен вид продажи';
        }
        if ($flag_delivery_prop == false && empty($arCalculateLeads[$lead['id']])) {
            $task_lead = $lead['id'];
            $arErrorCalculate[$lead['id']]['status4'] = 'не заполнен вариант доставки';
            $arErrorCalculate[$lead['id']]['status_id'] = $lead['status_id'];
            ##'не заполнен вариант доставки';
        }
        if (empty($lead['catalog_elements']) && empty($arCalculateLeads[$lead['id']])) {
            $task_lead = $lead['id'];
            $arErrorCalculate[$lead['id']]['status2'] = 'нет товара';
            $arErrorCalculate[$lead['id']]['status_id'] = $lead['status_id'];
            ##'нет товара';
        }
        if ($flag == false) {
            $arLeadsCompleteMerge[$lead['id']] = 'Complete';
            unset($arErrorCalculate[$lead['id']]);
            ##'заполнено';
        }
    }

    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/api/leads_profit/logs/arNewError.json','w');
    fwrite($fp, json_encode($arNewError));
    fclose($fp);

    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/api/leads_profit/logs/arLeadsCompleteMerge.json','w');
    fwrite($fp, json_encode($arLeadsCompleteMerge));
    fclose($fp);

    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/api/leads_profit/logs/errCalculate.json','w');
    fwrite($fp, json_encode($arErrorCalculate));
    fclose($fp);

    $arManyProducts = array();              ## более одного товара
    $arCountMerge = array();
    $arErrorWriteCalculate = array();       ## ошибка вычисления из-за пробелов в полях товара
    $ProfitLeads = $arCalculateLeads;

    foreach ($ProfitLeads as $lead) {
        set_time_limit(30);
        $arManyProductProfit =0;
        if ($lead['type'] == 'type1' || $lead['type'] == 'type2') {
            if (count($lead['catalog_elements']['id']) == 1) {
                $product = $crm->GetCatalogElementsById($lead['catalog_elements']['id'][0]);
                $arItems = array(
                    236099 => array(
                        'operation' => 'plus',
                        'name' => 'розничная цена'
                    ),
                    602895 => array(
                        'operation' => 'minus',
                        'name' => 'закупочная цена'
                    )
                );
                $result = CalculatePartAjax($arItems, $product, $lead['id'], $lead['status_id']);
                if(PriceControlFuncAjax($product, $lead['sale']) == true){
                    $arNewError[$lead['id']]['error'] = 'возможно в сделке 2 единицы товара';
                    $arNewError[$lead['id']]['status_id'] = $lead['status_id'];
                }
            }
            ## более 1 товара
            if (count($lead['catalog_elements']['id']) > 1){
                foreach ($lead['catalog_elements']['id'] as $prod){
                    $product = $crm->GetCatalogElementsById($prod);
                    $arItems = array(
                        236099 => array(
                            'operation' => 'plus',
                            'name' => 'розничная цена'
                        ),
                        602895 => array(
                            'operation' => 'minus',
                            'name' => 'закупочная цена'
                        )
                    );
                    $result = CalculatePartAjax($arItems, $product, $lead['id'], $lead['status_id']);
                    if (!empty($result['profit'] && empty($result['error']))) {
                        $arManyProductProfit += $result['profit']['count'];
                        $result = [];
                    }
                }
                $arManyProducts[$lead['id']] = $lead['catalog_elements']['id'];
            }
        }

        if ($lead['type'] == 'type3') {
            if (count($lead['catalog_elements']['id']) == 1) {
                $product = $crm->GetCatalogElementsById($lead['catalog_elements']['id'][0]);
                $arItems = array(
                    602897 => array(
                        'operation' => 'plus',
                        'name' => 'маржа'
                    ),
                );
                $result = CalculatePartAjax($arItems, $product, $lead['id'], $lead['status_id']);
                if(PriceControlFuncAjax($product, $lead['sale']) == true){
                    $arNewError[$lead['id']]['error'] = 'возможно в сделке 2 единицы товара';
                    $arNewError[$lead['id']]['status_id'] = $lead['status_id'];
                }
            }
            ## более 1 товара
            if (count($lead['catalog_elements']['id']) > 1) {
                foreach ($lead['catalog_elements']['id'] as $prod){
                    $product = $crm->GetCatalogElementsById($prod);
                    $arItems = array(
                        236099 => array(
                            'operation' => 'plus',
                            'name' => 'розничная цена'
                        ),
                        602895 => array(
                            'operation' => 'minus',
                            'name' => 'закупочная цена'
                        )
                    );
                    $result = CalculatePartAjax($arItems, $product, $lead['id'], $lead['status_id']);
                    if (!empty($result['profit'] && empty($result['error']))) {
                        $arManyProductProfit += $result['profit']['count'];
                        $result = [];
                    }
                }
                $arManyProducts[$lead['id']] = $lead['catalog_elements']['id'];
            }

        }

        if ($lead['type'] == 'type4') {
            if (count($lead['catalog_elements']['id']) == 1) {
                $product = $crm->GetCatalogElementsById($lead['catalog_elements']['id'][0]);
                $arItems = array(
                    602899 => array(
                        'operation' => 'plus',
                        'name' => 'Цена Супер-дистрибьютор'
                    ),
                    602895 => array(
                        'operation' => 'minus',
                        'name' => 'закупочная цена'
                    ),
                );
                $result = CalculatePartAjax($arItems, $product, $lead['id'], $lead['status_id']);
                if(PriceControlFuncAjax($product, $lead['sale']) == true){
                    $arNewError[$lead['id']]['error'] = 'возможно в сделке 2 единицы товара';
                    $arNewError[$lead['id']]['status_id'] = $lead['status_id'];
                }
            }
            ## более 1 товара
            if (count($lead['catalog_elements']['id']) > 1){
                foreach ($lead['catalog_elements']['id'] as $prod){
                    $product = $crm->GetCatalogElementsById($prod);
                    $arItems = array(
                        236099 => array(
                            'operation' => 'plus',
                            'name' => 'розничная цена'
                        ),
                        602895 => array(
                            'operation' => 'minus',
                            'name' => 'закупочная цена'
                        )
                    );
                    $result = CalculatePartAjax($arItems, $product, $lead['id'], $lead['status_id']);
                    if (!empty($result['profit'] && empty($result['error']))) {
                        $arManyProductProfit += $result['profit']['count'];
                        $result = [];
                    }
                }
                $arManyProducts[$lead['id']] = $lead['catalog_elements']['id'];
            }
        }

        ## 587463 стоимость доставки
        foreach ($lead['custom_fields'] as $field) {
            if ($field['id'] == 587463) {
                if (!empty($field['values'][0]['value'] && !empty($result['profit']))) {
                    $result['profit']['count'] -= intval($field['values'][0]['value']);
                }
            }
        }

//    dd($result);

        if (!empty($result['error'])) {
            $arErrorWriteCalculate[$lead['id']] = $result['error'];
        }
        if (!empty($result['profit'])) {
            $arCountMerge[$result['profit']['lead_id']] = $result['profit'];
//        UpdateLeadProfit($crm, $result['profit']);
        }
        if ($arManyProductProfit>0) {
            $arCountMerge[$lead['id']]['lead_id'] = $lead['id'];
            $arCountMerge[$lead['id']]['count'] = $arManyProductProfit;

//        UpdateLeadProfit($crm, $result['profit']);
        }

    }

    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/api/leads_profit/logs/arCountMerge.json', 'w');
    fwrite($fp, json_encode($arCountMerge));
    fclose($fp);

    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/api/leads_profit/logs/arManyProducts.json', 'w');
    fwrite($fp, json_encode($arManyProducts));
    fclose($fp);

    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/api/leads_profit/logs/arErrorWriteCalculate.json', 'w');
    fwrite($fp, json_encode($arErrorWriteCalculate));
    fclose($fp);

    foreach ($arCountMerge as $lead=>$profit){
//    dd($profit);
        UpdateLeadProfitAjax($crm, $profit);
    }

    $arErrLog = array(
        'date' => time(),
        'errLeads' => $arErrorCalculate,
        'errProduct' => $arErrorWriteCalculate,
        'warnings' => $arNewError
    );

    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/api/leads_profit/logs/error/'. $arErrAllToday . '.json','w');
    var_dump(fwrite($fp, json_encode($arErrLog)));
    fclose($fp);

}

## функция вычисления маржи и определение не заполненых полей товара
function CalculatePartAjax($arItems, $product, $lead_id, $status_id)
{
    $profit = 0;
    $result = array();
    ## заполняем массив ошибок
    foreach ($arItems as $item => $arProp) {
        $result['error'][$lead_id]['field'] = $item;
        $result['error'][$lead_id]['info'] = $arProp['name'];
        $result['error'][$lead_id]['product_name'] = $product['name'];
        $result['error'][$lead_id]['product_id'] = $product['id'];
        $result['error'][$lead_id]['status_id'] = $status_id;
    }
    ## проходим по всем кастомным полям
    foreach ($product['custom_fields'] as $field) {
        foreach ($arItems as $item => $arProp) {
            if ($field['id'] == $item) {
                if (!empty($field['values'][0]['value'])) {
                    ## есть значение - удаляем ошибку и выполняем арифмитическое действие с маржой
                    unset($result['error'][$lead_id]);
                    if ($arProp['operation'] == 'plus') {
                        $profit += intval($field['values'][0]['value']);
                    } else {
                        $profit -= intval($field['values'][0]['value']);
                    }
                }
            }
        }
    }
    ## ошибок нет - удаляем массив ошибок и добавляем вычисленную маржу
    if (empty($result['error'][$lead_id])) {
        unset($result['error']);
        $result['profit']['lead_id'] = $lead_id;
        $result['profit']['count'] = $profit;
    }
    return $result;
}

function UpdateLeadProfitAjax($crm, $profit)
{
    set_time_limit(30);
    $arUpdate = Array(
        "id" => $profit['lead_id'],
        "last_modified" => time(),
        "custom_fields" => Array(
            ## 513307 маржа со сделки
            Array(
                'id' => 513307,
                'values' => Array(
                    Array(
                        'value' => $profit['count']
                    )
                )
            )
        )
    );
//    dd($arUpdate);
    $crm->LeadUpdate($arUpdate);
    $crm->AddNote($profit['lead_id'], 2, 4, 'маржинальность расчитана автоматически и составила: ' . $profit['count']);
}

function PriceControlFuncAjax($product,$sale){
    $result = false;
    foreach ($product['custom_fields'] as $field) {
        if ($field['id'] == 236099) {
            $res = intval($sale)/intval($field['values'][0]['value']);
        }
    }
    if($res>1.9){
        $result = true;
    }
    return $result;
}
## 236099 розничная цена
## 602895 закупочная
## 602897 маржа
## 602899 Цена Супер-дистрибьютор
## 587463 стоимость доставки
## 513307 маржа со сделки