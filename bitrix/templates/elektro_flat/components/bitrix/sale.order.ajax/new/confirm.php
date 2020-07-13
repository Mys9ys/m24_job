<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? // CModule::IncludeModule('sale') ?>

<?//dd($arResult);?>
<?//dd($arParams);?>
<? // цена заказа
$bxCurrentOrder = CSaleOrder::GetByID($_GET['ORDER_ID']); ?>
<?
// состав корзины
$bxCurrentBasket = CSaleBasket::GetList(
    Array("ID" => "ASC"),
    Array("ORDER_ID" => $_GET['ORDER_ID'])
);
while ($arBasket = $bxCurrentBasket->Fetch()) {
    $arProducts[] = $arBasket;
} ?>

<? //адрес доставки
$bxCurrentProps = CSaleOrderPropsValue::GetList(
    Array(),
    Array("ORDER_ID" => $_GET['ORDER_ID'])
);
while ($arProp = $bxCurrentProps->Fetch()) {
    $arProps[$arProp['CODE']] = $arProp;

} ?>

<?// dd($arProps); ?>
<?// dd($arProducts); ?>
<?// dd($bxCurrentOrder) ?>
<!---->
<?// dd($arResult) ?>

    <div class="notetext">
        <? if (!empty($arResult["ORDER"])) { ?>
            <div class="block_basket_title orange_title"><?= GetMessage("SOA_TEMPL_ORDER_COMPLETE") ?></div>

            <div class="order_avatar">
                <img src="/bitrix/templates/elektro_flat_copy/components/bitrix/sale.order.ajax/new/image/order.jpg"
                     alt="">
            </div>
            <div class="confirm_order_chat">
                <div class="confirm_title_chat confirm_title_first">Поздравляем! Вы успешно оформили заказ.</div>
                <div class="confirm_title_chat confirm_title_second">Благодарим что выбрали массажеры24.рф.</div>
                <div class="confirm_title_chat confirm_title_info">В настоящий момент Ваш заказ обрабатывается. В
                    ближайшее время мы позвоним Вам для уточнения
                    подтверждения заказа.
                </div>
            </div>
            <div style="clear: both"></div>


            <div class="products_block">
                <div class="confirm_order">Заказ: <b><?= $_GET['ORDER_ID'] ?></b></div>
                <div class="confirm_sum_price">Сумма заказа:
                    <b><?= number_format(intval($bxCurrentOrder['PRICE']), 0, '', ' ') ?> руб.</b></div>
                <div style="clear: both"></div>
                <div class="products_box order_box_temp">
                    <div class="products_title order_title_temp">Товары:</div>
                    <? foreach ($arProducts as $key => $product) { ?>
                        <div class="product_item">
                            <div class="product_count"><?= $key + 1 ?></div>
                            <div class="product_pic">
                                <img src="<?= orderGetItemPic($product['PRODUCT_ID']) ?>" alt="">
                            </div>
                            <div class="product_name"><a href="<?= $product['DETAIL_PAGE_URL'] ?>"
                                                         target="_blank"><?= $product['NAME'] ?></a></div>

                            <div class="product_quantity">x<?= intval($product['QUANTITY']) ?></div>
                            <div class="product_price"><?= number_format(intval($product['PRICE']), 0, '', ' ') ?>
                                руб.
                            </div>
                        </div>
                    <? } ?>
                </div>

            </div>
            <div class="order_props_box order_box_temp">
                <div class="props_title order_title_temp">Дополнительная информация:</div>
                <?if(!empty($arProps['ADDRESS']['VALUE'])){?>
                    <div class="props_text">Доставка: <?= $arProps['Location_m24']['VALUE'] ?>, <?= $arProps['ADDRESS']['VALUE'] ?></div>
                <?}?>
                <? if (!empty($arResult["PAY_SYSTEM"])) { ?>
                    <div class="props_text"><?= GetMessage("SOA_TEMPL_PAY") ?>: <?= $arResult["PAY_SYSTEM"]["NAME"] ?></div>
                <?}?>

            </div>

            <!--        <p>-->
            <!--            --><? //= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"])) ?>
            <!--            <br/><br/>-->
            <!--            --><? //= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
            <!--        </p>-->
        <? if (!empty($arResult["PAY_SYSTEM"])) { ?>

        <?
        if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0) {
        if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y") { ?>
            <script language="JavaScript">
                window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$arResult["ACCOUNT_NUMBER"]?>');
            </script>
            <p><?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . $arResult["ACCOUNT_NUMBER"])) ?></p>
        <? } else {
            if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]) > 0) {
                include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
            }
        }
        }?>

        <?if ($arResult['ORDER']['PAY_SYSTEM_ID'] == '14') {
            ?><p>Для оплаты (ввода реквизитов вашей карты) вы будете перенаправлены на платёжный шлюз ПАО СБЕРБАНК.
                Соединение с платёжным шлюзом и передача информации осуществляется в защищённом режиме с использованием
                протокола шифрования SSL. В случае если ваш банк поддерживает технологию безопасного проведения
                интернет-платежей Verified By Visa или MasterCard SecureCode, для проведения платежа также может
                потребоваться ввод специального пароля. Настоящий сайт поддерживает 256-битное шифрование.
                Конфиденциальность сообщаемой персональной информации обеспечивается ПАО СБЕРБАНК. Введённая информация
                не
                будет предоставлена третьим лицам за исключением случаев, предусмотренных законодательством РФ.
                Проведение
                платежей по банковским картам осуществляется в строгом соответствии с требованиями платёжных систем МИР,
                Visa Int. и MasterCard Europe Sprl.</p><?
        }
        }
        } else { ?>

            <div class="block_basket_title"><?= GetMessage("SOA_TEMPL_ERROR_ORDER") ?></div>
                <br/>
                <?= GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"])) ?>
                <?= GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1") ?>

        <? } ?>

    </div>
<?
// Получаем картинку товара
function orderGetItemPic($id)
{
    $filter = Array("IBLOCK_ID" => 39,
        "ACTIVE" => "Y",
        "ID" => $id
    );
    $res = CIBlockElement::GetList(
        array(),
        $filter,
        false,
        false,
        array());
    while ($ob = $res->GetNextElement()) {
        $response = $ob->GetFields();
        $response["PROPERTIES"] = $ob->GetProperties();
        $elem['IMG'] = CFile::GetPath($response["PREVIEW_PICTURE"]);
        return $elem['IMG'];
    }
}

?>