<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? $APPLICATION->SetAdditionalCSS('/bitrix/components/admin_panel/calculate_error_new/style.css'); ?>
<?php
set_time_limit(300);
require_once($_SERVER['DOCUMENT_ROOT'] . "/amocrm/config_backup.php");

$mysqli = new mysqli($config['host'], $config['username'], $config['passwd'], $config['dbname']);

//Выводим любую ошибку соединения
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error . PHP_EOL;
}


$dayToday = intval(date(j));
$yearToday = intval(date(Y));
$monthToday = intval(date(n));


$query = "SELECT * FROM error_type";
$result = $mysqli->query($query);
while ($row = $result->fetch_assoc()) {
    $arCriticalAllInfo[$row['id']] = $row;
    $arCritical[$row['critical']][] = $row['id'];
}

$arErrorLeads = array();
$arMonthData = array();
for($year = 2019; $year<=$yearToday; $year++){
    for ($i = 1; $i <= 12; $i++) {
        $query = "SELECT * FROM error_find WHERE MONTH(created_at) = " . $i . " AND YEAR(created_at) = " . $year;
        $result = $mysqli->query($query);
        $arAllLeads = array();
        $arWarnings = array();
        $arErrorProduct = array();

        while ($row = $result->fetch_assoc()) {

            $status_id = 3;
            if ($row['lead_status'] == '142') {
                $status_id = 1;
                dd('mi tyt');
            }
            if ($row['lead_status'] == '143') {
                $status_id = 2;
            }

            foreach ($arCritical as $key => $arError) {
                if (in_array($row['error_code'], $arError)) {
                    $arErrSub = array();
                    if ($key === 'product') {

                        $query_prod = "SELECT * FROM catalog WHERE id = " . $row['product_id'];
                        $result_prod = $mysqli->query($query_prod);
                        $product = $result_prod->fetch_assoc();
                        $arErrSub['product_name'] = $product['name'];
                        $arErrSub['info'] = $arCriticalAllInfo[$row['error_code']]['name'];
                        $arErrorProduct[$row['leads_id']] = $arErrSub;
                    }
                    if ($key == 'leads') {
                        $arErrSub['error_name'] = $row['error_code'];
                        $arAllLeads[$status_id][$row['leads_id']][] = $arErrSub;
                    }
                    if ($key == 'warning') {
                        $arErrSub['info'] = $arCriticalAllInfo[$row['error_code']]['name'];
                        $arWarnings[$row['leads_id']] = $arErrSub;
                    }
                }
            }
        }
        $allError['errLeads'] = $arAllLeads;
        $allError['errCatalog'] = $arErrorProduct;
        $allError['Warnings'] = $arWarnings;

        if($year==$yearToday && $i>$monthToday){
//            continue;
        } else {
            $arMonthData[$year][$i] = $allError;
        }
    }
}
dd($arMonthData);
foreach ($arMonthData as $year => $data){
    $arErrorLeads[$year] = array_reverse($data, true);
}
$arErrorLeads = array_reverse($arErrorLeads, true);

?>
<!--<div class="new_calculate_btn">Проверить сейчас</div>-->
<div class="new_calculate_btn">Проверить сейчас</div>
<p>Проверка может занимать до нескольких минут - рекомендуется запускать ее после пакета исправлений</p>
<table class="error_box">
    <tr class="header_table_block">
        <th class="align_center" rowspan=2>Месяц</th>
        <th class="align_center" rowspan=2>Всего</th>
        <th class="tree_block align_center" colspan=3>Ошибки в сделках(По статусам)</th>
        <th class="align_center" rowspan=2>Ошибки в товарах</th>
        <th class="end_col_center" rowspan=2>Доп. вычеты</th>
    </tr>
    <tr class="header_table_block">
        <th class="align_center sale_color">Реализовано</th>
        <th class="align_center close_color">Нереализовано</th>
        <th class="align_center work_color">В работе</th>
    </tr>
</table>
<script>
    $(document).ready(function () {
        var arrAllError = '<?=json_encode($arErrorLeads)?>';

        var parseArrError = $.parseJSON(arrAllError);
        console.log('parseArrError', parseArrError);
        // var month = parseArrError.length;
        $.each(parseArrError, function (year, arData) {
            console.log('year', year);
            $('.error_box').append('<tr class="content_box" ><td class="align_center" colspan="7"><b>Год: ' + year + '</b></td></tr>');
            $.each(arData, function (id, value) {
                var month = formatDate(id);
                date_box = '<td class="align_center">' + month + '</td>';
                // console.log('value', value['errLeads']);

                var all_length = 0, sale_length = 0, close_length = 0, other_length = 0;
                $.each(value['errLeads'], function (lead_id, info) {
                    all_length++;
                    // console.log(lead_id, info);
                    if (lead_id == '2') {
                        $.each(info, function (lead_id, info) {
                            close_length++;
                        });
                    }
                    if (lead_id == '1') {
                        $.each(info, function (lead_id, info) {
                            sale_length++;
                        });
                    }
                    if (lead_id == '3') {
                        $.each(info, function (lead_id, info) {
                            other_length++;
                        });
                    }
                });
                all_length = close_length + sale_length + other_length;
                if (all_length > 0) {
                    // <th class="lead_err_box">
                    sale_box = '<td class="align_center sale_color"> ' + sale_length + '</td>';
                    close_box = '<td class="align_center close_color"> ' + close_length + '</td>';
                    other_box = '<td class="align_center work_color"> ' + other_length + '</td>';
                    all_box = '<td class="align_center"> ' + all_length + '</td>';
                    err_box = all_box + sale_box + close_box + other_box;
                } else {
                    err_box = '<td class="align_center" colspan=4>Ошибок нет</td>';
                }

                var count_product = 0;
                $.each(value['errCatalog'], function (lead_id, info) {
                    count_product++;
                });


                if (count_product > 0) {
                    product_err = '<td class="align_center">' + count_product + '</td>';
                } else {
                    product_err = '<td class="align_center">нет</td>';
                }


                var warning_length = 0;
                $.each(value['Warnings'], function (lead_id, info) {
                    warning_length++;
                });
                if (warning_length > 0) {
                    warning_err = '<td class="end_col_center">' + warning_length + '</td>';
                } else {
                    warning_err = '<td class="end_col_center">нет</td>';
                }


                var content = '<tr class="content_box btn_show_modal" data-year = "'+ year +'" data-id="' + id + '" data-month="' + month + '">' + date_box + err_box + product_err + warning_err + '</tr>';
                $('.error_box').append(content);
            });
        });
        $('.error_box').on('click', '.btn_show_modal', function () {
            var arError = parseArrError[$(this).data('year')][$(this).data('id')];
            $arrSale = [];
            $arrClose = [];
            $arrOther = [];
            var other_length = 0, sale_length = 0, close_length = 0;

            //## ошибки сделок ##\\
            $.each(arError['errLeads'], function (status, error) {
                // console.log('status', status, 'error', error);

                if (status == 1) {
                    $.each(error, function (lead_id, items) {
                        $arrSale.push(fillContentErrAjax(lead_id, items));
                    });
                }
                if (status == 2) {
                    $.each(error, function (lead_id, items) {
                        $arrClose.push(fillContentErrAjax(lead_id, items));
                    });
                }
                if (status == 3) {
                    $.each(error, function (lead_id, items) {
                        $arrOther.push(fillContentErrAjax(lead_id, items));
                    });
                }

            });

            not_err1 = '';
            var append_content_sale = '';
            if ($arrSale.length > 0) {
                $.each($arrSale, function (lead, info) {
                    append_content_sale += info;
                    sale_length++;
                });
            } else {
                not_err1 = 'not_error';
                append_content_sale += 'Ошибок нет';
            }

            not_err2 = '';
            var append_content_close = '';
            if ($arrClose.length > 0) {
                $.each($arrClose, function (lead, info) {
                    append_content_close += info;
                    close_length++;
                });
            } else {
                not_err2 = 'not_error';
                append_content_close += 'Ошибок нет';
            }

            not_err3 = '';
            var append_content_other = '';
            if ($arrOther.length > 0) {
                $.each($arrOther, function (lead, info) {
                    append_content_other += info;
                    other_length++;
                });
            } else {
                not_err3 = 'not_error';
                append_content_other += 'Ошибок нет';
            }

            var collapse1_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn ' + not_err1 + '" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Реализовано ' + sale_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse1_body = '<div id="collapse1" class="panel-collapse collapse in"><div class="panel-body">' + append_content_sale + '</div></div>';
            var collapse1 = '<div class="panel panel-default">' + collapse1_header + collapse1_body + '</div>';

            var collapse2_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn ' + not_err2 + '" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Нереализовано ' + close_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse2_body = '<div id="collapse2" class="panel-collapse collapse"><div class="panel-body">' + append_content_close + '</div></div>';
            var collapse2 = '<div class="panel panel-default">' + collapse2_header + collapse2_body + '</div>';

            var collapse3_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn ' + not_err3 + '" data-toggle="collapse" data-parent="#accordion" href="#collapse3">В работе ' + other_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse3_body = '<div id="collapse3" class="panel-collapse collapse"><div class="panel-body">' + append_content_other + '</div></div>';
            var collapse3 = '<div class="panel panel-default">' + collapse3_header + collapse3_body + '</div>';
            //## ошибки сделок END ##\\

            //## ошибки товаров ##\\
            not_err4 = '';
            var products_error = '';
            var products_length = 0;

            $.each(arError['errCatalog'], function (lead_id, error) {
                console.log(lead_id, error);
                var error_text = '';
                products_length++;
                error_text += '<div class="product_link" ><a target="_blank" href="https://massagers24.amocrm.ru/catalogs/4307?term=' + error['product_name'] + '">' + error['product_name'] + '</a></div>';
                error_text += '<div class="field_name" >не заполнено поле: ' + error['info'] + '</div>';
                products_error += '<div class="product_line">' + error_text + '</div>';
                // console.log(lead_id, error[lead_id]);
            });
            if (products_length < 1) {
                not_err4 = 'not_error';
                products_error += '<div class="product_line">Ошибок нет</div>';
            }

            var collapse4_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn ' + not_err4 + '" data-toggle="collapse" data-parent="#accordion" href="#collapse4">Ошибки в товарах ' + products_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse4_body = '<div id="collapse4" class="panel-collapse collapse"><div class="panel-body">' + products_error + '</div></div>';
            var collapse4 = '<div class="panel panel-default">' + collapse4_header + collapse4_body + '</div>';
            //## ошибки товаров END ##\\

            //## дополнительные вычеты ##\\
            not_err5 = '';
            var warnings_error = '';
            var warnings_length = 0;

            $.each(arError['Warnings'], function (lead_id, error) {
                var error_text = '';
                warnings_length++;
                error_text += '<div class="warnings_lead"><a target="_blank" href="https://massagers24.amocrm.ru/leads/detail/' + lead_id + '">' + lead_id + '</a></div>';
                error_text += '<div class="warnings_info"> ' + error['info'] + '</div>';
                warnings_error += '<div class="warnings_line">' + error_text + '</div>';
            });
            if (warnings_length < 1) {
                not_err5 = 'not_error';
                products_error += '<div class="warnings_line">Ошибок нет</div>';
            }

            var collapse5_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn ' + not_err5 + '" data-toggle="collapse" data-parent="#accordion" href="#collapse5">Прочие ошибки/примечания ' + warnings_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse5_body = '<div id="collapse5" class="panel-collapse collapse"><div class="panel-body">' + warnings_error + '</div></div>';
            var collapse5 = '<div class="panel panel-default">' + collapse5_header + collapse5_body + '</div>';
            //## дополнительные вычеты END ##\\
            $('.modal-header').find('span').remove();
            $('.modal-body').children().remove();
            $('.modal-header').append('<span style="color:rgb(40,40,40);">' + formatDate($(this).data('id')) + '</span>');
            $('.modal-body').append('<div class="panel-group" id="accordion">' + collapse1 + collapse2 + collapse3 + collapse4 + collapse5 + '</div>');


            $('#leadsModal').modal('show');

        });
        $('#leadsModal').on('click', '.close', function () {
            // console.log('close');
            $(this).modal('hide');
        });
        $('.new_calculate_btn').on('click', function () {
            var date_begin_parse = $('.date_begin_parse').val();
            // var targetDate = new Date(date_begin_parse).getTime();
            // var curDate = new Date().getTime();
            // var result = Math.round((curDate - targetDate) / 86400000);

            // if (result) {
            //     data['count'] = result;
            // }


            modal_loader_Ajax();
            var lead_check = {
                type: 'lead_check',
            };
            var catalog = {
                type: 'catalog',
            };
            var lead = {
                type: 'lead',
            };
            var profit = {
                type: 'profit',
            };
            $.post(
                '/bitrix/components/admin_panel/calculate_error_new/ajax/',
                catalog,
                function (result) {
                    $.post(
                        '/bitrix/components/admin_panel/calculate_error_new/ajax/',
                        lead_check,
                        function (result) {

                            $.post(
                                '/bitrix/components/admin_panel/calculate_error_new/ajax/',
                                lead,
                                function (result) {

                                    $.post(
                                        '/bitrix/components/admin_panel/calculate_error_new/ajax/',
                                        profit,
                                        function (result) {
                                            location.reload();
                                        }
                                    )
                                }
                            );
                        }
                    );
                }
            );

        });
    });

    // крутилка
    function modal_loader_Ajax() {
        $('#load_modal').modal('show');
    }

    function formatDate(d) {
        var months = ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];


        return months[d-1];
    }

    function fillContentErrAjax(lead_id, value) {
        var content = '';
        content += '<div class="error_item lead_link" ><a target="_blank" href="https://massagers24.amocrm.ru/leads/detail/' + lead_id + '">' + lead_id + '</a></div>';
        $.each(value, function (key, error) {
            if (error['error_name'] == 2) {
                content += '<div class="error_item not_filled_item " >Вид продажи </div>';
            } else {
                // content += '<div class="error_item filled_item" >Вид продажи </div>';
            }
            if (error['error_name'] == 3) {
                content += '<div class="error_item not_filled_item" >Доставка </div>';
            } else {
                // content += '<div class="error_item filled_item" >Доставка </div>';
            }
            if (error['error_name'] == 1) {
                content += '<div class="error_item not_filled_item" >Товар </div>';
            } else {
                // content += '<div class="error_item filled_item" >Товар </div>';
            }
        });


        // if (error['err_product']) {
        //     content += '<div class="error_item lead_link error_item_big" ><a target="_blank" href="https://massagers24.amocrm.ru/catalogs/4307?term=' + error['err_product'] + '">' + error['err_product'] + '</a> </div>';
        // }

        return '<div class="error_line" >' + content + '</div>';
    }
</script>

<div id="leadsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                    style="float:right;padding:5px 10px 0 0;z-index:1;position:relative;">&times;
            </button>
            <div class="modal-header">
                <div class="modal-title">Ошибки вычисления маржи со сделки</div>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<? //крутилка загрузки?>
<div id="load_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
    </div>
</div>


