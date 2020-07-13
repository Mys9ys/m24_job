$(document).ready(function(){
    // блокировка кнопки "Заказать" при снятии флажка "согласия на обработку данных"
    $('.cp-policy-field-agree').on('click', function () {
        if ($(this).is(':checked')) {
            $('.popdef').prop("disabled",false).css('cursor', 'pointer');
            $('.popdef').removeClass('greenopacity');
        } else {
            $('.popdef').prop("disabled",true).css('cursor', 'no-drop');
            $('.popdef').addClass('greenopacity');
        }
    });
});
