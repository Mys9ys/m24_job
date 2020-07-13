<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/section_description/style.css'); ?>
<? $APPLICATION->IncludeFile("/bitrix/components/mainpage/section_description/function.php", array(), array()); ?>
<!--noindex-->
<div class="catalog_description">

    <? $publicationInfo = getSectionInfo($arParams["section"]) ?>

    <div class='h1'><?= $publicationInfo['NAME'] ?></div>

    <div class="h2">Почему <?= $publicationInfo['NAME'] ?> лучше покупать у нас?</div>

    <table class="m24_bs-7 m24_cp-7">
        <tbody>
        <tr>
            <td class="m24_va-top">
                <img width="98" src="/images/vozvrat.jpg" height="135" alt="vozvrat.jpg">
            </td>
            <td class="m24_va-top">
                <div class='h1'>Мы проверяем каждый товар</div>
                <br>
                В нашем интернет-магазине представлено более <?= count($arParams["items"]) ?> моделей <?= $publicationInfo['UF_SECTION_TITLE'] ?>.
                Причём всё это современные и популярные модели. В некоторых интернет-магазинах встречается каталог и
                побольше нашего. Дело в том, что мы НЕ продаём раритеты и некачественный товар. Технологии массажа
                совершенствуются каждый год. И за те же деньги производители предлагают всё более и более качественные
                образцы (лучше массаж, больше функций, качественнее материалы и т.д.). Мы сотрудничаем с лидерами рынка
                Panasonic, Casada, OTO, Ogawa, iRest и другими. Мы НЕ возим noname товары из Китая и не придумываем
                собственных брендов. <br>
                <br>
                Зато всё, что выставлено на нашей интернет-витрине мы тестируем лично, снимаем видео, разбираемся в
                функциях и доносим до вас актуальную информацию. В 80% случаев консультанты интернет-магазинов,
                торгующих массажными приборами никогда в жизни не пользовались ни одним массажером, который продают, и потому не
                могут внятно рассказать вам о реальных достоинствах и недостатках. Мы не такие. Мы стараемся знать о
                массажерах всё, ведь покупка не из дешёвых.
            </td>
        </tr>
        <tr>
            <td class="m24_va-top">
                <img width="98" src="/images/10_shops.jpg" height="135" alt="10_shops.jpg">
            </td>
            <td class="m24_va-top">
                <div class='h1'>Мы в вашем городе</div>
                <p>
                    У нас более 15 магазинов в 10 крупных городах России, в которые можно прийти и ощутить массаж на
                    себе. Реально оценить нравится вам массажер или нет. Конечно выбор в интернет-магазине намного
                    больше, чем на торговых точках. Но всегда лучше, если вы попробуете 2-3 массажера лично.
                    Тогда вы начнёте понимать чем в принципе они отличаются.
                </p>
            </td>
        </tr>
        <tr>
            <td class="m24_va-top">
                <img width="98" src="/images/min_price.jpg" height="135" alt="min_price.jpg">
            </td>
            <td class="m24_va-top">
                <div class='h1'>Наши цены ниже</div>
                <p>
                    Наши цены ниже чем у конкурентов. Если вы где-то нашли <?= $publicationInfo['UF_PRETITLE'] ?>
                    дешевле, свяжитесь с нами и мы предложим вам цену ещё ниже. Сравните цены и закажите массажер на дом с
                    доставкой по минимальной цене.
                </p>
            </td>
        </tr>
        <tr>
            <td class="m24_va-top">
                <img width="98" src="/images/free_delivery.jpg" height="135" alt="free_delivery.jpg"><br>
            </td>
            <td class="m24_va-top">
                <div class='h1'>Лучшая доставка и удобная оплата</div>
                <p>
                    Доставка для вас будет бесплатна. Если нужное <?=$publicationInfo['UF_PRETITLE']?> есть в магазине вашего города, то мы
                    доставим его на следующий день. Если нет, то в течение 3-5 дней мы доставим товар в ваш город
                    транспортной компанией. Вы можете оплатить товар при получении наличными или кредитной картой. А
                    если <?=$publicationInfo['UF_PRETITLE']?> вам не по карману, но очень приглянулось, то вы можете оформить кредит прямо
                    сайте (мы сотрудничаем с Тинькофф Банком).
                </p>
            </td>
        </tr>
        <tr>
            <td class="m24_va-top">
                <img width="98" src="/images/credit_cart.jpg" height="135" alt="credit_card.jpg">
            </td>
            <td class="m24_va-top">
                <div class='h1'>Удобная оплата</div>
                <br>
                Вы можете оплатить <?=$publicationInfo['UF_PRETITLE']?> при получении наличными или кредитной картой. А если
                <?=$publicationInfo['UF_PRETITLE']?> вам не по карману, но очень приглянулось, то вы можете оформить кредит прямо сайте (мы
                сотрудничаем с Тинькофф Банком).<br>
            </td>
        </tr>
        <tr>
            <td class="m24_va-top">
                <img width="98" src="/images/pomozhem_m24.jpg" height="135" alt="pomozhem_m24.jpg">
            </td>
            <td class="m24_va-top">
                <div class='h1'>Всегда поможем.</div>
                <p>
                    На данный момент у нас нет собственных сервисных центров, т.к. производители, с которыми мы работаем
                    самостоятельно решают вопросы ремонта массажоров. Но мы всегда можем помочь вам, если
                    вдруг у вас возникло непонимание с производителем или есть спорные вопросы. Мы на вашей стороне.
                </p>
            </td>
        </tr>
        </tbody>
    </table>
    <h2><b>Покупайте <?= $publicationInfo['NAME'] ?></b></h2>

    <? // статьи закрепленные в описании к разделу?>
    <? $APPLICATION->IncludeComponent("mainpage:publication", "",
        Array('publications' => getPublicationID($arParams["section"])),
        false,
        Array()
    ); ?>

</div>
<!--/noindex-->