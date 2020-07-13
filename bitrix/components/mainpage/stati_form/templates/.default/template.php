<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/stati_form/style.css'); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/chatM24/style.css');?>
<? $APPLICATION->IncludeFile("/bitrix/components/mainpage/stati_form/function.php", array(), array()); ?>

<div class="stati_banner_box">
    <div class="block_left">
<!--        <div class="banner_icon">5</div>-->
<!--        <div class="banner_on_line">online</div>-->
    </div>
    <div class="block_right">
        <div class="banner_title_preview"></div>
    </div>
    <div style="clear: both"></div>
</div>


<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        switch(Math.floor(Math.random()*(2))) {
        // switch(0) {
            case 0:
                $('.stati_banner_box').addClass('banner_margin');
                $('.block_left').append(
                    '<div class="banner_number">5</div>'
                );
                $('.block_right').append(
                    '      <div class="banner_form_block"></div>\n' +
                    '      <div class="banner_title_end"></div>\n'
                );
                if($.cookie('stati_name')){
                    var $value_name = 'value="'+$.cookie('stati_name')+'"';
                } else {
                    $value_name = '';
                }
                if($.cookie('stati_mail')){
                    var $value_mail = 'value="'+$.cookie('stati_mail')+'"';
                } else {
                    $value_mail = '';
                }
                $('.banner_form_block').append(
                    '<div class="Email_form">\n' +
                    '     <div class="error_block"></div>\n' +
                    '     <input class="validate_input input_form" data-name="name" type="text" '+$value_name+' placeholder="Ф.И.О.*">\n' +
                    '     <input class="validate_input input_form" id="mail_validate" data-name="mail" type="text" '+$value_mail+' placeholder="E-Mail*">\n' +
                    '</div>'
                );
                $('.stati_banner_box').append(
                    '<div class="user_info_confirm">\n' +
                    '    <div class="checkbox_imitate_bnr">\n' +
                    '    <div class="imitate_check_bnr"></div>\n' +
                    '    </div>\n' +
                    '    <label for="subscribe-consent">Я даю согласие <br><a target="_blank" href="/personaldata/agree.php">на\n' +
                    '                обработку моих персональных данных</a></label>\n' +
                    '</div>\n' +
                    '<button class="btn_confirm btn" onclick="yaCounter33758449.reachGoal(\'btn_confirm\'); return true;">Получить</button>'+
                    '<div class="img_over"><img src="/bitrix/components/mainpage/stati_form/image/5D3_0042.png" alt=""></div>'
                );
                $('.banner_title_preview').text('важных советов при выборе массажера');
                $('.banner_title_end').text('Отправить Вам на Email (электронную почту) бесплатно!');
                var yaCounter33758449 = new Ya.Metrika({id: 33758449});
                var yaParams = {ab_test: "mail"};
                yaCounter33758449.params(yaParams);
                break;
            case 1:
                $('.block_left').append(
                    '<div class="banner_icon"><img src="/bitrix/components/mainpage/stati_form/image/avatar.jpg" alt=""></div>'
                );
                $('.block_right').append(
                    '<div class="social_block">\n' +
                    '      <div class="banner_title_end"></div>\n' +
                    '      <div class="banner_form_block"></div>\n' +
                    '</div>'
                );
                $('.banner_form_block').append(
                    '<div class="chat_m24">\n' +
                    '        <div class="chat_title">Начать чат</div>\n' +
                    '        <a class="whatsapp_btn social_btn" onclick="yaCounter33758449.reachGoal(\'social_btn\'); return true;" href="https://api.whatsapp.com/send?phone=79299408417" target="_blank">\n' +
                    '            <i class="fa fa-whatsapp"></i>\n' +
                    '        </a>\n' +
                    '        <a class="telegram_btn social_btn" onclick="yaCounter33758449.reachGoal(\'social_btn\'); return true;" href="https://tele.click/Massagery24Bot" target="_blank">\n' +
                    '            <i class="fa fa-telegram"></i>\n' +
                    '        </a>\n' +
                    '    <div class="callbaska_box_btn social_btn" onclick="yaCounter33758449.reachGoal(\'social_btn\'); return true;" title="Обратный звонок">\n' +
                    '        <i class="fa fa-phone fa-callbaska" aria-hidden="true"></i>\n' +
                    '    </div>'+
                    '</div>'
                );
                $('.banner_title_preview').text('Я знаю все о массажных креслах и массажерах.');
                $('.banner_title_end').text('Рассказать на что стоит ориентироваться при выборе?');
                var yaCounter33758449 = new Ya.Metrika({id: 33758449});
                var yaParams = {ab_test: "messages"};
                yaCounter33758449.params(yaParams);
                break;
            default:
                break;
        }

        flag_basket = true;
        // запись в куки элементов формы при наборе
        $('.stati_banner_box').on('keyup', '.validate_input', function () {
            $.cookie('stati_'+$(this).attr('data-name'), $(this).val().trim(), {
                expires: 1,
                path: '/',
            });
        });
        // снимаем выделение с незаполненых элементов прри вводе
        $('.stati_banner_box').on('change', '.validate_input', function () {
            $(this).removeClass('alert_element');
        });

        // окрашиваем красным в случаее неправильного ввода ящика
        $('.stati_banner_box').on('change keyup', '#mail_validate', function () {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
            if(!pattern.test($(this).val())){
                $(this).addClass('alert_element');
            }
        });

        // валидация элементов формы
        $('.stati_banner_box').on('click', '.btn_confirm',function () {
            flag_basket = true;
            $('.error_block').children().remove();
            var validate_items = $('.stati_banner_box').find('.validate_input');
            $.each(validate_items, function (i,item) {
                if(!$(item).val().trim()){
                    $(item).addClass('alert_element');
                    flag_basket = false;
                    $('.error_block').append('<div class="alert_message">Заполните поле: '+$(item).attr('placeholder').replace('*', '')+'</div>');
                }
                if($(item).attr('id') == 'mail_validate'){
                    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
                    if(!pattern.test($(item).val())){
                        $(this).addClass('alert_element');
                        $('.error_block').append('<div class="alert_message incorrect_mail">E-mail введен неверно</div>');
                        flag_basket = false;
                    }
                }
            });
            // нет ошибок - подтвеждаем заказ
            if(flag_basket==true){
                var data = {};
                $.each(validate_items, function (i,item) {
                    data[$(item).data('name')] = $(item).val();
                });
                console.log('data', data);
                $.post(
                    '/api/stati_banner/',
                    data,
                    function (result) {
                        $('.stati_banner_box').children().remove();
                        $('.stati_banner_box').append('<div>Заявка принята</div>');
                    }
                );
            } else {
                $('html, body').animate({ scrollTop: $('.stati_banner_box').offset().top }, 850);
            }
        });
        $('.stati_banner_box').on('click', '.callbaska_box_btn', function () {
            $('.capiShow').click();
        });
        // обработка событий checkbox
        $('.stati_banner_box').on('click', '.checkbox_imitate_bnr', function () {
            console.log('mi ytyt');
            $(this).find('.imitate_check_bnr').toggleClass('inactiveCheck');
            if($('.inactiveCheck').length>0){
                // $('.imitate-check').css('background', 'background: rgb(130, 161, 21)!important;');
                $('.btn_confirm').prop('disabled', true);
            } else {
                $('.btn_confirm').prop('disabled', false);
            }
        });
    });
</script>
<style>
    .social_btn{
        width: 36px!important;
    }
</style>