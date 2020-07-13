<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/footer/style.min.css');?>
<? $APPLICATION->IncludeFile("/bitrix/components/mainpage/footer/function.php", array(), array()); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/socialbtn/style.min.css');?>
    <script>
        if (screen.width < 1234) {
            $('#foot_panel_all').remove();
        }
    </script>
<div id="footer-m24">
    <div class="footer_wrapper">
        <div class="company_block footer_block">
            <div class="footer_title">Компания</div>
            <?$arCompanyLinks = linkCompany()?>
            <?foreach ($arCompanyLinks as $link=>$name){?>
                <a class="footer_link" href="<?=$link?>"><?=$name?></a>
            <?}?>
        </div>
        <div class="catalog_block footer_block">
            <div class="footer_title">Каталог</div>
            <?$arCatalogLinks = linkCatalog()?>
            <?foreach ($arCatalogLinks as $link=>$name){?>
                <a class="footer_link" href="<?=$link?>"><?=$name?></a>
            <?}?>
        </div>
        <div class="service_block footer_block">
            <div class="footer_title">Сервис</div>
            <?$arServiseLinks = linkServise()?>
            <?foreach ($arServiseLinks as $link=>$name){?>
                <a class="footer_link" href="<?=$link?>"><?=$name?></a>
            <?}?>
        </div>
        <div class="pay_block footer_block">
            <div class="footer_title">Принимаем к оплате</div>
            <?$path_img = '/bitrix/components/mainpage/footer/images/'?>
            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>mir.png"
                 data-min="0"
                 data-media="0"
                 src="/images/loader.jpg" alt="">
             <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>master.png"
                 data-min="0"
                 data-media="0"
                 src="/images/loader.jpg" alt="">
             <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>visa.png"
                 data-min="0"
                 data-media="0"
                 src="/images/loader.jpg" alt="">

            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>halva.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">

            <div class="footer_title">Рассрочка</div>
            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>home.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">
            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>alfabank.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">
            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>opt.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">
            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>pochta-bank.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">
            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>renessans.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">
            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>kredit_evro.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">
            <img class="bank_img lazyLoadM24"
                 data-max="<?= $path_img?>paylate.png"
                 data-min=""
                 data-media="0"
                 src="/images/loader.jpg" alt="">
        </div>
        <div class="logo_block footer_block">
            <a href="/" class="logo_img">
                <img class="lazyLoadM24"
                     data-max="<?= $path_img?>logo_white.png"
                     data-min=""
                     data-media="0"
                     src="/images/loader.jpg" alt="">
            </a>
            <div class="chat_block">
                <? $APPLICATION->IncludeComponent("mainpage:chatM24", "",
                    Array(
                        'footer' => true
                    ),
                    false,
                    Array()
                ); ?>
            </div>
            <a href="https://market.yandex.ru/shop/444414/reviews" target="_blank" class="ya_market">
                <img class="lazyLoadM24"
                     data-max="<?= $path_img?>y_market.png"
                     data-min=""
                     data-media="0"
                     src="/images/loader.jpg" alt="">
            </a>
        </div>
        <div class="footer_clear"></div>
        <div class="social_block">
            <div class="social_icon">
                <a class="btn_wrap" rel="nofollow" href="https://www.instagram.com/massagery24.ru/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a class="btn_wrap" rel="nofollow" href="https://www.facebook.com/massagery24/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a class="btn_wrap" rel="nofollow" href="https://vk.com/massagery24" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a class="btn_wrap" rel="nofollow" href="https://ok.ru/group/54165989097650" target="_blank"><i class="fa fa-odnoklassniki-square" aria-hidden="true"></i></a>
                <a class="btn_wrap" rel="nofollow" href="https://twitter.com/massagery24" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                <a class="btn_wrap" rel="nofollow" href="https://www.youtube.com/c/Массажеры24рф" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="politika_block">
            <!--noindex--><a class="politika_link" rel="nofollow" href="/personaldata/agree.php">Согласие на обработку персональных данных</a><!--/noindex-->
            <!--noindex--><a class="politika_link" rel="nofollow" href="/personaldata/">Политика в отношении обработки персональных данных</a><!--/noindex-->
        </div>
    </div>
</div>
<?