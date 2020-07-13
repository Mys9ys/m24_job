<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/banners.new/style.css'); ?>

<?//dd($arResult['region'] )?>

<div class="m24_banner_wrapper">
    <div id="banners_new_slider" class="owl-carousel owl-theme">

        <?////START баннер 23\8 марта START?>
        <?if(!empty($arResult['spring_banner'])){?>
            <div class="spring_action_banner_box">
                <div class="first_spring"></div>
                <div class="second_spring"></div>
                <div class="spring_action_title">
                    Весенние подарки
                </div>
                <div class="spring_action_info_top">
                    Закажите
                </div>
                <a class="product_block" href="<?=$arResult['spring_banner']['product']['url']?>">
                    <div class="product_img">
                        <img src="<?=$arResult['spring_banner']['product']['img']?>" alt="<?=$arResult['spring_banner']['product']['name']?>">
                    </div>
                    <div class="product_title link_title">
                        <?=$arResult['spring_banner']['product']['name']?>
                    </div>
                </a>
                <div class="spring_action_info_middle">
                    и выберите подарок:
                </div>
                <div class="gift_box">
                    <a class="first_gift_box" href="<?=$arResult['spring_banner']['first']['url']?>">
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
                    <a class="second_gift_box" href="<?=$arResult['spring_banner']['second']['url']?>">
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
                </div>
                <div class="button_box">
                    <div class="set_buy first_gift_btn banner_btn" data-product1="<?=$arResult['spring_banner']['product']['id']?>" data-product2="<?=$arResult['spring_banner']['first']['id']?>">Заказать<i class="fa fa-cart-plus"></i></div>
                    <div class="set_buy second_gift_btn banner_btn" data-product1="<?=$arResult['spring_banner']['product']['id']?>" data-product2="<?=$arResult['spring_banner']['second']['id']?>" >Заказать<i class="fa fa-cart-plus"></i></div>
                </div>
                <div class="spring_action_info_bottom">
                    * акция действительна до 9 марта 2020
                </div>
            </div>
        <?}?>
        <?////END баннер баннер 23\8 марта END?>


<!--        --><?//foreach ($arResult as $key=>$slide){?>
<!--            <div class="owlElement">-->
<!--                --><?//=$slide?>
<!--            </div>-->
<!--        --><?//}?>


        <?//акционные баннеры ?>
        <?foreach ($arResult['sets'] as $set_elem){?>
            <div class="banner_set owlElement">
                <div class="banner_box ">
                    <div class="set_img"><img src="/bitrix/components/mainpage/banners.new/image/set_img.png" alt=""></div>
                    <div class="banner_set_title">
                        <?=$set_elem['NAME']?>
                    </div>
                    <div class="product_block">
                        <?if(count($set_elem['items']) == 2){?>
                            <div class="product1 product_card">
                                <a class="product_img" href="<?=$set_elem['items'][0]['info']['DETAIL_PAGE_URL']?>"><img src="<?=CFile::getPath($set_elem['items'][0]['info']['PREVIEW_PICTURE'])?>" alt=""></a>
                                <a class="product_name" href="<?=$set_elem['items'][0]['info']['DETAIL_PAGE_URL']?>"><?=$set_elem['items'][0]['info']['short_name']?></a>
                            </div>
                            <div class="product2 product_card">
                                <a class="product_img" href="<?=$set_elem['items'][1]['info']['DETAIL_PAGE_URL']?>"><img src="<?=CFile::getPath($set_elem['items'][1]['info']['PREVIEW_PICTURE'])?>" alt="">
                                    <?if($set_elem['PREVIEW_TEXT'] =='gift') echo '<i class="fa fa-gift" aria-hidden="true"></i>'?>
                                </a>
                                <a class="product_name" href="<?=$set_elem['items'][1]['info']['DETAIL_PAGE_URL']?>"><?=$set_elem['items'][1]['info']['short_name']?></a>
                            </div>
                        <?} else {?>
                            <div class="product_one product_card">
                                <a class="product_img" href="<?=$set_elem['items'][0]['info']['DETAIL_PAGE_URL']?>"><img src="<?=CFile::getPath($set_elem['items'][0]['info']['PREVIEW_PICTURE'])?>" alt=""></a>
                                <a class="product_name" href="<?=$set_elem['items'][0]['info']['DETAIL_PAGE_URL']?>"><?=$set_elem['items'][0]['info']['short_name']?></a>
                            </div>
                        <?}?>
                    </div>
                    <div class="price_block">
                        <div class="price_old"> <?=$price=intval($set_elem['items'][0]['info']['PRICE'])+intval($set_elem['items'][1]['info']['PRICE'])?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                        <div class="price"><?=$price-intval($set_elem['PRICE'])?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                        <div class="price_discount">выгода:<br><?=intval($set_elem['PRICE'])?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                    </div>
                    <div class="button_block">
                        <div class="set_buy banner_btn" data-product1="<?=$set_elem['items'][0]['ITEM_ID'];?>" data-product2="<?=$set_elem['items'][1]['ITEM_ID'];?>" onClick="ga('send', 'event', 'Knopka', 'Banner_basket')">Купить<i class="fa fa-cart-plus"></i></div>
                        <a href="/actions/set/" class="all_set banner_btn">Все акции <i class="fa fa-gift" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        <?}?>
        <?//акционные баннеры END?>

        <?//Баннер с шоурумом в городе?>
            <?=$arResult['region']?>
        <?//Баннер с шоурумом в городе END?>

        <?//баннер для акций касада(кресла)?>
        <?$arResult['snowflake'] = 'N' // выключил новогодние акционные баннеры?>
            <?if($arResult['snowflake'] == 'Y'){?>
            <div class="banner_snowflake owlElement">
                <div class="banner_snowflake_box">
                    <div class="banner_snowflake_title">
                        Индивидуальная скидка
                    </div>
                    <div class="snowflake_pic">
                        <img src="/bitrix/components/mainpage/banners.new/image/snowflake.png" alt="">
                    </div>
                    <div class="banner_snowflake_description">
                        В период проведения Новогодней акции у Вас есть возможность получить Персональную скидку на данный товар. <br>Для этого Вам нужно связаться со специалистом call-центра позвонив по номеру: <span class="roistat_phone">8(800)222-16-90</span>
                        или заказав обратный звонок.
                    </div>
                    <div class="button_block">
                        <div class="snowflake_call banner_btn">Связаться <i class="fa fa-phone-square" aria-hidden="true"></i></div>
                        <a href="/actions/set/" class="all_set banner_btn">Все акции <i class="fa fa-gift" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <?}?>
        <?//баннер для акций касада(кресла) END?>


    </div>
</div>




<script>
    $(document).ready(function () {
        // задание переменной для автопрокрутки слайдеровi
        var autoplayTime = 5000;
        $('#banners_new_slider').owlCarousel({
            // autoHeight: true,
            pagination: true,
            singleItem: true,
            autoPlay: autoplayTime, // задано переменной
            mouseDrag: true,
            lazyLoad: true,
            lazyFollow: true,
            lazyEffect: "fade",
            touchDrag: true,
        });
    });


    var maxTop = $('.m24_banner_wrapper').offset().top;
    $(window).on('scroll',function() {
               // едем вниз
        if($(this).scrollTop()>=maxTop){
                // console.log('mi tyt');
                $('.m24_banner_wrapper').css({position:'fixed'});
                $('.m24_banner_wrapper').offset({top:$(window).scrollTop()+20});
        }
        // едем вверх
        if($(this).scrollTop()<maxTop){
            // console.log('mi tyt2', 'banner_fixed_start' , banner_fixed_start);
            $('.m24_banner_wrapper').css({position:'relative'});
        }
        if($(this).scrollTop()>$('.left_panel').height()-($('.m24_banner_wrapper').height()+300)){
            $('.m24_banner_wrapper').css({position:'relative'});
            $('.m24_banner_wrapper').offset({top:$('.left_panel').height()-($('.m24_banner_wrapper').height()+300)});
        }
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
    // баннер со снежинкой открывает обратный звонок
    $('.snowflake_call').on('click', function () {
       $('.grcb_widget').click();
    });
</script>
