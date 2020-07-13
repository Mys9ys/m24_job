<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/partnership/style.css'); ?>
<? $APPLICATION->IncludeFile("/bitrix/components/mainpage/partnership/function.php", array(), array()); ?>
<div class="partnership-wrap">

    <h2>Если вас интересует сотрудничество с нами, оставьте свою заявку здесь, отдел по работе с партнерами свяжется с Вами</h2>
    <div class="start-partnership partnership-btn">Стать партнером</div>
</div>


<div id="partnershipModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" style="float:right;padding:5px 10px 0 0;z-index:1;position:relative;">&times;</button>
            <div class="modal-header">
                <h2>Заявка на сотрудничество с нами</h2>
            </div>
            <div class="modal-body">
                <div class="form-wrap">
                    <input type="text" class="form-elem form-data" data="name" placeholder="Введите">
                    <span class="form-title">Ваше имя</span>
                </div>
                <div class="form-wrap">
                    <input type="text" id="phonenumber" class="form-elem form-data" data="phone" placeholder="Введите">
                    <input type="hidden" id="phonenumber_format" value="">
                    <span class="form-title">Ваш телефон</span>
                </div>
                <div class="form-wrap">
                    <input type="email" id="email" class="form-elem form-data" data="email" placeholder="Введите">
                    <span class="form-title">Ваш E-mail</span>
                </div>
                <textarea class="form-textarea form-data" data="text" placeholder="Ваше сообщение"></textarea>
            </div>
            <div class="modal-footer">
                <div class="partnership-checkbox">
                    <div class="partnership-checkbox-imitate">
                        <div class="imitate-check"></div>
                    </div>
                    <label for="subscribe-consent">Я даю согласие <br><a target="_blank" href="/personaldata/agree.php">на обработку моих персональных данных</a></label>
                </div>
                <button class="send-proposal btn partnership-btn" disabled>Отправить</button>
                <div class="captcha">
                    <div class="captcha-title float-left">Я не робот</div>
                    <input class="captcha-range float-left" type="range" min="0" max="1" value="0" step="1">
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/bitrix/components/mainpage/partnership/script.js"></script>