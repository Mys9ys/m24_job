<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/videoblock/style.min.css');?>
<? $APPLICATION->AddHeadScript("/bitrix/components/mainpage/videoblock/script.min.js"); ?>
<div id="oxxy-block" class="">
    <div class="oxxy-block">
        <div class="oxxy-text">
            <div class="oxxy-title">Мы вас научим</div>
            <span>правильно выбирать массажные кресла <br>
            видео описания и обзоры товаров</span>
        </div>
        <div class="canvas_block animated_start">
            <div class="canvas_wrap">
                <canvas id="arc1" width="250" height="250"></canvas>
                <span>Смотрят видео перед покупкой</span>
            </div>
            <div class="canvas_wrap">
                <canvas id="arc2" width="250" height="250"></canvas>
                <span>Видео помогает с выбором</span>
            </div>
            <div class="canvas_wrap">
                <canvas id="arc3" width="250" height="250"></canvas>
                <span>Довольны покупкой</span>
            </div>
        </div>
        <div class="oxxy-img">
            <img class="lazyLoadM24"
                 data-max="/bitrix/components/mainpage/videoblock/images/img1.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">
        </div>
    </div>
</div>
<script>

</script>

<? $APPLICATION->IncludeComponent("mainpage:videoreview", "",
    Array("count"=> 6),
    false,
    Array()
); ?>

<div class="clr"></div>
<div class="more-videos"><a href="/content/video_review/" target="_blank">Больше видео <i class="fa fa-plus-circle" aria-hidden="true"></i></a></div>