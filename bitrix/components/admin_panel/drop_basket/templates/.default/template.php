<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
header_remove('Cache-Control');
header_remove('Expires');
header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/admin_panel/drop_basket/style.css'); ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!--<div id="regions_div" style="width: 900px; height: 500px;"></div>-->
<?// Массив вариантов обработки
$arProcessing = array(
    'not_processed' => 'Не обработано',
    'sale' => 'Продажа',
    'consultation' => 'Консультация',
    'already_buy' => 'Уже купили',
    'no_answer' => 'Не ответили',
    'error' => 'Неверный номер',
    'amoCRM' => 'Отправлено в ЦРМ',
    'another' => 'Другое',
);
?>

<?if($USER->isAdmin()){?>
    <div id="prev_days_drop_basket" class="diagram_container" data-authorize="<?=$arResult['dayLogin']?>" data-unauthorize="<?=$arResult['dayUnLogin']?>"></div>
    <div id="prev_week_drop_basket" class="diagram_container" data-authorize="<?=$arResult['weekLogin']?>" data-unauthorize="<?=$arResult['weekUnLogin']?>"></div>
    <div id="prev_month_drop_basket" class="diagram_container" data-authorize="<?=$arResult['monthLogin']?>" data-unauthorize="<?=$arResult['monthUnLogin']?>"></div>
    <div id="prev_all_drop_basket" class="diagram_container" data-authorize="<?=$arResult['allLogin']?>" data-unauthorize="<?=$arResult['allUnLogin']?>"></div>
    <div id="drop_basket_operation" class="diagram_container" data-authorize="<?=$arResult['allLogin']?>" data-unauthorize="<?=$arResult['allUnLogin']?>"></div>
<?}?>
<?//dd( $arResult['LOGIN']);?>
<table class="table table-striped table_basket">
    <thead>
    <tr>
        <th>Статус</th>
        <th>Создано</th>
        <th>Покупатель</th>
        <th>Roistat</th>
        <th>Цена</th>
        <th>Товары</th>
        <th>Действие(Жми)</th>
    </tr>
    </thead>
    <tbody>
    <?foreach ($arResult['LOGIN'] as $basket){?>
<!--        --><?//dd($basket)?>
        <tr class="basket_table_row">
            <td><span class="lamp lamp_<?=$basket['operation']?>"></span></td>
            <td><?=$basket['USER']['DATE_INSERT'][0]?><br>
                <?=$basket['USER']['DATE_INSERT'][1]?></td>
            <td><?=$basket['USER']['FULL_NAME']?><br>
            Телефон:<br><input type="text" value="<?=$basket['USER']['phone']?>" style="width: 110px">

            </td>
            <td><input type="text" value="<?=$basket['USER']['roistat_id']?>" style="width: 80px"></td>
            <td><?= number_format($basket['price_basket'], 0, '', '.'); ?>,-</td>
            <td>
                <?$ID_string = '';// для передачи через аякс для ?>
                <?foreach ($basket['items'] as $key => $Product){?>
                    <?if ($key == 0){
                        $delimiter = '';
                    } else {
                        $delimiter = ',';
                    }
                    $ID_string .= $delimiter . $Product['ID'];?>
                    <a class="drop_product" href="<?=$Product['DETAIL_PAGE_URL']?>"><?=$Product['NAME']?></a><br>
                <?}?>
            </td>
            <td class="drop_btn_box"><?if($basket['operation'] == '' && $basket['operation'] == 'confirm') {?>
                    <div class="confirm_drop_basket drop_basket_btn" data-id="<?=$ID_string?>">Обработать</div>
                <?} else {?>
                    <div class="confirm_drop_basket drop_basket_btn lamp_<?=$basket['operation']?>" data-id="<?=$ID_string?>"><?=$arProcessing[$basket['operation']]?></div>
                <?}?>
            </td>
        </tr>
    <?}?>
    </tbody>
</table>

<div id="DropBasketModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <span class="modal-title">Обработка брошенной корзины</span>
            </div>
            <div class="modal-body">
                <div class="block-title">Результат обработки</div>
                <div class="result_box">
                    <?
                    $count = 1;
                    foreach ($arProcessing as $key=>$title){?>
                        <div class="item_box <?=$key?> <?if($count == 1) {echo 'active_check'; $count++;}?>" data-prop="<?=$key?>">
                            <div class="check_box">
                                <span class="imitate_check_item"></span>
                            </div>
                            <div class="item_title"><?=$title?></div>
                        </div>
                    <?}?>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    google.charts.load('current', {'packages':['corechart']});


    google.charts.setOnLoadCallback(prev_days_drop_basket);
    google.charts.setOnLoadCallback(prev_week_drop_basket);
    google.charts.setOnLoadCallback(prev_month_drop_basket);
    google.charts.setOnLoadCallback(prev_all_drop_basket);
    google.charts.setOnLoadCallback(drop_basket_operation);
    options = {
        title: 'Quantity of colors',
        // is3D: true,
        pieHole: 0.4,
        // slices: {
        //     4: {offset: 0.2},
        //     1: {offset: 0.3},
        //     2: {offset: 0.4},
        //     3: {offset: 0.5},
        // },
        // 'width':560,
        // 'height':450
    };

    function prev_days_drop_basket(basketData) {
        options['title'] ='Вчера';
        var $this = $('#prev_days_drop_basket');
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Значение', 'количество'],
            ['С контактом', Math.floor($this.data('authorize'),2)],
            ['Без контакта', Math.floor($this.data('unauthorize'),2)],
        ]);
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('prev_days_drop_basket'));
        chart.draw(data, options);
    }
    function prev_week_drop_basket(basketData) {
        options['title'] ='Неделя';
        var $this = $('#prev_week_drop_basket');
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Значение', 'количество'],
            ['С контактом', Math.floor($this.data('authorize'),2)],
            ['Без контакта', Math.floor($this.data('unauthorize'),2)],
        ]);
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('prev_week_drop_basket'));
        chart.draw(data, options);
    }
    function prev_month_drop_basket(basketData) {
        options['title'] ='Месяц';
        var $this = $('#prev_month_drop_basket');
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Значение', 'количество'],
            ['С контактом', Math.floor($this.data('authorize'),2)],
            ['Без контакта', Math.floor($this.data('unauthorize'),2)],
        ]);
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('prev_month_drop_basket'));
        chart.draw(data, options);
    }
    function prev_all_drop_basket(basketData) {
        options['title'] ='Все время';
        var $this = $('#prev_all_drop_basket');
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Значение', 'количество'],
            ['С контактом', Math.floor($this.data('authorize'),2)],
            ['Без контакта', Math.floor($this.data('unauthorize'),2)],
        ]);
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('prev_all_drop_basket'));
        chart.draw(data, options);
    }

    function drop_basket_operation(basketData) {
        options['title'] ='Результаты обработки';
        options['is3D'] = true;
        var $this = $('#drop_basket_operation');
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Значение', 'количество'],
            <?foreach ($arResult['operation'] as $item=>$value){?>
            ['<?=$arProcessing[$item]?>', Math.floor('<?=intval($value)?>',2)],
            <?}?>
        ]);
        // Instantiate and draw the chart.
        var chart = new google.visualization.PieChart(document.getElementById('drop_basket_operation'));
        chart.draw(data, options);
    }
    $(document).ready(function () {
        $('.basket_table_row').on('mouseenter', function () {
            $(this).addClass('basket_table_hover');
        });
        $('.basket_table_row').on('mouseleave', function () {
            $(this).removeClass('basket_table_hover');
        });
        $('.confirm_drop_basket').on('click', function () {
            $('#DropBasketModal').modal('show');
            console.log('confirm', $(this).data('id'));
            data = {
                actions: 'proc',
                ids: $(this).data('id')
            };
            // $.post(
            //     '/bitrix/components/admin_panel/drop_basket/ajax/',
            //     data,
            //     function (result) {
            //         location.reload();
            //     }
            // );
        });

        // выбираем результат обработки
        $('.item_box').on('click', function () {
            $('.item_box').removeClass('active_check');
            $(this).addClass('active_check');

            data['operation'] = $(this).data('prop');
            console.log('data', data);
            $.post(
                '/bitrix/components/admin_panel/drop_basket/ajax/',
                data,
                function (result) {
                    location.reload();
                }
            ); 
        });

    });

</script>

<? $APPLICATION->AddHeadScript("/bitrix/components/admin_panel/drop_basket/script.js"); ?>

