$(document).ready(function () {

    // логотип обычный
    var logo_content = '<a class="logo_block" href="/">' +
       '<img class="logo_img" src="/bitrix/components/mainpage/menu/images/logo/m24_logo.png" alt="">' +
       '</a>';

    // /// логотип на новый год
    // var logo_content = '<a class="logo_block" href="/">' +
    //     '<img class="logo_img" src="/bitrix/components/mainpage/menu/images/logo/logo_new_year2.png" alt="">' +
    //     '</a>';

    // логотип на 23 февраля
    // var logo_content = '<a class="logo_block" href="/">' +
    //     '<img class="logo_img" src="/bitrix/components/mainpage/menu/images/logo/23_feb.png" alt="">' +
    //     '</a>';

    // логотип на 8 марта
    // var logo_content = '<a class="logo_block" href="/">' +
    //     '<img class="logo_img" src="/bitrix/components/mainpage/menu/images/logo/8_march.png" alt="">' +
    //     '</a>';

    var arMenu = JSON.parse(arResult);
    if (screen.width >= 425) {
        /// верхний блок картинки
        var content_pic_row = '';
        $.each(arMenu['header_img'], function (link, text) {
            content_pic_row += '<div class="pic_item"><img class="pic_img" src="/bitrix/components/mainpage/menu/images/' + link + '.png" alt=""><span class="pic_text">' + text + '</span></div>';
        });
        $('.pic_row').html('<div class="pic_wrapper">' + content_pic_row + '</div>');
        // мигание верхнего блока
        var item = 0;
        var autoPlay = 3000;
        setInterval(function () {
            var elem = $('.pic_row').find('.pic_item').eq(item);
            //удаление зелености со старых
            $('.pic_row').find('.pic_item').removeClass('green_title');
            var prev = item - 1;
            if (prev == -1) {
                prev = 3
            }
            $('.pic_row').find('.pic_item').eq(prev).find('.pic_img').attr('src', '/bitrix/components/mainpage/menu/images/pic' + (prev + 1) + '.png');

            // установко зелени на новый элемент
            $(elem).addClass('green_title');
            $(elem).find('.pic_img').attr('src', '/bitrix/components/mainpage/menu/images/pic' + (item + 1) + '_yellow.png');
            item++;
            if (item == 4) {
                item = 0
            }
        }, autoPlay);
    }

    if (screen.width > 768) {
        $('#menuVertical').detach();
        $('.menuVertical_box').detach();
        // блок ссылок
        var content_link_row = '';
        $.each(arMenu['header_link'], function (link, text) {
            content_link_row += '<a class="link_item" href="' + link + '">' + text + '</a>';
        });
        $('.link_row').html('<div class="link_wrapper">' + content_link_row + '</div>');

        $('.module_row').append(logo_content);

        /// блок поиска
        $('.module_row').append($('.search_block').detach());
        $('.search_block').show();

        /// блок с контактами
        var contact_block_content = '<div class="m24_telephone roistat_phone">' +
            '8 800 222-16-90</div>' +
            '<div class="m24_shedule">Ежедневно с 9.00 до 21.00</div>';

        $('.module_row').append('<div class="contact_block">'+contact_block_content+'</div>');
        $('.module_row').find('.contact_block').append($('.chatM24Menu').detach());
        $('.module_row').find('.chatM24Menu').show();
        /// блок - ваш город
        $('.module_row').append($('.geoip_block').detach());
        $('.module_row').find('.geoip_block').show();
        // menu
        var content_menu_btn = '';
        $.each(arMenu['menu_main_btn'], function (btn_link, btn_text) {
            content_menu_btn += '<a class="menu_btn" data-box="'+btn_link+'" href="/catalog/'+btn_link+'/"><span>'+btn_text+'</span></a>';
        });
        $('.menu_button_panel').append(content_menu_btn);
    }

    if (screen.width > 425 && screen.width < 768){
        var icon_mobile_content = '<i class="fa fa-bars btn_menu_min menu_show"></i>';
        icon_mobile_content += logo_content;
        icon_mobile_content += '<div class="panel_btn">' +
            '<i class="fa fa-search btn_menu_min btn_search"></i>' +
            '<a href="/personal/order/make/" class="btn_menu_min" title="Моя корзина" rel="nofollow">' +
            '<i class="fa fa-shopping-cart"></i></a></div>';
        $('.icon_mobile_row').append(icon_mobile_content);
        $('.search_mobile').append($('.search_block').detach());
        $('.icon_mobile_row').on('click', '.btn_search', function () {
            $('.search_mobile').toggle();
        });
    }

    if(screen.width < 768){
        $('.chatM24Menu').detach();
        $('.geoip_block').detach();
        var mobile_contact_content = '';
        mobile_contact_content = '<i class="fa fa-phone-square" aria-hidden="true"></i>' +
            '<a class="phone_number roistat_phone" href="tel:88002221690">8 800 222-16-90</a>' +
            '<div class="worktime">Ежедневно с 9.00 до 21.00</div>';
        $('.mobile_contact_block').append(mobile_contact_content);
    }

    // работа с разрешениями экрана
    if (screen.width < 425) {
        $('.icon_mobile_row').append($('.search_block').detach());
        $('#title-search-input').prop('placeholder', 'Поиск');
        $('#header_search #title-search-input').prop('placeholder', 'Поиск');
        var icon_mobile_content = '';
        icon_mobile_content = '<i class="fa fa-bars btn_menu_min menu_show"></i>';
        icon_mobile_content += logo_content;
        icon_mobile_content +=
            '<a href="/personal/order/make/" class="btn_menu_min btn_menu_basket" title="Моя корзина" rel="nofollow">' +
            '<i class="fa fa-shopping-cart"></i>' +
            '</a>';
        $('.pic_row').append(icon_mobile_content);
        $('.icon_mobile_row').on('click', '.btn_search', function () {
            $('.search_mobile').toggle();
        });

        //выезжающее слева меню
        $('.menu_show').on('click',function () {
            if($('.pic_row').find('.fa-bars').length>0){
                $('.pic_row').find('.fa-bars').addClass('fa-times').removeClass('fa-bars');
            } else {
                $('.pic_row').find('.fa-times').addClass('fa-bars').removeClass('fa-times');
            }
            if ($('#workarea').css('left') == '260px') {
                close_button();
            } else {
                open_menu();
            }
        });
    }

    $('.menu_button_panel').on('mouseenter', '.menu_btn', function () {
        $('.menu_block').find('.active_link').removeClass('active_link');
        var selector = $(this).data('box');
        $('.menu_box').addClass('active_link');
        var $this = $(this);
        $this.addClass('active_link');

        menu_box_fill(arMenu['all'][selector], arMenu['menu_banners'][selector]);
    });


    $('.menu_wrapper').on('mouseleave', function () {
        $('.menu_block').find('.active_link').removeClass('active_link');
        $('.menu_box').hide();
    });




    // заполняем меню для малых разрешений
    if(screen.width < 768){

        var smallMenuBTNContent = '';
        $.each(arMenu['menu_main_btn'], function (section, name) {
            var btn_content_data = '';
            if(arMenu['all'][section]){
                btn_content_data +='<i class="fa fa-angle-right" aria-hidden="true"></i>';
            }
            if(btn_content_data){
                smallMenuBTNContent += '<div class="btn_menu_mobile" data-section="'+section +'">'+ name + btn_content_data +'</div>';
            } else {
                smallMenuBTNContent += '<a class="btn_menu_mobile" href="/catalog/'+section+'/">'+ name + '</a>';
            }
        });
        $('.menu_mobile').append(smallMenuBTNContent);
        var footerMenuLinkContent = '';
        $.each(arMenu['header_link'], function (link, name) {
            footerMenuLinkContent += '<a class="btn_menu_mobile btn_menu_mobile_end" href="'+link+'">'+name+'</a>';
        });
        $('.menu_mobile').append(footerMenuLinkContent);
        $('.menu_mobile').append('<div class="end_row_black"></div>');
        $('.menu_mobile').find('.btn_menu_mobile').on('click', function(){
            var section = $(this).data('section');
            if(section){
                smallMenuFill(arMenu['all'][section]);
            }

            // Показываем меняем картинку при нажатии на треугольник
            $('.menu_mobile_box').find('.links_block_title').on('click', function () {
                $(this).parent().find('.menu_hide_box').toggle();
                if($(this).find('.fa-caret-right').length>0){
                    $(this).find('.fa-caret').remove();
                    $(this).append('<i class="fa fa-caret fa-caret-down" aria-hidden="true"></i>');
                } else {
                    $(this).find('.fa-caret').remove();
                    $(this).append('<i class="fa fa-caret fa-caret-right" aria-hidden="true"></i>');
                }
            });
            $('.menu_mobile_box').find('.back_btn').on('click', function () {
                $('.menu_mobile_box').hide();
            });
        });
        $('.icon_mobile_row').on('click', '.menu_show',function () {
            if($('.icon_mobile_row').find('.fa-bars').length>0){
                $('.icon_mobile_row').find('.fa-bars').addClass('fa-times').removeClass('fa-bars');
            } else {
                $('.icon_mobile_row').find('.fa-times').addClass('fa-bars').removeClass('fa-times');
            }
            $('.menu_mobile').toggle();
            $('.menu_mobile_box').hide();
        });
        // кнопка закрыть
        $('.menu_mobile').on("click", ".close_button", function () {
            if($('.pic_row').find('.fa-bars').length>0){
                $('.pic_row').find('.fa-bars').addClass('fa-times').removeClass('fa-bars');
            } else {
                $('.pic_row').find('.fa-times').addClass('fa-bars').removeClass('fa-times');
            }
            close_button();
        });
    }
});


// заполнение меню
function menu_box_fill(content, img_link){
    $('.menu_box').children().remove();
    $('.menu_box').hide();
    var content_menu_box = '';
    var content_img_link = '';
    if(content){
        $.each(content, function (key, links) {
            var title_block_content = '';
            var panel_content = '';
            var link_item_content = '';
            var count = 1;
            $.each(links, function (link_item, link_text) {
                if(link_item == 1) {
                    title_block_content += '<div class="links_block_title">'+link_text+'</div>';
                } else {
                    if(key == 'brands'){
                        link_item_content += '<a class="link_elem brands_elem" href="'+link_text+'"><img class="brands_img" src="/bitrix/components/mainpage/menu/images/'+link_item+'" alt=""></a>';
                    } else {
                        var class_text = 'link_elem';
                        if(count == 1){
                            class_text = 'link_elem links_block_title';
                        }
                        link_item_content += '<a class="'+class_text+'" href="'+link_item+'">'+link_text+'</a>';
                    }
                }
                count++;
            });
            var links_panel = '<div class="links_panel">';
            if (key == 1) {
                links_panel = '<div class="links_panel main_panel">';
            }
            panel_content += links_panel + title_block_content + link_item_content + '</div>';
            content_menu_box += panel_content;
        });
    }
    if(img_link){
        content_img_link = '<a class="banners_link" href="'+img_link['link']+'"><img class="link_img" src="/bitrix/components/mainpage/menu/images/'+img_link['img']+'" alt=""></a>';
    }
    if(content_menu_box && content_img_link){
        $('.menu_box').append(content_menu_box+content_img_link).show();
    }
}

function smallMenuFill(content) {
    $('.menu_mobile_box').children().remove();
    $('.menu_mobile_box').hide();
    var content_menu_box = '';
    if(content){
        $.each(content, function (key, links) {
            var title_block_content = '';
            var panel_content = '';
            var link_item_content = '';
            var hide_box_content = '';
            var count = 1;
            // console.log('links', links);
            // console.log('links', Object.keys(links).length);
            $.each(links, function (link_item, link_text) {
                // console.log('link_item', link_item);
                if(key == 'brands'){

                } else {
                    hide_box_content = '';
                    if(link_item == 1) {
                        title_block_content += '<div class="links_block_title">'+link_text+'<i class="fa fa-caret fa-caret-right" aria-hidden="true"></i></div>';
                    } else {
                        var class_text = '';
                        if(count == 1){
                            class_text = 'link_elem links_block_title_main';
                        } else {
                            class_text = 'link_elem';
                        }
                        link_item_content += '<a class="'+class_text+'" href="'+link_item+'">'+link_text+'</a>';
                    }
                }
                count++;
            });
            var links_panel = '<div class="links_panel">';
            if (key == 1) {
                links_panel = '<div class="links_panel main_panel">';
                if(link_item_content){
                    hide_box_content += link_item_content;
                }
            } else {
                if(Object.keys(links).length == 1){
                    hide_box_content += link_item_content;
                    // console.log('odin', link_item_content);
                } else {
                    hide_box_content +='<div class="menu_hide_box">'+link_item_content+'</div>';
                }

            }
            panel_content += links_panel + title_block_content + hide_box_content + '</div>';
            // console.log('panel_content',panel_content);
            content_menu_box += panel_content;
        });
    }

    if(content_menu_box){
        $('.menu_mobile_box').append('<div class="back_btn">Назад</div>');
        $('.menu_mobile_box').append(content_menu_box).show();
    }
}

// функция открытия меню
function open_menu() {
    $('.menu_mobile').prepend('<div class="close_button"> Закрыть </div>');
    $('#workarea').css('position', 'relative');
    $('#workarea').animate({left: 260}, 200);
    $('#footer-m24').animate({left: 260}, 200);
    $('.mobile_contact_block').animate({left: 260}, 200);
    $('.pic_row').animate({left: 260}, 200);
    $('.slider_filter_img').animate({left: 260}, 200);
    $('.icon_mobile_row').animate({left: 260}, 200);
    $('#workarea').addClass('left_box_shadow');
    $('.smartfilter').animate({left: 260}, 200);
    $('.module_row').animate({left: 260}, 200);
    $('.menu_mobile').animate({top: 0, left: 0}, 200).show();

}

// функция закрытия меню
function close_button() {
    $('#workarea').animate({left: 0}, 200).removeClass('left_box_shadow');
    $('.menu_mobile').animate({left: 0}, 200);
    $('#footer-m24').animate({left: 0}, 200);
    $('.smartfilter').animate({left: 0}, 200);
    $('.module_row').animate({left: 0}, 200);
    $('.mobile_contact_block').animate({left: 0}, 200);
    $('.pic_row').animate({left: 0}, 200);
    $('.slider_filter_img').animate({left: 0}, 200);
    $('.icon_mobile_row').animate({left: 0}, 200);
    $('.menu_mobile').hide();
    $('.menu_mobile_box').hide();
    $('.close_button').remove();
    $('.back_button').remove();
}