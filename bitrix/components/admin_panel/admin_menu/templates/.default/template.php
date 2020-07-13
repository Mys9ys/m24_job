<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/admin_panel/admin_menu/style.css'); ?>
<? include_once($_SERVER['DOCUMENT_ROOT'] . '/api/get_sms_adress/smsc_api.php');
$sms_balanse = get_balance(); ?>
<? $APPLICATION->SetTitle("Админка"); ?>

<div class="wrapper">
    <ul class="tabs clearfix" data-tabgroup="admin_menu">
        <li>

            <a href="#tab1" class="tabs_a active" title="Счет">Каталог amoCRM<i class="fa fa-table"
                                                                                aria-hidden="true"></i>

            </a>
        </li>
        <li>
            <a href="#tab2" class="tabs_a" title="Счет">Смсцентр<span
                        class="badge sms_balance"> баланс: <?= $sms_balanse ?></span><i class="fa fa-comments"
                                                                                        aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a href="#tab3" class="tabs_a">Ошибки вычисления маржи
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </a>
        </li>
        <li>
            <a href="#tab4" class="tabs_a">Брошенные корзины
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
    <section id="admin_menu" class="tabgroup">
        <div id="tab1" class="tabs_block">
            <div class="tab_title">Работа с каталогами amoCRM</div>
            <p>Примечания:
            <ol>
                <li>Выгрузка файла в папку загрузки - около минуты</li>
                <li>Очередность столбцов просьба не менять</li>
            </ol>
            </p>
            <?
            $APPLICATION->IncludeComponent("admin_panel:amo_catalog", "",
                Array(),
                false,
                Array()
            );
            ?>

        </div>
        <div id="tab2">

        </div>
        <div id="tab3">
            <div class="tab_title">Брошенные корзины</div>
            <?
            $APPLICATION->IncludeComponent("admin_panel:calculate_error", "",
                Array(),
                false,
                Array()
            );
            ?>
        </div>
        <div id="tab4">
            <div class="tab_title">Брошенные корзины</div>
            <?
            $APPLICATION->IncludeComponent("admin_panel:drop_basket", "",
                Array(),
                false,
                Array()
            );
            ?>
        </div>

    </section>
</div>
<script>
    // $('.tabgroup > div').hide();
    // $('.tabgroup > div:first-of-type').show();
    // $('.tabs a').click(function (e) {
    //     // e.preventDefault();
    //     var $this = $(this),
    //         tabgroup = '#' + $this.parents('.tabs').data('tabgroup'),
    //         others = $this.closest('li').siblings().children('a'),
    //         target = $this.attr('href');
    //     others.removeClass('active');
    //     $this.addClass('active');
    //     $(tabgroup).children('div').hide();
    //     $(target).show();
    // })
</script>


<? $APPLICATION->AddHeadScript("/bitrix/components/admin_panel/drop_basket/script.js"); ?>

