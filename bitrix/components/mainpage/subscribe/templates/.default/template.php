<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/subscribe/style.css');?>
<?global $USER;?>

<?// $APPLICATION->IncludeFile("/bitrix/components/mainpage/subscribe/function.php", array(), array()); ?>
<div id="subscribe-block">
    <div class="left-block">
        <div class="title-subscribe">Будьте в курсе!</div>
        <div class="text-subscribe">Оформите подписку на новости, обзоры и акции</div>
    </div>
    <div class="right-block">
        <input type="email" class="subscribe-email" placeholder="Ваш e-mail">
        <button class="subscribe-button btn">Подписаться</button>
        <div class="subscribe-checkbox">
            <div class="checkbox-imitate">
                <div class="imitate-check"></div>
            </div>
            <span class="subscribe-consent">Я даю согласие <br><a target="_blank" href="/personaldata/agree.php">на обработку моих персональных данных</a></span>
        </div>
    </div>
    <div class="clr"></div>
</div>
<script>
    $(document).ready(function () {
        // Коды событий ответа ajax
        var res = {
            1: 'Данный e-mail уже активирован',
            2: 'Код отправлен на указанный e-mail',
            3: 'Ошибка отправки письма',
            4: 'Неверный код',
            5: 'Ваш E-mail подтвержден',
        };
        // обработка событий checkbox
        $('.checkbox-imitate').click(function () {
            $('.imitate-check').toggleClass('inactiveCheck');
            if($('.inactiveCheck').length>0){
                $('.subscribe-button').prop('disabled', true);
            } else {
                $('.subscribe-button').prop('disabled', false);
            }
        });

        // обработка нажатия кнопки
        $('.subscribe-button').click(function () {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
            // не верный Емайл
            if(!pattern.test($('.subscribe-email').val())){
                console.log('e mail', 'неверный формат');
                $('.subscribe-email').addClass('alert_element');
            } else {
               data = {
                   email: $('.subscribe-email').val(),
                   userID: '<?=$USER->GetID()?>',
                   type: 'subscribe',
               };
                console.log('result',  data);
                $.post(
                    '/subscribe/ajax/',
                    data,
                    function(result){
                        // регистрируем Емайл и отправляем код подтверждения электронной почты
                        $('#myModal').find('.modal-header').html('<span>Подписаться</span>');
                        $('#myModal').find('.modal-header').css('background-color', 'rgb(156, 194, 24)');
                        $('#myModal').find('.modal-header').css('color', 'rgb(255, 255, 255)');
                        $('#myModal').find('.modal-body').css('background-color', 'rgb(255, 255, 255)');
                        $('#myModal').find('.modal-body').css('color', 'rgb(40, 40, 40)');
                        $('#myModal').find('.modal-footer').css('background-color', 'rgb(255, 255, 255)');
                        switch (result) {
                            case '1':
                                $('#myModal').find('.modal-body').html('<p style="font-size: 1em; color: rgb(40, 40, 40);">'+res[result]+'</p>');
                                $('#myModal').find('.modal-footer').html('<div class="subscribe-close-btn subscribe-btn">Закрыть</div>');
                                break;
                            case '2':
                                $('#myModal').find('.modal-body').html('<div class="subscribe-confirm-text">Вам на почту отправлен код подтверждения. Введите его в поле ниже</div>' +
                                    '<div style="text-align: center; width: 100%"><input type="text" class="subscribe-confirm-code" placeholder="введите код">' +
                                    '<div class="subscribe-confirm-btn subscribe-btn">Подтвердить</div></div>');
                                $('#myModal').find('.modal-footer').html( '<div class="subscribe-confirm-text">Если код не пришел,- заказать повторную отправку</div>' +
                                    '<div class="subscribe-double-send subscribe-btn">Повторить</div>');
                                break;
                        }
                        $('#myModal').modal('show');
//                        console.log('result', res['code']);
                    }
                );
            }
        });
        // Подтверждение почты
        $('#myModal').on('click', '.subscribe-confirm-btn', function () {
            data.type = 'codeConfirm';
            data.code = $('.subscribe-confirm-code').val();
            $.post(
                '/subscribe/ajax/',
                data,
                function(result){
                    console.log(result);
                    switch (result) {
                        case '3':
                            $('#myModal').find('.modal-body').html('<p style="font-size: 1em; color: rgb(40, 40, 40);">'+res[result]+'</p>');
                            $('#myModal').find('.modal-footer').html('<div class="subscribe-double-send subscribe-btn">Попробовать еще раз</div>');
                            break;
                        case '4':
                            $('#myModal').find('.modal-body').html('<div class="subscribe-confirm-text">Код неправильный, повторите попытку</div>' +
                                '<div style="text-align: center; width: 100%"><input type="text" class="subscribe-confirm-code" placeholder="введите код">' +
                                    '<div class="subscribe-confirm-btn subscribe-btn">Подтвердить</div></div>');
                            $('#myModal').find('.modal-footer').html('<div class="subscribe-confirm-text">Заказать повторную отправку</div>' +
                            '<div class="subscribe-double-send subscribe-btn">Повторить</div>');
                            break;
                        case '5':
                            $('#myModal').find('.modal-body').html('<p style="font-size: 1em; color: rgb(40, 40, 40);">'+res[result]+'</p>');
                            $('#myModal').find('.modal-footer').html('<div class="subscribe-close-btn subscribe-btn">Закрыть</div>');
                            break;
                    }
                    $('#myModal').modal('show');
                });
            console.log('data',data);
        });
        // Кнопка повторной отправки кода
        $('#myModal').on('click', '.subscribe-double-send', function () {
            data.type = 'doubleSend';
            console.log('result',  data);
            $.post(
                '/subscribe/ajax/',
                data,
                function(result){
                    console.log('result', result);
                    switch (result) {
                        case '2':
                            $('#myModal').find('.modal-body').html('<div class="subscribe-confirm-text">Вам на почту отправлен код подтверждения. Введите его в поле ниже</div>' +
                                '<input type="text" class="subscribe-confirm-code" placeholder="введите код">');
                            $('#myModal').find('.modal-footer').html('<div class="subscribe-confirm-btn subscribe-btn">Подтвердить</div>');
                            break;
                    }
                    $('#myModal').modal('show');
                });
        });
        // если незаполненый элемент изменяется - удаляем красную обводку
        $('#subscribe-block').on('change', '.alert_element', function () {
            $(this).removeClass('alert_element');
        });

    });

</script>

