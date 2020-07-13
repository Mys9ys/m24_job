function ModalClear()
{
    $('#myModal').find('.modal-content, .modal-dialog, .modal-body, .modal-header, .modal-footer').removeAttr('style');
    //$('#myModal').removeAttr('style');
    $('#myModal').find('.modal-body, .modal-header, .modal-footer').html('');
}

function PlayButtonAnimation() {
	var opacity = $('.button_play_video').css("opacity");
	$('.button_play_video').stop().fadeTo(1000, 0.5, function(){
		$('.button_play_video').stop().fadeTo(1000, 1.0, function(){
			// if($('.button_play_video').attr('data-animation') != 'stop') PlayButtonAnimation();
		});
	});
}

function onYouTubeIframeAPIReady() 
{

	$('.button_play_video').show();
	// setTimeout(PlayButtonAnimation(),1000);
	$('.button_play_video').click(function(){
		$(this).attr("data-animation", "stop");
	});
	$('.button_play_video').click(function(){
		ShowYTVideo($(this).attr('data-target'), $(this).attr('data-ytID'));
	});
}

function ShowYTVideo(video, ytID, vidStart)
{

		if(!vidStart){ vidStart = 0;}
            var videoFrame = '<iframe class="modal-video" src="https://www.youtube.com/embed/'+ytID+'?autoplay=1&start='+vidStart+'" frameborder="0" allowfullscreen></iframe>';

        $(document).scrollTop($('#'+video).offset().top - 50);
        $('#myModal').find('.modal-header').hide();
        $('#myModal').find('.modal-footer').hide();
        $('#myModal').find('.modal-body').html(videoFrame);
        $('#myModal').find('.modal-body').css('padding','0');
        $('#myModal').find('.modal-content').css('background-color', 'transparent');
        $('#myModal').find('.modal-content').css('border', '0');
        $('#myModal').find('.modal-content').css('box-shadow', 'none');
        $('#myModal').find('.modal-content').css('text-align', 'center');
        $('#myModal').find('.modal-dialog').css('width', '900px');
        $('#myModal').find('.close').css('font-size', '60px');
        $('#myModal').find('.modal-dialog').css('max-width', 'calc(100% - 20px)');
        $('#myModal').modal('show');
        $('#myModal').on('hidden.bs.modal', function () {
            ModalClear();
            $('#myModal').find('.close').css('font-size', '');
        });
}

function onPlayerReady(e)
{
	//var embedCode = e.target.getVideoEmbedCode();
	e.target.playVideo();
}
function onPlayerStateChange(e)
{
	video = e.target.a.getAttribute('id');
	if(e.data == YT.PlayerState.BUFFERING)
	{
		$('#'+video).parent().stop().css('opacity', '1').show();
	}
	else if(e.data == YT.PlayerState.ENDED || e.data == YT.PlayerState.PAUSED)
	{
		$('#'+video).parent().fadeOut(1000, function(){
			$('#'+video).parent().hide();
		});
	}
}

// Инициализация интерфейса после загрузки контента
$(document).ready(function(){

	// Асинхронная загрузка youtube iframe api
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    if($('#myModal').length != 0)    {
        ModalClear();
    }
});