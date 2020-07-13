$(document).ready(function () {
    $('.start-partnership').click(function () {
        $('#partnershipModal').modal('show');
    });
    // работа с капчей
    $('.captcha-range').on('change',function () {
        var value = Number(this.value)*100;
        $(this).css({'background':'-webkit-linear-gradient(left ,rgb(215, 231, 163) 0%,rgb(215, 231, 163) '+value+'%,rgb(255, 78, 51) '+value+'%, rgb(255, 78, 51) 100%)'});
        if(value == 100) {
            $(this).parent().parent().children('.btn').prop('disabled', false);
        }
    });
    // отправка данных формы
    $('.send-proposal').click(function () {
        var data = {};
        $(this).parent().parent().find('.form-data').each(function () {
            data[$(this).attr('data')] = $(this).val();
        });

        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
        // не верный Емайл
        if(!pattern.test($('#email').val())){
            $('#email').addClass('alert_element');
        } else {
            if (validateForm('.modal-body',data) == true) {
                console.log('validateForm', data);
                $.post(
                    '/ajax/partnership.php',
                    data,
                    function(result){
                        if(result == 1){
                            $('#partnershipModal').find('.modal-footer').children().remove();
                            $('#partnershipModal').find('.modal-body').children().remove();
                            $('#partnershipModal').find('.modal-body').append('<div class="wrap"><p>Ваша заявка отправлена</p></div>');
                            $('#partnershipModal').find('.modal-footer').append('<div class="close-modal partnership-btn">Закрыть</div>');
                        }
                    }
                );
            }
            else {

            };
        }
    });
    // валидация номера по маске
    $("#phonenumber").mask("+7 (999) 999-99-99");
    $("#phonenumber").change(function(){
        var phonenumber = $(this).val().replace(/\+7 \(([0-9]{3})\) ([0-9]{3})\-([0-9]{2})\-([0-9]{2})/ig, "$1$2$3$4");
        $("#phonenumber_format").val(phonenumber);
    });

    // убираем выделение красным некорректных полей
    $('body').on('change', '.alert_element', function () {
        $(this).removeClass('alert_element');
    });
    //согласие на обработку личных данных
    // обработка событий checkbox
    $('.partnership-checkbox').on('click', '.partnership-checkbox-imitate',function () {
        $(this).find('.imitate-check').toggleClass('inactiveCheck');
        if($('.inactiveCheck').length>0){
            $('.partnership-btn').prop('disabled', true);
        } else {
            $('.partnership-btn').prop('disabled', false);
        }
    });
    // закрываем модальное окно
    $('#partnershipModal').on('click', '.close-modal', function () {
        $('.close').click();
    });

});

// функция валидации формы
function validateForm(selector,array) {
    var flag = true;
    $.each(array, function (key, value) {
        if(!value){
            $(selector).find('[data='+key+']').addClass('alert_element');
            flag = false;
        }
    });
    return flag;
}