<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/templates/elektro_flat/components/bitrix/catalog.viewed.products/style.min.css'); ?>
<?
//dd($arResult['ITEMS']);

if(!empty($arResult['ITEMS'])):?>
    <div class="already_seen">
        <input type="hidden" value="" class="gtm-product-id">
<!--        <input type="hidden" value="--><?//= $credit_payment ?><!--" class="gtm-product-price">-->
<!--        <input type="hidden" value="--><?//= $arResult['SECTION']['NAME'] ?><!--" class="gtm-category-name">-->
<!--        <input type="hidden" value="--><?//= $arResult['SECTION']['PATH'][0]['ID'] ?><!--" class="gtm-category-id">-->

        <div class='h3'><?=GetMessage("CATALOG_ALREADY_SEEN")?></div>
        <ul>
            <?foreach($arResult['ITEMS'] as $key => $arItem):?>
                <li>
                    <?$button = '<span>'.$arItem["NAME"].'<span><p class="in_basket_btn btn_click_add_basket_gtm">в корзину <i class="fa fa-shopping-cart" aria-hidden="true"></i></p>'?>
                    <div href="<?=$arItem["DETAIL_PAGE_URL"]?>" data-toggle="tooltip" data-html="true"
                       title='<span><?=$arItem["NAME"]?></span>
                       <div class="already_seen_btn_block"><a class="already_seen_btn" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                       <p class="in_basket_btn btn_click_add_basket_gtm already_seen_btn" data-id="<?=$arItem["ID"]?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></p></div>'>
                        <!--							<span>--><?//=$arItem["NAME"]?><!-- <p class="in_basket_btn">в корзину <i class="fa fa-shopping-cart" aria-hidden="true"></i></p></span>-->
                        <div class="img_box">
                            <?if(is_array($arItem["PICTURE"])):?>
                                <img class="lazyLoadM24"
                                     data-max="<?=$arItem["PICTURE"]["SRC"]?>"
                                     data-min=""
                                     data-media="425"
                                     src="/images/loader.jpg" alt="<?=$arItem["NAME"]?>">
                            <?else:?>
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" width="68px" height="68px" alt="<?=$arItem["NAME"]?>"/>
                            <?endif;?>
                        </div>
                    </div>
                </li>
            <?endforeach;?>
        </ul>
        <div class="clr"></div>
    </div>
<?else:?>
    <div class="already_seen_empty"></div>
<?endif;
?>

<script>
    $(document).ready(function () {
        if (screen.width < 768) {
            $('.already_seen').remove();
        }
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                // title : 'В Вашей корзине есть товар, не доступный для приобретения в рассрочку. <a href="/content/credit_buy/" target="_blank">Подробнее</a>',
                placement: 'top',
                trigger: 'click hover',
            })
        });
        $('.already_seen').on('click', '.in_basket_btn', function () {
            $('.gtm-product-id').val($(this).data('id'));
            var data ={
                ID: $(this).data('id'),
                quantity:1,
            };
            // console.log('data', data);
            $.post(
                '/ajax/add2basket.php',
                data,
                function (result) {
                    location.href = '/personal/order/make/';
                });
        });
    });
</script>
