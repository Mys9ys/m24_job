<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!--<h2>--><?//=GetMessage("SOA_TEMPL_SUM_TITLE")?><!--</h2>-->
<div class="cart-items" style="margin:0px 0px 10px 0px;">
    <?//Товары в корзине?>
    <div class="order_box basket_products">
        <div class="block_basket_title">Ваши покупки</div>
        <div class="basket_products_box">
            <div class="basket_product_title">
                <div class="product_title">Продукт</div>
                <div class="price_one_title">Цена за шт</div>
                <div class="quantity_title">Кол-во</div>
                <div class="summary_title">Сумма</div>
            </div>
            <?foreach($arResult['BASKET_ITEMS'] as $key => $product){?>
                <div class="product_item" data-id="<?=$product['ID']?>" data-product="<?=$product['PRODUCT_ID']?>" data-name="<?=$product['name']?>" data-price="<?=ceil($product['PRICE'])?>" data-quantity="<?=ceil($product['QUANTITY'])?>">
                    <div class="product_number"><?=$key+1?></div>
                    <div class="product_img"><img src="<?=$product['DETAIL_PICTURE']?>" alt=""></div>
                    <a class="product_name" href="<?=$product['DETAIL_PAGE_URL']?>" target="_blank"><?=$product['name']?></a>
                    <div class="product_price">
                        <?if($product['DISCOUNT_PRICE']>0){?>
                            <div class="old_price"> <?=number_format(ceil($product['old_price']), 0, '', ' ')?> руб.</div>
                            <div class="discount_price">- <?=number_format(ceil($product['DISCOUNT_PRICE']), 0, '', ' ')?> руб.</div>
                            <div class="price_end"><?=number_format(ceil($product['PRICE']), 0, '', ' ')?> руб.</div>
                        <?} else {?>
                            <div class="price_no_discount"><?=number_format(ceil($product['PRICE']), 0, '', ' ')?> руб.</div>
                        <?}?>
                    </div>
                    <div class="basket_quantity">
                        <div class="quantity_product_change minus" data-item_id="<?=$product['ID']?>" data-operation="minus" data-count="<?=$product['QUANTITY']?>">–</div>
                        <input class="quantity_product_field" type="text" value="<?=ceil($product['QUANTITY'])?>" readonly>
                        <div class="quantity_product_change plus" data-item_id="<?=$product['ID']?>" data-operation="plus" data-count="<?=$product['QUANTITY']?>">+</div>
                    </div>
                    <div class="product_price_summary">
                        <?if($product['DISCOUNT_PRICE']>0){?>
                            <div class="old_price"> <?=number_format(ceil($product['old_price'])*ceil($product['QUANTITY']), 0, '', ' ')?> руб.</div>
                            <div class="discount_price">- <?=number_format(ceil($product['DISCOUNT_PRICE'])*ceil($product['QUANTITY']), 0, '', ' ')?> руб.</div>
                            <div class="price_end"><?=number_format(ceil($product['PRICE'])*ceil($product['QUANTITY']), 0, '', ' ')?> руб.</div>
                        <?} else {?>
                            <div class="price_no_discount"><?=number_format(ceil($product['PRICE'])*ceil($product['QUANTITY']), 0, '', ' ')?> руб.</div>
                        <?}?>
                    </div>
                    <div class="delete_product"  data-item_id="<?=$product['ID']?>"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                </div>
            <?}?>
            <div class="basket_delivery_block">
                <div class="basket_delivery_title">Доставка:</div>
                <div class="basket_delivery_price" data-delivery_price="<?=$arResult['DELIVERY_PRICE']?>" data-item_id="<?=$product['ID']?>" data-price="<?=$arResult['ORDER_PRICE']?>"><?=$arResult['DELIVERY_PRICE_FORMATED']?></div>
            </div>
            <div class="basket_summary_block">
                <div class="basket_summary_price">
                    <div class="basket_summary_price_title">Итого: </div>
                    <div class="basket_summary_price_value">
                        <?=$arResult['ORDER_TOTAL_PRICE_FORMATED']?>
                    </div>
                    <input type="hidden" class="validate_opder_price" value="<?=$arResult['ORDER_PRICE']?>">
                </div>
                <?if($arResult['summary_profit']>0){?>
                    <div class="basket_summary_profit">
                        <div class="basket_summary_profit_title">Выгода: </div>
                        <div class="basket_summary_profit_value">
                            <?=number_format(ceil($arResult['summary_profit']), 0, '', ' ')?> руб.
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div>

<script>
 $(document).ready(function () {
     // удаляем из корзины
    $('.delete_product').on('click', function () {
        basket_loader();
        var data = {
            operation: 'delete',
            id: $(this).data('item_id')
        };
        $.post(
            '/bitrix/templates/elektro_flat_copy/components/bitrix/sale.order.ajax/new/ajax/',
            data,
            function (result) {
                location.reload();
            }
        );
    });
    // увеличиваем/уменьшаем количество товаров в корзине
     $('.quantity_product_change').on('click', function () {
         basket_loader();
         var data = {
             operation: $(this).data('operation'),
             id: $(this).data('item_id'),
             QUANTITY: $(this).data('count'),
         };
         $.post(
             '/bitrix/templates/elektro_flat_copy/components/bitrix/sale.order.ajax/new/ajax/',
             data,
             function (result) {
                 location.reload();
             }
         );
     });
     // добавление в стоимость суммы доставки в случае стоимости заказа ниже минимума - 5000
     if($('.basket_delivery_price').attr('data-delivery_price')>0){
         var data = {
             operation: 'delivery',
             id: $('.basket_delivery_price').data('item_id'),
             price: parseInt($('.basket_delivery_price').attr('data-delivery_price'))+parseInt($('.basket_delivery_price').attr('data-price'))
         };

     }
     //двигаем разрешение
     if (screen.width <= 787 && screen.width > 426){
         var name_width = screen.width - (77+75+50+85+31+40);
         console.log('name_width',name_width);
         $('.product_name').css('width',name_width);
         $('.product_title').css('width',name_width+75);
         $('.basket_delivery_title').css('width',name_width);
         $('.basket_summary_price_title').css('width',name_width+75+50);
         $('.basket_summary_profit_title').css('width',name_width+75+50);
     }
     if (screen.width <= 425 && screen.width > 200){
         var name_width = screen.width - (77+41+80+26);
         console.log('name_width',name_width);
         $('.product_name').css('width',name_width);
         $('.product_title').css('width',name_width+40);
         $('.basket_delivery_title').css('width',name_width);
         $('.basket_summary_price_title').css('width',name_width+41);
         $('.basket_summary_profit_title').css('width',name_width+41);
     }
 });
 // закрываем от повторныз нажатий
 function basket_loader() {
    $('#spiner_modal').modal('show');
 }
</script>


