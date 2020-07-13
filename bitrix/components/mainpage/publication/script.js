/**
 * Created by user2 on 29.11.2017.
 */
$(document).ready(function () {

    loading = false;
    $(window).scroll(function() {
        if ($('.publication-list').data('pagens')>=$('.publication-list').data('pagen')) {
            if(($(window).scrollTop()+300)>$('.publication-list').height()) {
                if(loading == false) {
                    loading = true;
                    var test = getPublications();
                    console.log('test', test);
                }
            }
        }
    });

});

function getPublications() {
    var data = {
        control: 1,
        pagen: $('.publication-list').data('pagen')+1
    };
    $.post(
        'ajax/',
        data,
        function(result){
            console.log('result', result);
            $.each(JSON.parse(result), function (id, publication) {
                var content = '<img src="'+publication["PREVIEW_PICTURE"]+'" alt="'+publication["name"]+'" />';
                content = '<div class="publication-img-box"><a href="'+publication["DETAIL_PAGE_URL"]+'">'+ content + '</a></div>';
                var content_box = '<a href="'+publication["DETAIL_PAGE_URL"]+'"><div class="publication-title">'+publication["name"]+'</div></a>' +
                    '<div class="publication-text">'+publication["TEXT"]+'</div>' +
                    '<div class="publication-more">' +
                    '<img src="/bitrix/components/mainpage/publication/templates/pub-list/images/img.png" alt="">' +
                    '<div class="publication-views">'+publication["views"]+'</div>' +
                    '<a class="publication-more-link" href="'+publication["DETAIL_PAGE_URL"]+'">Подробнее...</a>' +
                    '</div>';
                content_box = '<div class="publication-content-box">'+content_box+'</div>';
                content = '<div class="publication-item">' + content + content_box +
                    '<div class="clr"></div></div>';
                $('.publication-list').append(content);
            });
        }
    );
    $('.publication-list').data('pagen', $('.publication-list').data('pagen')+1);
    loading = false;
}