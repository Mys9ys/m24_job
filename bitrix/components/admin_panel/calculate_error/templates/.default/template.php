<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? $APPLICATION->SetAdditionalCSS('/bitrix/components/admin_panel/calculate_error/style.css'); ?>
<?php
set_time_limit(300);
require_once($_SERVER['DOCUMENT_ROOT'] . "/api/class/Amo2.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/api/config.php");
$crm = new AmoCRMClient($config['login'], $config['apikey'], $config['root']);


$arErrFiles = scandir($_SERVER['DOCUMENT_ROOT'] . '/api/leads_profit/logs/error/');
unset($arErrFiles[0]);
unset($arErrFiles[1]);
//dd($arErrFiles);

$arrAllError = array();
foreach ($arErrFiles as $files) {
    $json_leads = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/api/leads_profit/logs/error/' . $files);
    $errCalculate = json_decode($json_leads, true);
    $arrAllError[] = $errCalculate;
}
$arrAllError = array_reverse($arrAllError);
?>
<div class="date_title">Выбрать дату:</div>
<input type="date" class="date_block date_begin_parse">
<input type="date" class="date_block date_end_parse">
<div class="new_calculate_btn">Проверить сейчас</div>

<table class="error_box">
    <tr class="header_table_block">
        <th class="align_center" rowspan=2>Время проверки</th>
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
        var arrAllError = '<?=json_encode($arrAllError)?>';
        // console.log('arrAllError', arrAllError);
        var parseArrError = $.parseJSON(arrAllError);
        // console.log('parseArrError', parseArrError);
        $.each(parseArrError, function (id, value) {
            // console.log('value', value);

            $.each(value, function (name, item) {
                // console.log(name, item);
                if (name == 'date') {
                    var d = new Date(item * 1000);
                    date_box = '<td class="align_center">' + formatDate(d) + '</td>';
                }
                if (name == 'errLeads') {
                    var all_length = 0, sale_length = 0, close_length = 0;
                    $.each(item, function (lead_id, info) {
                        all_length++;
                        // console.log(lead_id, info);
                        if (info['status_id'] == '143') {
                            close_length++;
                        }
                        if (info['status_id'] == '142') {
                            sale_length++;
                        }
                    });
                    if (all_length > 0) {
                        // <th class="lead_err_box">
                        sale_box = '<td class="align_center sale_color"> ' + sale_length + '</td>';
                        close_box = '<td class="align_center close_color"> ' + close_length + '</td>';
                        other_box = '<td class="align_center work_color"> ' + (all_length - (sale_length + close_length)) + '</td>';
                        all_box = '<td class="align_center"> ' + all_length + '</td>';
                        err_box = all_box + sale_box + close_box + other_box;
                    } else {
                        err_box = '<td class="align_center" colspan=4>Ошибок нет</td>';
                    }
                }
                var count_product = 0;
                if (name == 'errProduct') {
                    $.each(item, function (lead_id, info) {
                        count_product++;
                    });
                    if (count_product > 0) {
                        product_err = '<td class="align_center">' + count_product + '</td>';
                    } else {
                        product_err = '<td class="align_center">нет</td>';
                    }

                }
                if (name == 'warnings') {
                    var warning_length = 0;
                    $.each(item, function (lead_id, info) {
                        warning_length++;
                    });
                    if (warning_length > 0) {
                        warning_err = '<td class="end_col_center">' + warning_length + '</td>';
                    } else {
                        warning_err = '<td class="end_col_center">нет</td>';
                    }

                }
            });
            var content = '<tr class="content_box btn_show_modal" data-id="' + id + '">' + date_box + err_box + product_err + warning_err + '</tr>';
            $('.error_box').append(content);
        });
        $('.error_box').on('click', '.btn_show_modal', function () {
            var arError = parseArrError[$(this).data('id')];
            // console.log('arError', arError);
            var d = new Date(arError['date'] * 1000);
            $arrSale = [];
            $arrClose = [];
            $arrOther = [];
            var other_length = 0, sale_length = 0, close_length = 0;

            //## ошибки сделок ##\\
            $.each(arError['errLeads'], function (lead_id, error) {

                if (error['status_id'] == 142) {
                    $arrSale.push(fillContentErrAjax(lead_id, error));
                } else if (error['status_id'] == 143) {
                    $arrClose.push(fillContentErrAjax(lead_id, error));
                } else {
                    $arrOther.push(fillContentErrAjax(lead_id, error));
                }

            });

            not_err1 = '';
            var append_content_sale = '';
            if ($arrSale.length >0) {
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
            if ($arrClose.length >0) {
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
            if ($arrOther.length >0) {
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
                '                           <a class="error_title_btn '+not_err1+'" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Реализовано ' + sale_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse1_body = '<div id="collapse1" class="panel-collapse collapse in"><div class="panel-body">' + append_content_sale + '</div></div>';
            var collapse1 = '<div class="panel panel-default">' + collapse1_header + collapse1_body + '</div>';

            var collapse2_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn '+not_err2+'" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Нереализовано ' + close_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse2_body = '<div id="collapse2" class="panel-collapse collapse"><div class="panel-body">' + append_content_close + '</div></div>';
            var collapse2 = '<div class="panel panel-default">' + collapse2_header + collapse2_body + '</div>';

            var collapse3_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn '+not_err3+'" data-toggle="collapse" data-parent="#accordion" href="#collapse3">В работе ' + other_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse3_body = '<div id="collapse3" class="panel-collapse collapse"><div class="panel-body">' + append_content_other + '</div></div>';
            var collapse3 = '<div class="panel panel-default">' + collapse3_header + collapse3_body + '</div>';
            //## ошибки сделок END ##\\

            //## ошибки товаров ##\\
            not_err4 = '';
            var products_error = '';
            var products_length = 0;
            $.each(arError['errProduct'], function (lead_id, error) {
                var error_text = '';
                var product_info = error[lead_id];
                products_length++;
                error_text += '<div class="product_link" ><a target="_blank" href="https://massagers24.amocrm.ru/catalogs/4307?term=' + product_info['product_name'] + '">' + product_info['product_name'] + '</a></div>';
                error_text += '<div class="field_name" >не заполнено поле: ' + product_info['info'] + '</div>';
                products_error += '<div class="product_line">'+error_text+'</div>';
                // console.log(lead_id, error[lead_id]);
            });
            if(products_length<1){
                not_err4 = 'not_error';
                products_error += '<div class="product_line">Ошибок нет</div>';
            }

            var collapse4_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn '+not_err4+'" data-toggle="collapse" data-parent="#accordion" href="#collapse4">Ошибки в товарах ' + products_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse4_body = '<div id="collapse4" class="panel-collapse collapse"><div class="panel-body">' + products_error + '</div></div>';
            var collapse4 = '<div class="panel panel-default">' + collapse4_header + collapse4_body + '</div>';
            //## ошибки товаров END ##\\

            //## дополнительные вычеты ##\\
            not_err5 = '';
            var warnings_error = '';
            var warnings_length = 0;
            $.each(arError['warnings'], function (lead_id, error) {
                var error_text = '';
                warnings_length++;
                error_text += '<div class="warnings_lead"><a target="_blank" href="https://massagers24.amocrm.ru/leads/detail/' + lead_id+ '">' + lead_id + '</a></div>';
                error_text += '<div class="warnings_info"> ' + error['error'] + '</div>';
                warnings_error += '<div class="warnings_line">'+error_text+'</div>';
            });
            if(warnings_length<1){
                not_err5 = 'not_error';
                products_error += '<div class="warnings_line">Ошибок нет</div>';
            }

            var collapse5_header = '<div class="panel-heading">' +
                '                       <h4 class="panel-title">' +
                '                           <a class="error_title_btn '+not_err5+'" data-toggle="collapse" data-parent="#accordion" href="#collapse5">Дополнительные вычеты ' + warnings_length + '</a>' +
                '                       </h4>' +
                '                   </div>';
            var collapse5_body = '<div id="collapse5" class="panel-collapse collapse"><div class="panel-body">' + warnings_error + '</div></div>';
            var collapse5 = '<div class="panel panel-default">' + collapse5_header + collapse5_body + '</div>';
            //## дополнительные вычеты END ##\\
            $('.modal-header').find('span').remove();
            $('.modal-body').children().remove();
            $('.modal-header').append('<span style="color:rgb(40,40,40);">' + formatDate(d) + '</span>');
            $('.modal-body').append('<div class="panel-group" id="accordion">' + collapse1 + collapse2 + collapse3 + collapse4 + collapse5 +'</div>');


            $('#leadsModal').modal('show');

        });
        $('#leadsModal').on('click', '.close', function () {
            // console.log('close');
            $(this).modal('hide');
        });
        $('.new_calculate_btn').on('click', function () {
            var date_begin_parse = $('.date_begin_parse').val();
            var targetDate = new Date(date_begin_parse).getTime();
            var curDate = new Date().getTime();
            var result = Math.round((curDate - targetDate) / 86400000);
            var data = {
                type: 'handmade',
            };
            if(result){
                data['count'] = result;
            }
            console.log('data', data);
            if(result<365){
                modal_loader_Ajax();
                $.post(
                    '/bitrix/components/admin_panel/calculate_error/ajax/',
                    data,
                    function (result) {
                        location.reload();
                    }
                )
            }
        });
    });

    // крутилка
    function modal_loader_Ajax() {
        $('#load_modal').modal('show');
    }

    function formatDate(d) {
        var months = ['января', 'февраля', 'марта', 'апреля','мая', 'июня', 'июля', 'августа','сентября', 'октября', 'ноября', 'декабря'];
        var day = (d.getDate() / 10 < 1) ? "0" + d.getDate() : d.getDate();
        var month = (d.getMonth() / 10 < 1) ? (d.getMonth()) : d.getMonth();
        var year = d.getFullYear();

        var hours = (d.getHours() / 10 < 1) ? "0" + d.getHours() : d.getHours();
        var minutes = (d.getMinutes() / 10 < 1) ? "0" + d.getMinutes() : d.getMinutes();
        var seconds = (d.getSeconds() / 10 < 1) ? "0" + d.getSeconds() : d.getSeconds();

        return day + "." + months[month] + ' ' + hours + ':' + minutes;
    }

    function fillContentErrAjax(lead_id, error) {
        // console.log('error', error);
        var content = '';
        content += '<div class="error_item lead_link" ><a target="_blank" href="https://massagers24.amocrm.ru/leads/detail/' + lead_id + '">' + lead_id + '</a></div>';
        if (!error['status1']) {
            content += '<div class="error_item filled_item" >Вид продажи </div>';
        } else {
            content += '<div class="error_item not_filled_item" >Вид продажи </div>';
        }
        if (!error['status4']) {
            content += '<div class="error_item filled_item" >Доставка </div>';
        } else {
            content += '<div class="error_item not_filled_item" >Доставка </div>';
        }

        if (!error['status2']) {
            content += '<div class="error_item filled_item" >Товар </div>';
        } else {
            content += '<div class="error_item not_filled_item" >Товар </div>';
        }

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

<? $APPLICATION->AddHeadScript("/bitrix/components/admin_panel/amo_catalog/script.js"); ?>

