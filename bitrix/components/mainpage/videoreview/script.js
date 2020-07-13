$(document).ready(function () {
    //если товаров больше 3х прячем остальные и вызываем при нажатии кнопки
    $('.video_review_box').on('click', '.all_video_products', function () {
        $(this).parent().find('.video_products_unvis').show();
        $(this).parent().addClass('video_products_hidden');
        $(this).text('скрыть');
        $(this).addClass('close_video_products');
        $(this).removeClass('all_video_products')

    });
    $('.video_review_box').on('click', '.close_video_products', function () {
        $(this).parent().find('.video_products_unvis').hide();
        $(this).parent().removeClass('video_products_hidden');
        $(this).text('еще +');
        $(this).removeClass('close_video_products');
        $(this).addClass('all_video_products');
    });

    //если тегов больше 6х прячем остальные и вызываем при нажатии кнопки
    $('.video_review_box').on('click', '.all_video_tags', function () {
        $(this).parent().find('.video_tags_unvis').show();
        $(this).parent().addClass('video_tags_hidden');
        $(this).text('скрыть');
        $(this).addClass('close_video_tags');
        $(this).removeClass('all_video_tags')

    });
    $('.video_review_box').on('click', '.close_video_tags', function () {
        $(this).parent().find('.video_tags_unvis').hide();
        $(this).parent().removeClass('video_tags_hidden');
        $(this).text('еще теги');
        $(this).removeClass('close_video_tags');
        $(this).addClass('all_video_tags');
    });

    pagen = '';
    // запуск видео, с определенной секунды
    $('.video_review_box').on('click', '.button_play_video', function(){
        ShowYTVideo($(this).attr('data-target'), $(this).attr('data-ytID'), $(this).attr('data-vidStart'));
        var data = {
            verify: true,
            props: 'views',
            id: $(this).attr('data-ytID')
        };
        console.log('data', data);
        $.post(
            '/bitrix/components/mainpage/videoreview/ajax/',
            data,
            function () {

            }
        );
    });

    //выводим кнопки подгрузки, если не все еще на экране
    var pagenAll = $('.ajax_get_vids_all').attr('data-pagen');
    var pagenMaxAll = $('.ajax_get_vids_all').attr('data-pagemax');
    var pagenBlogs = $('.ajax_get_vids_blogs').attr('data-pagen');
    var pagenMaxBlogs = $('.ajax_get_vids_blogs').attr('data-pagemax');
    pagenControls(pagenAll, pagenMaxAll, '.ajax_get_vids_all');
    pagenControls(pagenBlogs, pagenMaxBlogs, '.ajax_get_vids_blogs');


    // инициируем загрузку карточек с видео
    $('.ajax_get_vids').on('click', '.get_vids_button', function () {
        $(this).remove();
        var selector = $(this).attr('data-selector');
        var pagenMax = $(selector).attr('data-pagemax');
        if(!pagen) {
           var pagen = $(selector).attr('data-pagen');
        }
        var data = {
            verify: true,
            selector: selector,
            pagen: ++pagen,
        };


       $.post(
           '/bitrix/components/mainpage/videoreview/ajax/',
           data,
           function(result){
               $.each(JSON.parse(result), function (id, item) {
                   $(selector+'_box').append(getVidsCardAjax(item));
               });
           }
       );
        pagenControls(pagen,pagenMax,selector);
    });

    // работа с поиском
    $('.search_vids_input').on('keyup', function () {
        var $this = $(this);
        var search = $.trim($this.val()).toLowerCase();
        $('.vids_search_result').show();
        if(search.length>2) {
            var data = {request: search, verify:true};
            $.post(
                '/bitrix/components/mainpage/videoreview/ajax/',
                data,
                function(result){
                    if(result != 'null') {
                        $('.vids_search_result_box').children().remove();
                        var count = 0;
                        $.each(JSON.parse(result), function (index, value) {
                            if (++count == 11) return false;

                            var questText = CapitalReplace(value,String(search));
                            content = '<div class="search_item">'+
                                '<a class="search_link" href="/content/video_review/?tag='+value+'">'+questText+'</a>';
                                '</div>';
                            $('.vids_search_result_box').append(content);
                        });
                        if (count>4){content = '<div class="search_item search_link_all"><a href="/content/video_review/?tag='+search+'">Все видео по запросу: <i>'+search+'</i></a></div>';
                            $('.vids_search_result_box').append(content);}
                    } else {
                        search_not_found();
                    }
                }
            );
        } else {
            search_not_found();
        }
    });
    $('.vids_search_result_close').click(function () {
        $(this).parent().hide();
    })

});
// контролируем пагинацию и кнопку загрузки
function pagenControls(pagen, pagenMax, selector) {
    if(pagen<pagenMax){
        $(selector).attr('data-pagen',pagen);
        $(selector).append('<div class="get_vids_button" data-selector="'+selector+'">Показать еще видео</div>');
    }
}
// заполнение карточки видео
function getVidsCardAjax(item) {
    var tags ='', tags_count = 1, tags_unvis ='', all_tags_btn='';
    $.each(item['tags'], function (id, item) {
        if (tags_count>5){
            tags_unvis = 'video_tags_unvis';
            all_tags_btn = '<div class="video_tags_btn all_video_tags">еще теги</div>';
        }
        tags = tags + ' <a class="tags_item '+tags_unvis+'" href="/content/video_review/?tag='+item+'">#'+item+'</a>';
        tags_count++;
    });
    tags = tags + all_tags_btn;
    var products = '', products_count = 1, products_unvis ='', all_products_btn='';
    $.each(item['products'], function (id, item) {
        if (products_count>3){
            products_unvis = 'video_products_unvis';
            all_products_btn = '<div class="video_products_btn all_video_products">еще +</div>';
        }
        products = products + '<a class="'+products_unvis+'" href="'+item['link']+'"><img src="'+item['img']+'" title="'+item['name']+'"></a>';
        products_count++;
    });
    products = products + all_products_btn;
    content = '<div class="video_all_box">' +
        '                    <div class="video_title">'+item["NAME"]+'</div>' +
        '                    <div class="panel_video" id="video_all'+item["ID"]+'">' +
        '                        <img src="'+item["Pict"]+'" alt="">' +
        '                        <div class="button_play_video video-button" data-ytID="'+item["vidID"]+'" data-target="video_all'+item["ID"]+'" data-vidStart="'+item["timeStart"]+'"><i class="fa fa-youtube-play" aria-hidden="true"></i></div>' +
        '                    </div>' +
        '                    <div class="video_tags">' +
        '                        <span>Теги: </span>' +
                             tags+
        '                    </div>' +
        '                    <div class="video_products">' +
        '                        <span>Продукция: </span>' +
                             products+
        '                    </div>' +
        '                </div>';
    return content
}

function search_not_found() {
    $('.vids_search_result_box').children().remove();
    content = 'По вашему запросу ни чего не найдено';
    $('.vids_search_result_box').append('<p>'+content+'</p>');
}
// Первую букву запроса делаем заглавной и наклоняем для выделения
function CapitalReplace(str, item) {
    if (str.indexOf(item.charAt(0).toUpperCase()) >-1){
        item = item.charAt(0).toUpperCase() + item.substr(1);
    }
    return str.replace(item, '<i style="color: rgb(156, 194, 24)">'+item+'</i>');
}
