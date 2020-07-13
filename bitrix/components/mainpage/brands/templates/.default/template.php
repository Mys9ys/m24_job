<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/brands/style.min.css');?>
<? $APPLICATION->IncludeFile("/bitrix/components/mainpage/brands/function.php", array(), array()); ?>


<?if($arParams['page'] != 'about'){?>
    <?$arBrands = brandsLink()?>
    <div id="block-brands">
        <div class="brands-title">Мы представляем все популярные бренды!</div>
        <div class="slaider_wrapper">
            <div id="brands_owl" class="owl-carousel-slider">
                <?foreach ($arBrands as $link=>$arBrand){?>
                    <div class="owlElement">
                        <a href="/vendors/<?=strtolower($link)?>/">
                            <div class="brand-img"><img class="lazyOwl" data-src="<?=CFile::GetPath($arBrand)?>" src="" alt=""></div>
                        </a>
                    </div>
                <?}?>
            </div>
            <a class="btn_all_vendors" href="/vendors/" target="_blank">Все бренды</a>
        </div>
    </div>
<?}?>




<?$arAdvantages = array(
    '1.' => array('title'=>'Официальный магазин', 'text'=>'Сеть магазинов по всей России даёт вам возможность протестировать товар перед покупкой. Мы живём не только в сети!', 'link' => '/content/contacts/'),
    '2.' => array('title'=>'Удобные способы оплаты', 'text'=>'Оплачивайте свои покупки при получении картой или наличными.<br> Вы видите, за что платите!', 'link' => '/content/pay_and_delivery/'),
    '3.' => array('title'=>'Персональные предложения', 'text'=>'Выгодные цены и скидки постоянным клиентам.', 'link' => '/actions/set/'),
    '4.' => array('title'=>'Бесплатная доставка', 'text'=>'По всей России при покупке от 5000 Р.', 'link' => '/content/pay_and_delivery/'),
    '5.' => array('title'=>'Возврат товара', 'text'=>'', 'link' => '/content/refund/'),
    '6.' => array('title'=>'Реальные эксперты', 'text'=>'Профессиональные консультации.<br>Мы действительно разбираемся в нашей продукции!', 'link' => '/content/video_review/'),
);
?>
<div id="block-advantages">
    <div class="advantages-title"><span> !</span>Наши преимущества для вас:</div>
    <div class="left-line"><div class="green-line"></div></div>
    <div class="right-block">
        <?foreach ($arAdvantages as $id=>$arAdvantage){?>
            <span><?=$id?></span>
            <a href="<?=$arAdvantage['link']?>"> <div class="main-title"><?=$arAdvantage['title']?></div></a>
            <div class="main-text"><?=$arAdvantage['text']?></div>
        <?}?>
    </div>
    <div class="clr"></div>
    <div class="oxxy-advantages-img">
        <img class="lazyLoadM24"
             data-max="/bitrix/components/mainpage/brands/images/img.png"
             data-min=""
             data-media="0"
             src="/images/loader.jpg" alt="">
    </div>
</div>

<script>
    $(document).ready(function () {
        // задание переменной для автопрокрутки слайдеров
        $('#brands_owl').owlCarousel({
            mouseDrag: true,
            lazyLoad: true,
            itemsDesktop: [1199,5],
            itemsDesktopSmall: [980,4],
            itemsTablet: [768,3],
            itemsMobile: [479,2],
            touchDrag: true,
            navigation: true,
            navigationText: ["", ""],
        });

        if (screen.width <= 620 && screen.width > 0){
            $('.green-line').height($('.right-block').find('span').eq(5).offset().top-$('.right-block').find('span').eq(0).offset().top);
            $('.green-line').css('right',$('.left-line').width()/2);
            $('.right-block').find('span').each(function () {
                $(this).css('left', -($('.left-line').width()+$(this).width())/2);
            });
        }

        $('.owl-controls').hide();
        $('#brands_owl').on( "mouseenter mouseleave", function( event ) {
            $('.owl-controls').toggle();
        });


    });
</script>