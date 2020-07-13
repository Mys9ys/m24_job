<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);

?>

<div class="seo-interesting">
    <?
    GLOBAL $SEOTextToDisplay, $old_request_uri;
    if (!empty($SEOTextToDisplay) && !isset($_REQUEST['set_filter'])) {

        $arrFiltersTemp = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/seocat/sitemap_filter_pages.dat'));
        $fpage_current = array_search($old_request_uri . '
', $arrFiltersTemp);
        $fpage_prev = $fpage_current - 1;
        $fpage_next = $fpage_current + 1;

        $fpage_prevLink = $arrFiltersTemp[$fpage_prev];
        $fpage_nextLink = $arrFiltersTemp[$fpage_next];

        $arr = explode('/', $fpage_prevLink);
        $res = CIBlockSection::GetList(
            Array(),
            Array(
                'CODE' => $arr[2]
            ),
            false,
            Array('NAME')
        );
        $obj = $res->Fetch();
        if (isset($obj['NAME'])) {
            $fpage_prevText = $obj['NAME'] . ' ' . $arFilters[$arr[3]]['name'] . ' ' . $arFilters[$arr[4]]['name'];
        }

        $arr = explode('/', $fpage_nextLink);
        $res = CIBlockSection::GetList(
            Array(),
            Array(
                'CODE' => $arr[2]
            ),
            false,
            Array('NAME')
        );
        $obj = $res->Fetch();
        if (isset($obj['NAME'])) {
            $fpage_nextText = $obj['NAME'] . ' ' . $arFilters[$arr[3]]['name'] . ' ' . $arFilters[$arr[4]]['name'];
        }

        echo '<div style="font-weight:400;font-size:1.8em;">Вас также может заинтересовать:</div>';
        if (!empty($fpage_prevLink)) echo '<div><a href="' . $fpage_prevLink . '">' . $fpage_prevText . '</a></div>';
        if (!empty($fpage_nextLink)) echo '<div><a href="' . $fpage_nextLink . '">' . $fpage_nextText . '</a></div>';
    }
    ?>
</div>
</div>
</div>
<? if ($APPLICATION->GetCurPage(true) == SITE_DIR . "index.php"): ?>

<? endif; ?>

</div>

<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/viewed_products.php"), false); ?>
</div>

<? $APPLICATION->IncludeComponent("mainpage:footer", "",
    Array(),
    false,
    Array()
); ?>


<div id="footer">
    <div id="foot_panel_all">
        <div id="foot_panel">
            <div id="foot_panel_1">
                <?
                /*$APPLICATION->IncludeComponent("bitrix:system.auth.form", "login",
                    Array(
                        "REGISTER_URL" => SITE_DIR."personal/profile/",
                        "FORGOT_PASSWORD_URL" => SITE_DIR."personal/profile/",
                        "PROFILE_URL" => SITE_DIR."personal/profile/",
                        "SHOW_ERRORS" => "N"
                     )
                );*/
                ?>
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/footer_compare.php"
                    ),
                    false
                ); ?>

            </div>
            <div id="foot_panel_2">
                <? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", ".default",
                    Array(
                        "PATH_TO_BASKET" => SITE_DIR . "personal/order/make/",
                        "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                        "SHOW_NUM_PRODUCTS" => "Y",
                        "SHOW_TOTAL_PRICE" => "Y",
                        "SHOW_EMPTY_VALUES" => "Y",
                    ),
                    false
                ); ?>
            </div>
            <script>
                $(document).ready(function () {
                    var toUnlink = new Array('compare', 'delay', 'cart_line');
                    for (i = 0; i < toUnlink.length; i++) {
                        if (parseInt($('#' + toUnlink[i]).find('.qnt').html()) == 0) {
                            $('#' + toUnlink[i]).find('a').removeAttr('href');
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>

</div>
</div>
</div>
<?
if ($_SERVER['HTTP_HOST'] == 'massagery24.ru') {
    $showYandexMetrika = 2;
    $showGoogleAnalytics = false;
} elseif (strpos($_SERVER['HTTP_HOST'], 'xn--24-6kcazf3bybfa8i.xn--p1ai') >= 0) {
    $showYandexMetrika = false;
    $showGoogleAnalytics = true;
} else {
    $showYandexMetrika = 1;
    $showGoogleAnalytics = true;
}
?>

<? if ($showYandexMetrika == 1) { ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter33758449 = new Ya.Metrika({
                        id: 33758449,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true,
                        webvisor: true,
                        ecommerce: "dataLayer"
                    });
                } catch (e) {
                }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/33758449" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
<? } ?>

<? if ($showYandexMetrika == 2) { ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(50949848, "init", {
            id: 50949848,
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            // webvisor: true,
            ecommerce: "dataLayer"
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/50949848" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
<? } ?>





<!-- Кнопка обратного звонка -->
<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/js/callback/callback.min.css");?>
<script>
    $(document).ready(function () {
        var GRCB_widget = document.createElement('script');
        GRCB_widget.onload = function () {
            new GRCB(document.getElementsByTagName('body')[0]);
        }
        GRCB_widget.src = '<?=SITE_TEMPLATE_PATH?>/js/callback/callback.js';
        document.body.appendChild(GRCB_widget);
    });
</script>

<? if ($USER->GetLogin() !== 'contentM24') { ?>

    <!-- BEGIN JIVOSITE CODE {literal} -->
    <script type='text/javascript'>

        (function(){ var widget_id = 'HobMKhIZv9';var d=document;var w=window;function l(){
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
            s.src = '//code.jivosite.com/script/widget/'+widget_id
            ; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
            if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}
            else{w.addEventListener('load',l,false);}}})();
    </script>
    <!-- {/literal} END JIVOSITE CODE -->
    <!-- BEGIN JIVOSITE INTEGRATION WITH ROISTAT -->
    <script type='text/javascript'>
        var getCookie = window.getCookie = function (name) {
            var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        };
        function jivo_onLoadCallback() {
            jivo_api.setUserToken(getCookie('roistat_visit'));
        }
    </script>
    <!-- END JIVOSITE INTEGRATION WITH ROISTAT -->

<? } ?>

<!-- Traffic tracking code -->
<script type="text/javascript">
    (function (w, p) {
        var a, s;
        (w[p] = w[p] || []).push({
            counter_id: 473795294
        });
        a = document.createElement('script');
        a.type = 'text/javascript';
        a.async = true;
        a.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'autocontext.begun.ru/analytics.js';
        s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(a, s);
    })(window, 'begun_analytics_params');
</script>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"
                    style="float:right;padding:5px 10px 0 0;z-index:1;position:relative;">&times;
            </button>
            <div class="modal-header">
                <span class="modal-title">Modal Header</span>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script>
    // самописный lazyload
    $(window).on('scroll', function () {
        $.each($(".lazyLoadM24"), function (item, value) {
            if (($(window).scrollTop() + $(window).height()) >= $(this).offset().top) {
                if ($(this).attr('src') == '/images/loader.jpg') {
                    if (screen.width < $(this).data('media')) {
                        $(this).attr('src', $(this).data('min'));
                    } else {
                        $(this).attr('src', $(this).data('max'));
                    }
                }
            }
        });
    });

    $(document).ready(function () {
        console.log('window.pixel_vk', window);
        console.log('window.pixel_vk', $('.gtm-product-id').val());
        console.log('window.pixel_vk', $('.gtm-product-price').val());
        console.log('window.pixel_vk', $('.gtm-category-name').val());
        console.log('window.pixel_vk', $('.gtm-category-id').val());
        console.log('window.pixel_vk', $('.gtm-brand').val());
        if (screen.width <= 768 && screen.width > 620){
            $('.link_max_img').find('.maxImg-m24').eq($('.maxImg-m24').length-1).attr('src', '/bitrix/components/mainpage/links/images/massazhnye_nakidki_long.jpg');
        }
        if (screen.width > 1235) {
            $('.bckgr_left').css('backgroundImage', 'url("/bitrix/templates/elektro_flat/images/bckgr_left.jpg")');
            $('.bckgr_right').css('backgroundImage', 'url("/bitrix/templates/elektro_flat/images/bckgr_right.jpg")');
        }
    });




</script>
</body>
</html>