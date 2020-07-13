<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/background_video/style.css'); ?>

<video loop muted autoplay class="fullscreen_bg_video">
</video>
<script>
    $(document).ready(function () {
        var $backgroundUrl = '/bitrix/components/mainpage/background_video/video/';
        console.log($('.background_source'));
        //
        if (screen.width > 1254){
            $('.fullscreen_bg_video').append('<source src="'+$backgroundUrl+'1920.mp4" type="video/mp4">');
        }
        //
        if (screen.width <= 1253 && screen.width > 769){
            $('.fullscreen_bg_video').append('<source src="'+$backgroundUrl+'1280.mp4" type="video/mp4">');
        //     $('#content').css('background', 'transparent');
        //     $('#content-wrapper').css('background', 'transparent');
        //     $('.center').css('background', 'transparent');
        }
    });
</script>
<style>

    .bckgr_left, .bckgr_right{
        display: none;
    }

    .fullscreen_bg_video {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        z-index: -100;
        width: 100%;
        /*height: 100%;*/
    }

    #content {
        background: transparent!important;
    }

    .center {
        background: rgba(255, 255, 255, 0.9);
    }

    #content-wrapper {
        background: transparent!important;
    }
    #page-wrapper{
        background: transparent!important;
    }
</style>
