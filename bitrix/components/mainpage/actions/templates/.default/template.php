<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/actions/style.css'); ?>

<?////START баннер 23\8 марта START?>
<?if(!empty($arResult['spring_banner'])){?>
    <div class="spring_actions_block">
        <div class="first_spring"></div>
        <div class="second_spring"></div>
        <div class="spring_action_title">
            Акция "Весенние подарки"
        </div>
        <div class="spring_action_info_top">
            Закажите Массажное кресло Aura и выберите подарок:
        </div>
        <div class="action_content_box">
            <div class="first_gift_box" >
                <a class="first_gift_link" href="<?=$arResult['spring_banner']['first']['url']?>">
                    <div class="first_gift_img">
                        <img src="<?=$arResult['spring_banner']['first']['img']?>" alt="<?=$arResult['spring_banner']['first']['name']?>">
                    </div>
                    <div class="first_gift_title link_title">
                        <?=$arResult['spring_banner']['first']['name']?>
                    </div>
                    <div class="first_gift_price">
                        <?=intval($arResult['spring_banner']['first']['PRICE'])?> <i class="fa fa-rub" aria-hidden="true"></i>
                    </div>
                </a>
                <div class="btn_box">
                    <div class="set_buy" data-product1="<?=$arResult['spring_banner']['product']['id']?>" data-product2="<?=$arResult['spring_banner']['first']['id']?>">Заказать<i class="fa fa-cart-plus"></i></div>
                </div>
            </div>
            <div class="left_triangle_box">
                <div class="left_triangle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <a class="product_block" href="<?=$arResult['spring_banner']['product']['url']?>">
                <div class="product_img">
                    <img src="<?=$arResult['spring_banner']['product']['img']?>" alt="<?=$arResult['spring_banner']['product']['name']?>">
                </div>
                <div class="product_title link_title">
                    <?=$arResult['spring_banner']['product']['name']?>
                </div>
            </a>
            <div class="right_triangle_box">
                <div class="right_triangle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="second_gift_box">
                <a class="second_gift_link" href="<?=$arResult['spring_banner']['second']['url']?>">
                    <div class="second_gift_img">
                        <img src="<?=$arResult['spring_banner']['second']['img']?>" alt="<?=$arResult['spring_banner']['second']['name']?>">
                    </div>
                    <div class="second_gift_title link_title">
                        <?=$arResult['spring_banner']['second']['name']?>
                    </div>
                    <div class="second_gift_price">
                        <?=intval($arResult['spring_banner']['second']['PRICE'])?> <i class="fa fa-rub" aria-hidden="true"></i>
                    </div>
                </a>
                <div class="btn_box">
                    <div class="set_buy" data-product1="<?=$arResult['spring_banner']['product']['id']?>" data-product2="<?=$arResult['spring_banner']['second']['id']?>" >Заказать<i class="fa fa-cart-plus"></i></div>
                </div>
            </div>
        </div>
        <div class="spring_action_info_bottom">
            * акция действительна до 9 марта 2020
        </div>
    </div>
<?}?>
<?////END баннер баннер 23\8 марта END?>

<?foreach ($arResult['elems'] as $set){?>
    <div class="set_box">
        <input type="hidden" value="" class="gtm-product-id">
        <div class="set_title"><?=$set['NAME']?></div>
        <div class="set_item">
            <?if(count($set['items'])==2){?>
                <?foreach ($set['items'] as $item){?>
                    <div class="double_item_set">
                        <a href="<?=$item['info']['DETAIL_PAGE_URL']?>">
                            <span class="item_name"><?=$item['info']['short_name']?></span>
                            <span class="item_section"><?=$item['info']['PRETITLE']?></span>
                            <img src="<?=CFile::GetPath($item['info']['PREVIEW_PICTURE'])?>" alt="">
                            <?if($item['info']['PRICE']==0){?><span class="bonus_item">в подарок</span><?}?>
                        </a>
                    </div>
                    <?$buy_btn = '<div class="buy_set" data-item1="'.$item[''].'"></div>'?>
                <?}?>
            <?} else {?>
                <?$item=$set['items'][0]?>
                <div class="one_item_set">
                    <a href="<?=$item['info']['DETAIL_PAGE_URL']?>">
                        <div class="block_action_title">
                            <span class="item_name"><?=$item['info']['short_name']?></span>
                            <span class="item_section"><?=$item['info']['PRETITLE']?></span>
                        </div>
                        <div class="img_action_block">
                            <img src="<?=CFile::GetPath($item['info']['PREVIEW_PICTURE'])?>" alt="">
                        </div>
                    </a>
                </div>
            <?}?>
        </div>
        <div class="price_buy_box">
            <div class="add2basketSet btn_click_add_basket_gtm" data-item1="<?=$set['items'][0]['ITEM_ID']?>" data-item2="<?=$set['items'][1]['ITEM_ID']?>">Купить</div>
            <div class="price_box">
                <?$old_price=$set['items'][0]['info']['PRICE']+$set['items'][1]['info']['PRICE']?>
                <?$discount_price=$old_price-$set['PRICE']?>
                <div class="old_price"><?=number_format($old_price, 0, '', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i><div class="diagonal_price"></div></div>
                <div class="discount_price"><?=number_format($discount_price, 0, '', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                <div class="delta_price">Выгода <?=number_format($set['PRICE'], 0, '', ' ')?> <i class="fa fa-rub" aria-hidden="true"></i></div>
            </div>
        </div>
    </div>
<?}?>




<script>
    $(document).ready(function () {
        // добавляем комплект в корзину
        $('.add2basketSet').on('click',function () {
            var $this = $(this);
            $('.gtm-product-id').val($this.data('item1'));
            var data = {
                items: {
                    0: { ID:$this.data('item1'), quantity:1},
                    1: { ID:$this.data('item2'), quantity:1}
                }
            };
            $.post(
                '/ajax/add2basket.php',
                data,
                function (result) {
                    location.href = '/personal/order/make/';
                });
        });
        // добавляем комплект в корзину
        $('.set_buy').click(function () {
            var $this = $(this);
            var data = {
                items: {
                    0: { ID:$this.data('product1'), quantity:1},
                    1: { ID:$this.data('product2'), quantity:1}
                }
            };

            $.post(
                '/ajax/add2basket.php',
                data,
                function (result) {
                    location.href = '/personal/order/make/';
                });
        });
    });

</script>