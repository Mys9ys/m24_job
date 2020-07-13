$(document).ready(function () {
    // запуск видео, с определенной секунды и фиксация просмотра
    $('#section_video_banner').on('click', '.button_play_video', function(){
        ShowYTVideo($(this).attr('data-target'), $(this).attr('data-ytID'), $(this).attr('data-vidStart'));
        var data = {
            verify: true,
            props: 'views',
            id: $(this).attr('data-ytID')
        };
        $.post(
            '/bitrix/components/mainpage/videoreview/ajax/',
            data,
            function () {
            }
        );
    });
});