<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/header_basket/style.css'); ?>
<?// $APPLICATION->IncludeFile("/bitrix/components/mainpage/topbanners/function.php", array(), array()); ?>

<div class="header_basket">
    <div id="logo">
        <a href="/">
            <img src="/bitrix/templates/elektro_flat/images/m24_logo.png" alt="">
        </a>
    </div>

    <div class="header_search_basket">
        <?$APPLICATION->IncludeComponent("altop:search.title", ".default",
            Array(
                "SHOW_INPUT" => "Y",
                "INPUT_ID" => "title-search-input",
                "CONTAINER_ID" => "altop_search",
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "39",
                "PAGE" => "/catalog/",
                "NUM_CATEGORIES" => "1",
                "TOP_COUNT" => "7",
                "ORDER" => "rank",
                "USE_LANGUAGE_GUESS" => "N",
                "CHECK_DATES" => "N",
                "MARGIN_PANEL_TOP" => "42",
                "MARGIN_PANEL_LEFT" => "0",
                "PROPERTY_CODE_MOD" => array(),
                "OFFERS_FIELD_CODE" => array(),
                "OFFERS_PROPERTY_CODE" => array("COLOR", "PROP2"),
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER2" => "asc",
                "OFFERS_LIMIT" => "",
                "SHOW_PRICE" => "Y",
                "PRICE_CODE" => array("BASE"),
                "PRICE_VAT_INCLUDE" => "Y",
                "SHOW_ADD_TO_CART" => "Y",
                "SHOW_ALL_RESULTS" => "Y",
                "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
                "CATEGORY_0" => array("iblock_catalog"),
                "CATEGORY_0_iblock_catalog" => array("all"),
                "CONVERT_CURRENCY" => "N",
                "CURRENCY_ID" => "",
                "OFFERS_CART_PROPERTIES" => array("COLOR", "PROP2")
            ),
            false
        );?>
    </div>
    <div class="header_info">
        <div class="m24_telephone">
            8 800 222-16-90
        </div>
        <div class="m24_shedule">
            Ежедневно с 9.00 до 21.00
        </div>
        <div class="chatM24Menu">
            <? $APPLICATION->IncludeComponent("mainpage:chatM24", "",
                Array(),
                false,
                Array()
            ); ?>
        </div>
    </div>
    <div class="header_city">
        <!--noindex-->
        <?$APPLICATION->IncludeComponent("yakus:geoip", "new", Array(
            "CITY_LIST" => array(
                0 => 'Москва',
                27 => 'Барнаул',
                1 => 'Белгород',
                25 => 'Брянск',
                20 => 'Волгоград',
                2 => 'Воронеж',
                3 => 'Екатеринбург',
                21 => 'Иркутск',
                4 => 'Казань',
                22 => 'Кемерово',
                17 => 'Краснодар',
                24 => 'Красноярск',
                5 => 'Курск',
                6 => 'Липецк',
                30 => 'Магнитогорск',
                11 => 'Набережные Челны',
                15 => 'Нижний Новгород',
                13 => 'Новосибирск',
                7 => 'Орёл',
                19 => 'Пермь',
                8 => 'Ростов-на-Дону',
                12 => 'Рязань',
                16 => 'Самара',
                14 => 'Санкт-Петербург',
                31 => 'Сочи',
                29 => 'Ставрополь',
                28 => 'Сургут',
                9 => 'Тула',
                10 => 'Тюмень',
                18 => 'Уфа',
                23 => 'Хабаровск',
                26 => 'Челябинск',

            ),
            // Названия местоположений для вывода их во всплывающем окне по умолчанию (под строкой ввода)
            "CITY_LIST_SORT" => "LIST",    // Сортировка списка городов
            "COMPONENT_TEMPLATE" => ".default",
            "JQUERY" => "N",    // Подключить JQUERY если он не установлен на сайте
            "SHOW_LINE" => "Y",    // Выводить название города
            "SHOW_POPUP" => "Y",    // Выводить окно с выбором городов из списка местоположений
        ),
            false
        ); ?>
        <!--/noindex-->
    </div>
</div>






