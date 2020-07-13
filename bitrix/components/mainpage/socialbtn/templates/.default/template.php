<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/socialbtn/style.min.css');?>

<div class="social_btn_box">
    <!--noindex-->
    <?if($arParams['title']){
        $block_title = $arParams['title'];
    } else {
        $block_title = 'Мы в соцсетях';
    }?>
    <div class="social_btn_title"><?=$block_title?></div>
    <div class="social_btn_link">
        <a rel="nofollow" href="https://www.instagram.com/massagery24.ru/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a rel="nofollow" href="https://www.facebook.com/massagery24/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        <a rel="nofollow" href="https://vk.com/massagery24" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
        <a rel="nofollow" href="https://ok.ru/group/54165989097650" target="_blank"><i class="fa fa-odnoklassniki-square" aria-hidden="true"></i></a>
        <a rel="nofollow" href="https://twitter.com/massagery24" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
        <a rel="nofollow" href="https://www.youtube.com/c/Массажеры24рф" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
    </div>
    <!--/noindex-->
</div>



