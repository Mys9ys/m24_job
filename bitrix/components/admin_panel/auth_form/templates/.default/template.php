<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? $APPLICATION->SetAdditionalCSS('/bitrix/components/admin_panel/auth_form/style.css'); ?>

<div class="auth_wrapper">
        <div class="warning_block"></div>
        <div class="auth_title">Выполните вход</div>
        <input class="auth_input" type="text" placeholder="логин" data="login">
        <input class="auth_input" type="password" placeholder="пароль" data="password">
        <div class="btn_login">Войти</div>
</div>


<? $APPLICATION->AddHeadScript("/bitrix/components/admin_panel/auth_form/script.js"); ?>

<script>
    $(document).ready(function () {
        $('.btn_login').on('click', function () {
            auth_flag = true;
            data = {operation:'login'};

            $.each($('.auth_wrapper').find('.auth_input'), function (i, value) {
                console.log('i',i, 'value', value);
                console.log($(this).attr('data'));

                if(!$(this).val()){
                    $(this).addClass('auth_attention');
                    auth_flag = false;
                } else {
                    data[$(this).attr('data')] = $(this).val()
                }

            });
            if(auth_flag == true){
                $('.btn_login').append(' <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                $.post(
                    '/bitrix/components/admin_panel/auth_form/ajax/',
                    data,
                    function (result) {
                        if(result == true){
                            location.reload();
                        } else {
                            $('.warning_block').html('<span>ошибка авторизации</span>');
                        }
                    }
                );
            }
        });
    });
</script>