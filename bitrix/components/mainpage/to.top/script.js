$(document).ready(function(){
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.block_up').fadeIn(250);
            } else {
                $('.block_up').fadeOut(250);
            }
        });
        $('.block_up').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });
});