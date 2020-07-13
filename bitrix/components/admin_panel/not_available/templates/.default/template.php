<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!CModule::IncludeModule("iblock"))
    return;
if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog"))
    return; ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/admin_panel/not_available/style.min.css'); ?>

<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/amocrm/config_backup.php");
$mysqli = new mysqli($config['host'], $config['username'], $config['passwd'], $config['dbname']);
//Выводим любую ошибку соединения
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: " . $mysqli->connect_error . PHP_EOL;
}
$query = "SELECT * FROM not_available ORDER BY new_flag DESC, updated_at DESC";
$result = $mysqli->query($query);
$arNAvailable = array();
while ($row = $result->fetch_assoc()) {
    $arNAvailable[$row['id']] = $row;
}

?>
<div class="NA_wrapper">
    <div class="NA_btn_reload_block">
        <div class="NA_btn_reload">Обновить</div>
        <div class="NA_search_box">
            <input class="NA_search_input" type="search" placeholder="Поиск...">
            <div class="NA_search_btn"><i class="fa fa-search" aria-hidden="true"></i></div>
        </div>
    </div>
    <div class="NA_vids_search_result"></div>
    <? foreach ($arNAvailable as $item) { ?>
        <div class="NA_element" data-id="<?= $item['id'] ?>">
            <img src="<?= CFile::GetPath($item['img']) ?>" alt="">
            <div class="NA_title"><?= $item['name'] ?></div>
            <?= $NA_date_new = ($item['new_flag'] == 1) ? 'NA_date_new' : '' ?>
            <? if ($item['is_available'] == 0) { ?>
                <div class="NA_info_block">
                    <div class="NA_btn_block">
                        <?if($arParams['btn'] == 'none'){?>
                            <div class="NA_btn NA_btn_off">нет в наличии</div>
                        <?} else {?>
                            <a class="NA_btn NA_btn_on" target="_blank"
                               href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=39&type=catalog&ID=<?= $item['id'] ?>">Включить</a>
                        <?}?>
                    </div>
                    <div class="NA_time_block">
                        <div class="NA_date_info <?= $NA_date_new ?>">Изменено: <?= time_counting(strtotime($item['updated_at'])) ?></div>
                    </div>
                </div>
            <? } else { ?>
                <div class="NA_info_block">
                    <div class="NA_btn_block">
                        <?if($arParams['btn'] == 'none'){?>
                            <div class="NA_btn NA_btn_off">есть в наличии</div>
                        <?} else {?>
                            <a class="NA_btn NA_btn_off" target="_blank"
                               href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=39&type=catalog&ID=<?= $item['id'] ?>">Выключить</a>
                        <?}?>
                    </div>
                    <div class="NA_time_block">
                        <div class="NA_date_info <?= $NA_date_new ?>">Изменено: <?= time_counting(strtotime($item['updated_at'])) ?></div>
                    </div>
                </div>
            <? } ?>
        </div>
    <? } ?>
</div>

<?
// обработка времени
function time_counting($date)
{
    $date = time() - $date;
    if ($date < 60) {
        $result = persuade_words($date, 'секунд', 'секунду', 'секунды', 'секунд');
    } else if ($date < 3600 && $date > 59) {
        $result = persuade_words(floor($date / 60), 'минут', 'минуту', 'минуты', 'минут');
    } else if ($date < 86400 && $date > 3599) {
        $result = persuade_words(floor($date / 3600), 'час', 'час', 'часа', 'часов');
    } else if ($date < 604800 && $date > 86399) {
        $result = persuade_words(floor($date / 86400), 'дней', 'день', 'дня', 'дней');
    } else if ($date < 2629743 && $date > 604799) {
        $result = persuade_words(floor($date / 604800), 'недель', 'неделю', 'недели', 'недель');
    } else if ($date < 31556926 && $date > 2629742) {
        $result = persuade_words(floor($date / 2629743), 'месяцев', 'месяц', 'месяца', 'месяцев');
    } else {
        $result = persuade_words(floor($date / 31556926), 'лет', 'год', 'года', 'лет');
    }
    return $result . ' назад';
}

// Склоняем слова
function persuade_words($count, $ending0, $ending1, $ending2_4, $ending5_9)
{
    if ($count < 1) {
        $count = $ending0;
    } else if ($count > 4 && $count < 21) {
        $count = $count . ' ' . $ending5_9;
    } else if ($count % 10 == 1) {
        $count = $count . ' ' . $ending1;
    } else if ($count % 10 > 1 && $count % 10 < 5) {
        $count = $count . ' ' . $ending2_4;
    } else {
        $count = $count . ' ' . $ending5_9;
    }
    return $count;
}

?>

<script>
    $(document).ready(function () {
        $('.NA_btn_reload').on('click', function () {
            $.post(
                '/api/not_available/',
                '',
                function (result) {
                    location.reload();
                }
            )
        });
        $search_content = $('.NA_wrapper').find('.NA_element');
        // работа с поиском
        $('.NA_search_input').on('keyup', function () {
            $('.NA_vids_search_result').children().remove();

            var $this = $(this);
            var search = $.trim($this.val()).toLowerCase();

            if (search.length > 2) {
                $('.NA_wrapper').find('.NA_element').remove();
                $searchElem = [];
                $searchCount = 0;
                content = '';

                $.each($search_content, function (item, value) {
                    var $searchText = $(value).find('.NA_title').text().toLowerCase();

                    if ($searchText.indexOf(search) > -1) {
                        $searchElem.push(value);
                        $searchCount++;
                    }

                    if ($searchElem.length > 0) {
                        $.each($searchElem, function (item, value) {
                            $('.NA_wrapper').append(value);
                        });
                    }
                });
            } else {
                $('.NA_wrapper').append($search_content);
                search_not_found();
            }
            if (search.length == 0) {
                $('.NA_vids_search_result').children().remove();
            }
        });
    });

    function search_not_found() {
        $('.NA_vids_search_result').children().remove();
        content = 'По вашему запросу ни чего не найдено';
        $('.NA_vids_search_result').append('<p>' + content + '</p>');
    }
</script>
