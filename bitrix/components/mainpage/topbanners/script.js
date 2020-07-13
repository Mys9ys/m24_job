/**
 * Created by user2 on 20.11.2017.
 */
$(document).ready(function () {
    // задание переменной для автопрокрутки слайдеров
    var autoplayTime = 3500;
    $('#slider_pay').owlCarousel({
        singleItem: true,
        autoPlay: autoplayTime, // задано переменной
        mouseDrag: true,
        lazyLoad: true,
        lazyFollow: true,
        lazyEffect: "fade",
        touchDrag: true,
        navigation: true,
        navigationText: ["", ""],
    });
    // проставление рейтингов
    $(".rateyo-widg").each(function () {
        var rating = parseInt($(this).data('rating'));
        if(!rating) {rating=0;}
        $(this).rateYo({
            rating: rating,
            starWidth: "18px",
            fullStar: false,
            readOnly: true,
            ratedFill: "#eab629",
            normalFill: "rgb(220, 220, 220)"
        });
    });

    // самописный lazyload
    $(window).on('scroll', function () {
        $.each($(".lazyLoadBanner"), function (item, value) {
            if (($(window).scrollTop() + $(window).height()) >= $(this).offset().top) {
                if ($(this).attr('src') == '/images/loader.jpg') {
                    if(screen.width>1012){
                        $(this).attr('src', $(this).data('win1'));
                        $('.bottom-banner').css('backgroundImage', 'url("/bitrix/components/mainpage/topbanners/images/response.jpg")');
                    }
                    if(screen.width>620 && 1011>screen.width){
                        $(this).attr('src', $(this).data('win2'));
                        $('.bottom-banner').css('backgroundImage', 'url("/bitrix/components/mainpage/topbanners/images/response.jpg")');
                    }
                    if(screen.width>351 && 619>screen.width){
                        $(this).attr('src', $(this).data('win3'));
                    }
                    if(screen.width<350){
                        $(this).attr('src', $(this).data('win4'));
                    }
                }
            }
        });

    });
});