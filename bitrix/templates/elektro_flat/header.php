<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");

// вызов и установка компонента и глобальной переменной в регионе
$APPLICATION->IncludeComponent("mainpage:vregione", "", Array(),false, Array());

if (!empty($seopage_id)) {

    $title = $currentSeoPage['title'];
    $keywords = $currentSeoPage['keywords'];
    $description = $currentSeoPage['description'];
    $h1 = $currentSeoPage['h1'];
    $seotop = $currentSeoPage['seotop'];
    $seobottom = $currentSeoPage['seobottom'];
}

if (strpos($_SERVER['REQUEST_URI'], '/catalog/') === 0) {
    $arr = explode('/', $_SERVER['REQUEST_URI']);

    $res = CIBlockSection::GetList(
        Array(),
        Array(
            'IBLOCK_ID' => 39,
            'CODE' => $arr[count($arr) - 2]
        ),
        false,
        false,
        Array("ID", "NAME")
    );
    $obj = $res->Fetch();

    if (isset($obj['ID']) && empty($seopage_id)) {
        $ipropValues = new Bitrix\Iblock\InheritedProperty\SectionValues(39, $obj['ID']);
        $sectionIpropValues = $ipropValues->getValues();
        $currentSectionName = $obj['NAME'];
        GLOBAL $SEOTextToDisplay;

        $catalog_title = $sectionIpropValues["SECTION_META_TITLE"] . ' ' . $SEOTextToDisplay;
        $catalog_h1 = $sectionIpropValues["SECTION_PAGE_TITLE"] . ' ' . $SEOTextToDisplay;
        $catalog_description = $sectionIpropValues["SECTION_META_DESCRIPTION"] . ' ' . $SEOTextToDisplay;

        $APPLICATION->SetPageProperty("keywords", $sectionIpropValues["SECTION_META_KEYWORDS"] . ' ' . $SEOTextToDisplay);
        $APPLICATION->SetPageProperty("description", $catalog_description);
        $APPLICATION->SetPageProperty("title", $catalog_title);
    }
}

IncludeTemplateLangFile(__FILE__);
// устраняем проблему с номером в адресе
if(strpos($_SERVER['REQUEST_URI'],'78002221690') != false){
    $redirUrl = 'https://massagery24.ru';
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: '.$redirUrl);
    exit();
}

if (defined("ERROR_404") && ERROR_404 == "Y" && $APPLICATION->GetCurPage(true) != '/404.php') {
    CHTTP::SetStatus('404 Not Found');
} elseif ($_SERVER['SCRIPT_NAME'] == '/index.php') {
    $ts_initial = 1462351404;
    $ts_interval = 86400;
    $ts_delta = time() - $ts_initial;
    $ts_steps = floor($ts_delta / $ts_interval);
    $ts_calculated = $ts_steps * $ts_interval + $ts_initial;
    header('Expires: ' . gmdate('D, d M Y H:i:s', $ts_calculated + $ts_interval) . ' GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $ts_calculated) . ' GMT');
} elseif (strpos($_SERVER['REDIRECT_URL'], '/catalog/compare/') === 0 || $_REQUEST['ajax_compare'] == 1) {
    header_remove('Cache-Control');
    header_remove('Expires');
    header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
} else {
    header_remove('Cache-Control');
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 43200) . ' GMT');
}
?><!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>


    <title><?$APPLICATION->ShowTitle(); ?> <?=$APPLICATION->GetPageProperty("VREGIONE");?></title>

    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1737549882965728');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=1737549882965728&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <?
    //    $APPLICATION->ShowProperty('description');
    $APPLICATION->ShowMeta("keywords");      // Вывод мета - тега keywords
    //    $APPLICATION->ShowMeta("description");      // Вывод мета - тега description
    if (strpos($_SERVER['REQUEST_URI'], 'PAGEN') != 0) { // для пагинации закрываем от индексирования
        $APPLICATION->SetPageProperty("robots", "noindex, follow");
        $APPLICATION->ShowMeta("robots");
    }
    if (strpos($_SERVER['REQUEST_URI'], 'personaldata') != 0) {
        $APPLICATION->SetPageProperty("robots", "noindex, follow");
        $APPLICATION->ShowMeta("robots");
    }
    ?>
    <meta name="description" content="<? $APPLICATION->ShowProperty('description');?> <?=$APPLICATION->GetPageProperty("VREGIONE");?>"/>
    <? if ($_SERVER['HTTP_HOST'] == 'massagery24.ru') { ?>
        <meta name="yandex-verification" content="6389d56288fb3795"/>
    <? } else { ?>
        <meta name="yandex-verification" content="8b820555f491b577"/>
        <!--        <meta name="yandex-verification" content="c75a1713880e4c5e" />-->
    <? } ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico"/>
    <?
    //Тут канонический url
    $APPLICATION->ShowLink("canonical", null, false);

    //Тут стили шаблона сайта
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/js/jquery-ui/jquery-ui.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/bootstrap-3.3.7/css/bootstrap.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/font-awesome-4.7.0/css/font-awesome.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/js/jquery-ui/jquery-ui.structure.min.css");
    $APPLICATION->SetAdditionalCSS("/scripts/css/fonts.googleapis.com.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/colors.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/owl-carousel/owl.carousel.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/catalog_m24.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/js/rateyo/jquery.rateyo.min.css");
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/js/custom-forms/custom-forms.min.css");

    //Тут выводим стили
    $APPLICATION->ShowCSS(true, false);
    ?>

    <script data-skip-moving="true" src="<?= SITE_TEMPLATE_PATH ?>/jquery/jquery-3.2.1.min.js"></script>

    <!-- BEGIN ROISTAT -->

    <? if ($_SERVER['HTTP_HOST'] == 'massagery24.ru-dev') { ?>
        <script data-skip-moving="true">window.roistatCookieDomain = 'massagery24.ru-dev';</script>
    <? } elseif ($_SERVER['HTTP_HOST'] == 'xn--24-6kcazf3bybfa8i.xn--p1ai'){ ?>
        <script data-skip-moving="true">window.roistatCookieDomain = 'xn--24-6kcazf3bybfa8i.xn--p1ai';</script>
    <? }else { ?>
        <script data-skip-moving="true">window.roistatCookieDomain = 'massagery24.ru';</script>
    <? } ?>

    <script data-skip-moving="true">(function (w, d, s, h, id) {
            w.roistatProjectId = id;
            w.roistatHost = h;
            var p = d.location.protocol == "https:" ? "https://" : "http://";
            var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/" + id + "/init";
            var js = d.createElement(s);
            js.charset = "UTF-8";
            js.async = 1;
            js.src = p + h + u;
            var js2 = d.getElementsByTagName(s)[0];
            js2.parentNode.insertBefore(js, js2);
        })(window, document, 'script', 'cloud.roistat.com', '55514bd7187c190b01d9496f2e30fa6d');
    </script>
    <!-- END ROISTAT -->

    <?

    //Тут скрипты
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/jquery/jquery-migrate-3.0.0.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery-ui/jquery-ui.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.cookie.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/custom-forms/jquery.custom-forms.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/main.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/script_video.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/rateyo/jquery.rateyo.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/owl-carousel/owl.carousel.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/bootstrap-3.3.7/js/bootstrap.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/script.min.js");
    //    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/touchpunch/jquery.ui.touch-punch.min.js");

    $APPLICATION->IncludeFile("/bitrix/components/catalog.pages/page/function.php", array(), array());

    $APPLICATION->ShowHeadStrings();
    //    if($USER->IsAdmin()) {
    //        $APPLICATION->ShowHeadStrings();   // Отображает специальные стили, JavaScript
    //    }
    $APPLICATION->ShowHeadScripts();

    ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PKLBRWM');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PKLBRWM"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>

<? if (isset($_COOKIE)): ?>
    <script type="text/javascript">
        $(document).ready(function () {
            if (parseInt($('#compare').find('.qnt').html()) <= 0) {
                $.post("/ajax/add2compare.php", {}, function (data) {
                    $('#compare').find('.qnt').html(data.items);
                    if (data.items > 0) {
                        $('#compare a').attr('href', "/catalog/compare/?action=COMPARE");
                    }
                    else {
                        $('#compare a').removeAttr('href');
                    }
                }, 'json');
            }
        });
    </script>
<? endif; ?>
<?
// блокировка субдоменов не включенных в каталог
$sudDomains = array(
    'xn--80adxhks',
    'xn--90aedc4atap',
    'xn--b1agd0aean',
    'xn--80acgfbsl1azdqr',
    'xn--80aauks4g',
    'xn--j1aarei',
    'xn--e1afhbv7b',
    'xn--k1afg2e',
    'xn-----7kcgn5cdbagnnnx',
    'xn--80avue',
    'xn--e1aner7ci',
    'xn----7sbdqaabf2clfe5a7hpcg',
    'xn--80antj7do',
    'xn--90absbknhbvge',
    'xn----7sbeiia6axumbcqds',
    'xn----dtbdeglbi6acdmca3a',
    'xn--80aaa0cvac',
    'xn--80aalwqglfe',
    'xn--80a1bd',
    'xn--e1aohf5d',
    'xn--80addag2buct',
    'xn--h1aeawgfg',
    'xn--b1afaslnbn',
    'xn--80aacf4bwnk3a',
    'xn--80atblfjdfd2l',
    'xn--90asilg6f',
    'xn--90ahkico2a6b9d',
    'xn--80aab6birx',
    'xn--c1azcgcc',
    'xn--80ae1alafffj1i',
    'xn--80agatlhjjbulh',
    'xn--h1aliz',
    'Москва',
    'Барнаул',
    'Белгород',
    'Брянск',
    'Волгоград',
    'Воронеж',
    'Екатеринбург',
    'Иркутск',
    'Казань',
    'Кемерово',
    'Краснодар',
    'Красноярск',
    'Курск',
    'Липецк',
    'Магнитогорск',
    'Набережные Челны',
    'Нижний Новгород',
    'Новосибирск',
    'Орёл',
    'Пермь',
    'Ростов-на-Дону',
    'Рязань',
    'Самара',
    'Санкт-Петербург',
    'Сочи',
    'Ставрополь',
    'Сургут',
    'Тула',
    'Тюмень',
    'Уфа',
    'Хабаровск',
    'Челябинск',
    'moskva',
    'barnaul',
    'belgorod',
    'bryansk',
    'volgograd',
    'voronezh',
    'ekaterinburg',
    'irkutsk',
    'kazan',
    'kemerovo',
    'krasnodar',
    'krasnoyarsk',
    'kursk',
    'lipeck',
    'magnitogorsk',
    'naberezhnie-chelni',
    'nizhnii-novgorod',
    'novosibirsk',
    'orel',
    'perm',
    'rostov-na-donu',
    'ryazan',
    'samara',
    'sankt-peterburg',
    'sochi',
    'stavropol',
    'surgut',
    'tula',
    'tyumen',
    'ufa',
    'habarovsk',
    'chelyabinsk',
);
$domain = explode('.', $_SERVER['SERVER_NAME']);
if ($domain[1] == 'xn--24-6kcazf3bybfa8i') {
    if (!in_array($domain[0], $sudDomains)) {
        $redirUrl = 'https://массажеры24.рф';
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: ' . $redirUrl);
    }
}
if($domain[1] == 'massagery24'){
    if(!in_array($domain[0], $sudDomains)){
        $redirUrl = 'https://massagery24.ru';
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: '.$redirUrl);
    }
}
?>

<? $APPLICATION->IncludeComponent("mainpage:to.top", "",
    Array(),
    false,
    Array()
); ?>
<div class="body">

    <div class="bckgr_left"></div>
    <div class="bckgr_right"></div>
    <style>
        @media screen and (min-width: 1235px) {
            #page-wrapper {
                background: transparent
            }

            .body {
                position: relative
            }

            body, .smartfilter {
                background: #fff
            }

            .center {
                background: #fff
            }

            .bckgr_left {
                position: absolute;
                top: 0;
                left: 0;
                width: 18%;
                height: 550px;
                background: url("/bitrix/templates/elektro_flat/images/bckgr_left_smal.jpg");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                z-index: -1
            }

            .bckgr_right {
                position: absolute;
                top: 0;
                right: 0;
                width: 18%;
                height: 550px;
                background: url("/bitrix/templates/elektro_flat/images/bckgr_right_smal.jpg");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                z-index: -1
            }
        }
    </style>

    <div id="page-wrapper">
        <div class="center">
            <?
            if ($APPLICATION->GetCurPage() == '/'){?>
                <input type="hidden" value="home" class="gtm-page-type">
            <?}?>

            <? $APPLICATION->IncludeComponent("mainpage:menu", "",
                Array(),
                false,
                Array()
            ); ?>

            <? /* SmartFilter */ ?>
            <? $goprezaq = explode("?", $_SERVER["REQUEST_URI"]);

            $goprez = explode("/", $goprezaq[0]);
            $array_empty = array(null);
            $goprez = array_diff($goprez, $array_empty);


            $fruit21 = array_pop($goprez);
            CModule::IncludeModule("iblock");
            CModule::IncludeModule("catalog");

            $rsSect = CIBlockSection::GetList(Array("SORT" => "ASC"), array(
                'IBLOCK_ID' => 39,
                "CODE" => $fruit21
            ),
                array('nTopCount' => 1)
            );

            $gdfgdg1 = $rsSect->SelectedRowsCount();
            if ($gdfgdg1 > 0 && $APPLICATION->GetCurPage() != "/") {
                while ($arSect = $rsSect->Fetch()) {
                    $zize = $arSect['ID'];
                } ?>
                <div style="height:123px;background-color:#fff;margin-top:20px;margin-bottom:10px;">
                    <? // слайдер в каталоге под меню?>
                    <? $APPLICATION->IncludeComponent("mainpage:filter_slider", "",
                        Array(
                            "SECTION_ID" => $zize,
                        ),
                        false,
                        Array()
                    ); ?>

                    <? $APPLICATION->IncludeComponent(
                        "m24:catalog.smart.filter",
                        "m24",
                        array(
                            "COMPONENT_TEMPLATE" => "m24",
                            "IBLOCK_TYPE" => "catalog",
                            "IBLOCK_ID" => "39",
                            "SECTION_ID" => $zize,
                            "SECTION_CODE" => "",
                            "FILTER_NAME" => "arrFilter",
//                                                    "HIDE_NOT_AVAILABLE" => "Y",
                            "TEMPLATE_THEME" => "blue",
                            "FILTER_VIEW_MODE" => "vertical",
                            "DISPLAY_ELEMENT_COUNT" => "Y",
                            "SEF_MODE" => "N",
                            "CACHE_TYPE" => "N",
                            "CACHE_TIME" => "36000000",
                            "CACHE_GROUPS" => "Y",
                            "SAVE_IN_SESSION" => "N",
                            "INSTANT_RELOAD" => "N",
                            "PAGER_PARAMS_NAME" => "arrPager",
                            "PRICE_CODE" => array(
                                0 => "BASE",
                            ),
                            "CONVERT_CURRENCY" => "N",
                            "XML_EXPORT" => "N",
                            "SECTION_TITLE" => "-",
                            "SECTION_DESCRIPTION" => "-",
                            "POPUP_POSITION" => "left"
                        ),
                        false,
                        array(
                            "ACTIVE_COMPONENT" => "Y"
                        )
                    ); ?></div>
            <? } ?>

            <div id="content-wrapper">
                <div id="content">
                    <div id="workarea">
                        <? if ($APPLICATION->GetCurPage(true) == SITE_DIR . "index.php") { ?>
                            <? $APPLICATION->IncludeComponent("mainpage:topbanners", "",
                                Array(),
                                false,
                                Array()
                            ); ?>


                            <div class="ndl_tabs" itemscope itemtype="http://schema.org/ItemList">
                                <div class="section">
                                    <ul class="tabs">
                                        <li>
                                            <a href="javascript:void(0)"><span><?= GetMessage("CR_TITLE_NEWPRODUCT") ?></span></a>
                                        </li>
                                        <li>
                                            <a class="ajaxLoadItems" data-section="SALELEADER"
                                               href="javascript:void(0)"><span><?= GetMessage("CR_TITLE_SALELEADER") ?></span></a>
                                        </li>
                                        <li>
                                            <a class="ajaxLoadItems" data-section="DISCOUNT"
                                               href="javascript:void(0)"><span><?= GetMessage("CR_TITLE_DISCOUNT") ?></span></a>
                                        </li>
                                    </ul>
                                    <div class="new box">
                                        <div class="catalog-top">
                                            <? $APPLICATION->IncludeComponent("catalog.pages:page", "",
                                                Array(
                                                    "PAGE_ELEMENT_COUNT" => 6,
                                                    "PAGE_RANDOM" => 'Y',
                                                    "CATEGORY" => 'NEWPRODUCT',
                                                    "sticker" => 'sticker_new',
                                                    'Sort_field' => 'N',
                                                    "AJAX_LOAD" => 'N'
                                                ),
                                                false,
                                                Array()
                                            ); ?>
                                            <a class="all-catalog-items"
                                               href="<?= SITE_DIR ?>catalog/newproduct/"><?= GetMessage("CR_TITLE_ALL_NEWPRODUCT"); ?>
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="hit box">
                                        <div class="catalog-top">
                                            <? $APPLICATION->IncludeComponent("catalog.pages:page", "",
                                                Array(
                                                    "PAGE_ELEMENT_COUNT" => 1,
                                                    "PAGE_RANDOM" => 'Y',
                                                    "CATEGORY" => 'SALELEADER',
                                                    "sticker" => 'sticker_hit',
                                                    'Sort_field' => 'N',
                                                    "AJAX_LOAD" => 'N'
                                                ),
                                                false,
                                                Array()
                                            ); ?>
                                            <a class="all-catalog-items"
                                               href="<?= SITE_DIR ?>catalog/saleleader/"><?= GetMessage("CR_TITLE_ALL_SALELEADER"); ?>
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="discount box">
                                        <div class="catalog-top">
                                            <? $APPLICATION->IncludeComponent("catalog.pages:page", "",
                                                Array(
                                                    "PAGE_ELEMENT_COUNT" => 1,
                                                    "PAGE_RANDOM" => 'Y',
                                                    "CATEGORY" => 'DISCOUNT',
                                                    "sticker" => 'sticker_sale',
                                                    'Sort_field' => 'N',
                                                    "AJAX_LOAD" => 'N'
                                                ),
                                                false,
                                                Array()
                                            ); ?>
                                            <a class="all-catalog-items"
                                               href="<?= SITE_DIR ?>catalog/discount/"><?= GetMessage("CR_TITLE_ALL_DISCOUNT"); ?>
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clr"></div>
                            <? $APPLICATION->IncludeComponent("mainpage:region_shops", "",
                                Array(),
                                false,
                                Array()
                            ); ?>
                            <? $APPLICATION->IncludeComponent("mainpage:videoblock", "",
                                Array(),
                                false,
                                Array()
                            ); ?>
                            <? $APPLICATION->IncludeComponent("mainpage:links", "",
                                Array(),
                                false,
                                Array()
                            ); ?>
                            <? $APPLICATION->IncludeComponent("mainpage:brands", "",
                                Array(),
                                false,
                                Array()
                            ); ?>
                            <? $APPLICATION->IncludeComponent("mainpage:publication", "",
                                Array(
                                    "PAGE_ELEMENT_COUNT" => 2
                                ),
                                false,
                                Array()
                            ); ?>
                        <? } ?>


                        <div id="body_text" style="padding-top: 10px;">
                            <? if ($APPLICATION->GetCurPage(true) != SITE_DIR . "index.php"): ?>

                                <div class="h1_bread_cont <? if ($is_catalog_section) : ?>h1_bread_cont_new<? endif; ?>">
                                    <div id="breadcrumb-search">
                                        <?
                                        $APPLICATION->IncludeComponent("coffeediz:breadcrumb", "coffeediz.schema.org",
                                            array(
                                                "START_FROM" => "1",
                                                "PATH" => "",
                                                "SITE_ID" => "-"
                                            ),
                                            false,
                                            Array('HIDE_ICONS' => 'Y')
                                        );

                                        ?>
                                        <div class="clr"></div>
                                    </div><? //end breadcrumb-search?>

                                    <? //заполняем h1?>
                                    <? if (ERROR_404 != "Y") {?>

                                    <? $APPLICATION->IncludeComponent("mainpage:breadcrumb_h1", "",
                                        Array(
                                            "h1_text" => $h1,
                                            "title" => $APPLICATION->GetPageProperty('title')
                                            ),
                                        false,
                                        Array()
                                    ); ?>


                                    <?} ?>
                                </div>

                                <?

                                if (ERROR_404 != "Y") {
                                    if (!empty($seotop)) echo '<div class="seo-top">' . $seotop . '</div>';
                                }
                                ?>
                            <? endif; ?>
