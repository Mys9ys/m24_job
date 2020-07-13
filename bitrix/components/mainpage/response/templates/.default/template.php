<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/response/style.min.css');?>
<? $APPLICATION->SetAdditionalCSS('/response/rateyo/jquery.rateyo.min.css'); ?>

<div class="banner_response">
    <img src="/bitrix/components/mainpage/response/image/response.jpg" alt="">
</div>

<div class="response_tags top_tags_response">
    <div class="tags_title">
        Популярные теги:
    </div>
    <div class="tags_box">
        <a class="tags_response" href="/response/">#Все отзывы</a>
        <? // Добавляем популярные теги

        dd($arResult);
        $arHashTag = $arResult['tags'];
        $count = 1;
        foreach ($arHashTag as $name => $value) {
            ?>
            <? if ($count == 10) {
                break;
            } else {
                $count++;
            } ?>
            <a class="tags_response" data-count="<?= $value['count'] ?>"
               href="/response/<?= $value['link'] ?>">#<?= $value['name']; ?></a>
        <? } ?>
    </div>
</div>
<? $arHost = explode('/', trim($_SERVER['REQUEST_URI'], '/')); ?>
<? // отределение урл для отражения отзывов, либо отдельной подкатегории?>
<? if ($arHost[0] == 'response' && empty($arHost[1])) { ?>
    <? // вызываем отзывы из инфоблока
    $responses = $arResult['items'];
    $title_resp = 'Все отзывы покупателей';
    $description_resp = 'Отзывы покупателей на ' . $responses[0]['product']['name'] . ' на сайте Массажеры24. Оставить отзыв или задать вопрос онлайн.';
    ?>
<? } else {
    // наименование выборки
    $category_param = $arHost[1];
    // вызов массива с отзывами согласно выборки
    if (!empty($category_param)) {
        $responses = $arResult[$arHost[2]]['select_items'];
        switch ($category_param) {
            case 'brand':

                $title_resp = $responses[0]['PROPERTIES']['brand']['VALUE'] . ' - Отзывы';
                $description_resp = 'Отзывы покупателей на ' . $responses[0]['PROPERTIES']['brand']['VALUE'] . ' на сайте Массажеры24. Оставить отзыв или задать вопрос онлайн.';
                break;
            case 'section':

                $title_resp = $responses[0]['PROPERTIES']['category']['VALUE'] . ' - Отзывы';
                $description_resp = 'Отзывы покупателей на ' . $responses[0]['PROPERTIES']['category']['VALUE'] . ' на сайте Массажеры24. Оставить отзыв или задать вопрос онлайн.';
                break;
            case 'product':

                $title_resp = $responses[0]['product']['name'] . ' - Отзывы';
                $description_resp = 'Отзывы покупателей на ' . $responses[0]['product']['name'] . ' на сайте Массажеры24. Оставить отзыв или задать вопрос онлайн.';
                break;
            default:
                break;
        }
    }
}
$APPLICATION->SetPageProperty("title", $title_resp);
$APPLICATION->SetPageProperty('description', $description_resp);?>

<? if (isset($responses)) { ?>
    <? foreach ($responses as $response) { ?>
        <div class="response_container">
            <div class="response_header">
                <div class="left_block_response">
                    <div class="preview_response">Отзыв на:</div>
                    <a href="<?= $response['product']['link'] ?>"><span
                            class="title_response"><?= $response['product']['name'] ?></span></a>
                    <div class="response_tags">
                        <? foreach ($response['product']['item_tags'] as $tag) { ?>
                            <a class="tags_response" href="/response/<?= $tag['link'] ?>"><?= '#' . $tag['name'] ?></a>
                        <? } ?>
                    </div>
                    <div class="response_head">
                        <div class="user_name"><?= $response['PROPERTIES']['user_name']['VALUE'] ?></div>
                        <div class="response_star">
                            <div class="rateyo-widg"
                                 data-rating="<?= $response['PROPERTIES']['rating']['VALUE'] ?>"></div>
                        </div>
                        <div class="response_date"><?= time_counting($response['DATE_CREATE_UNIX']) ?></div>
                        <div class="clr"></div>
                    </div>
                </div>
                <div class="right_block_response">
                    <a href="<?= $response['product']['link'] ?>">
                        <div class="block_img">
                            <img src="<?= CFile::GetPath($response['product']['img']) ?>" alt="">
                        </div>
                    </a>
                </div>
                <div class="clr"></div>

                <? // склоняшкка отзывов?>
                <!--            <span class="count_response">/ -->
                <? //=persuade_words(count($responses), 'По данному продукту отзывов еще нет', 'Отзыв', 'Отзыва', 'Отзывов')?><!--</span>-->
            </div>
            <div class="response_box">
                <div class="response_block">
                    <div class="response_first">
                        <div class="response_advantage">
                            <div class="r_left">
                                <img src="/bitrix/components/m24/response/image/plus.png" alt="">
                            </div>
                            <div class="r_right">
                                <div>Достоинства:</div>
                                <?= $response['PROPERTIES']['advantage']['VALUE'] ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="response_disadvantages">
                            <div class="r_left">
                                <img src="/bitrix/components/m24/response/image/minus.png" alt="">
                            </div>
                            <div class="r_right">
                                <div>Недостатки:</div>
                                <?= $response['PROPERTIES']['disadvantages']['VALUE'] ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="response_second">
                        <div class="response_repute">
                            <div class="r_left">
                                <img src="/bitrix/components/m24/response/image/all.png" alt="">
                            </div>
                            <div class="r_right">
                                <div>Общее впечатление:</div>
                                <?= $response['PROPERTIES']['repute']['VALUE'] ?>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
<? } ?>

<!--    --><? //if($countResponse>3){?>
<!--        <div class="create_response_wrapper">-->
<!--            <div class="create_response_title">Нам очень важно ваше мнение</div>-->
<!--            <div class="create_response">Написать отзыв</div>-->
<!--        </div>-->
<!--    --><? //}?>

<script>
    $(document).ready(function () {
        // проставление рейтингов
        $(".rateyo-widg").each(function () {
            var rating = parseInt($(this).data('rating'));
            if (!rating) {
                rating = 0;
            }
            $(this).rateYo({
                rating: rating,
                starWidth: "18px",
                fullStar: true,
                readOnly: true,
                ratedFill: "#eab629",
                normalFill: "rgb(220, 220, 220)"
            });
        });
    });


</script>
