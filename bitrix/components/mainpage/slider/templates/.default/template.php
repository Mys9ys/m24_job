<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/slider/style.min.css'); ?>
<?//dd($arResult)?>
<div class="top_slider_wrapper">
    <div id="top_slider" class="owl-carousel-slider">
        <?foreach ($arResult as $key=>$slide){?>
            <div class="owlElement">
                <?if(!$slide['URL']){$slide['URL'] = '#';}?>
                <a class="slider_link" href="<?=$slide['URL']?>">
                    <picture class="top-slide">
                        <img class="lazyLoadM24"
                             data-max="<?=$slide['IMG']['max']?>"
                             data-min="<?=$slide['IMG']['min']?>"
                             data-media="426"
                             src="/images/loader.jpg" alt="">
                    </picture>
                </a>
            </div>
        <?}?>
    </div>
    <div class="m24_control">
        <div class="left_btn"></div>
        <div class="right_btn"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // задание переменной для автопрокрутки слайдеров
        var autoplayTime = 3500;
        $('#top_slider').owlCarousel({
            // pagination: true,
            singleItem: true,
            autoPlay: autoplayTime, // задано переменной
            mouseDrag: true,
            lazyLoad: true,
            // lazyFollow: true,
            // lazyEffect: "fade",
            touchDrag: true,
            navigation: true,
            navigationText: ["", ""],
        });
        // скрываем пагинацию и выводим при наведении мышки
        $('.owl-controls, .m24_control').hide();
        $('#top_slider, .m24_control').on( "mouseenter mouseleave", function( event ) {
            $('.owl-controls').toggle();
            $('.m24_control').toggle();
        });
        // работают кнопки
        var owl = $("#top_slider").data('owlCarousel');
        $('.left_btn').click(function(){
            owl.prev();
        });
        $('.right_btn').click(function(){
            owl.next();
        });

    });
</script>