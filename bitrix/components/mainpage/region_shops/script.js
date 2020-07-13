$(document).ready(function () {

    // только для раздела региональный магазин
    if (window.location.pathname == '/content/region_shops/') {
        //код на других страницах;
        $('#region_banner_one_shop').owlCarousel({
            singleItem: true,
            lazyLoad: true,
//            autoPlay: autoplayTime, // задано переменной
            mouseDrag: true,
            touchDrag: true,
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
        });
    }

    // только для главной
    if (window.location.pathname == '/'){
        $('#region_banner').owlCarousel({
            singleItem: true,
            lazyLoad: true,
//            autoPlay: autoplayTime, // задано переменной
            mouseDrag: true,
            touchDrag: true,
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
        });
    }
});

