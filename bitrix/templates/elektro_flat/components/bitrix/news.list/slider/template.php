<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;
?>

<script type="text/javascript">
        
        var setupSwipe = function(slider) {
            var time = 1000,
                // allow movement if < 1000 ms (1 sec)
                range = 50,
                // swipe movement of 50 pixels triggers the slider
                x = 0,
                t = 0,
                touch = "ontouchend" in document,
                st = (touch) ? 'touchstart' : 'mousedown',
                mv = (touch) ? 'touchmove' : 'mousemove',
                en = (touch) ? 'touchend' : 'mouseup';

            slider.$window
                .bind(st, function(e) {
                    // prevent image drag (Firefox)
                    e.preventDefault();
                    t = (new Date()).getTime();
                    x = e.originalEvent.touches ? e.originalEvent.touches[0].pageX : e.pageX;
                })
                .bind(en, function(e) {
                    t = 0;
                    x = 0;
                })
                .bind(mv, function(e) {
                    e.preventDefault();
                    var newx = e.originalEvent.touches ? e.originalEvent.touches[0].pageX : e.pageX,
                        r = (x === 0) ? 0 : Math.abs(newx - x),
                        // allow if movement < 1 sec
                        ct = (new Date()).getTime();
                    if (t !== 0 && ct - t < time && r > range) {
                        if (newx < x) {
                            slider.goForward();
                        }
                        if (newx > x) {
                            slider.goBack();
                        }
                        t = 0;
                        x = 0;
                    }
                });
        };

    
	$(document).ready(function() {
		$('.anythingSlider').anythingSlider({
			'theme': "default",
			'mode': 'horiz',
			'expand': true,
			'resizeContents': true,
//			'easing': 'easeOutCirc',
			'buildNavigation': true,
			'buildStartStop': false,
			'hashTags': false,
			'autoPlay': true,
			'pauseOnHover': true,
			'delay': 3000,
                        onInitialized: function(e, slider) {
                            setupSwipe(slider);
                        }
		});
		$(window).resize(function () {
			currentWidth = $('.center').width();
			if(currentWidth < '768') {
				$('.anythingContainer').css({
					'height': currentWidth * 0.36 + 'px'
				});
			} else {
				$('.anythingContainer').removeAttr('style');
			}
		});
		$(window).resize();
	});
        
</script>

<div class="anythingContainer">
	<ul class="anythingSlider">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<li>
				<?if(!empty($arItem["DISPLAY_PROPERTIES"]["URL"])):?>
					<a href="<?=$arItem["DISPLAY_PROPERTIES"]["URL"]["VALUE"]?>" style="background:url(<?=$arItem["PICTURE_PREVIEW"]["SRC"]?>) center center no-repeat; background-size:cover;"></a>
				<?else:?>
					<a href="javascript:void(0)" style="background:url(<?=$arItem["PICTURE_PREVIEW"]["SRC"]?>) center center no-repeat; background-size:cover;"></a>
				<?endif;?>
			</li>
		<?endforeach;?>
	</ul>
</div>