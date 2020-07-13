<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<script src="https://www.google.com/recaptcha/api.js?render=6Ldar6YZAAAAAN4N3drbJjpMEaNFBsyz5e64VOC3"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ldar6YZAAAAAN4N3drbJjpMEaNFBsyz5e64VOC3', {action: '<?=$arParams['action']?>'}).then(function(token) {
            console.log('token', token);
            $.post(
                "/bitrix/components/mainpage/reCaptcha_v3/ajax/",
                {token: token},
                function(result){
                    console.log('result', result);
                    document.getElementById('recaptchaResult').value = result;
                }
            )
        });
    });
</script>
<input type="hidden" id="recaptchaResult">




