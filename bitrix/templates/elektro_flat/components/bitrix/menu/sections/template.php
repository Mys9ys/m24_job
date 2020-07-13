<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult) < 1)
	return;?>

<ul id="left-menu" style="display:none">
	<?$previousLevel = 0;	
	foreach($arResult as $key => $arItem):		
		if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
			echo str_repeat("</div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		endif;
		if($arItem["DEPTH_LEVEL"] == 1):
			if($arItem["IS_PARENT"]):?>
				<li id="id<?=$key?>" class="parent<?if($arItem["SELECTED"]):?> selected<?endif?>">
					<a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?><span class="arrow"></span></a>
					<div class="catalog-section-childs">
			<?else:?>
				<li id="id<?=$key?>"<?if($arItem["SELECTED"]):?> class="selected"<?endif?>>
					<a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>
				</li>
			<?endif;
		elseif($arItem["DEPTH_LEVEL"] == 2):?>
			<div class="catalog-section-child">
				<a href="<?=$arItem['LINK']?>">
					<span class="child">
						<span class="image">
							<?if(is_array($arItem["PICTURE"])):?>
								<img src="<?=$arItem['PICTURE']['SRC']?>" width="<?=$arItem['PICTURE']['WIDTH']?>" height="<?=$arItem['PICTURE']['HEIGHT']?>" alt="<?=$arItem['TEXT']?>" />
							<?else:?>
								<img src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" width="50" height="50" alt="<?=$arItem['TEXT']?>" />
							<?endif;?>
						</span>
						<span class="text"><?=$arItem["TEXT"]?></span>
					</span>
				</a>
			</div>
		<?else:
			continue;
		endif;
		$previousLevel = $arItem["DEPTH_LEVEL"];		
	endforeach;	
	if($previousLevel > 1):
		echo str_repeat("</div></li>", ($previousLevel-1));
	endif?>
</ul>

<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function(){
		var page_offset = $("#top-menu").offset();
		var left_menu_Y = parseInt(page_offset.top) + parseInt($("#top-menu").outerHeight());
		var left_menu_X = parseInt(page_offset.left)+10;
		$("#left-menu").attr('style', 'position:absolute;background-color: #fff;z-index: 1000;width: 205px;top: '+left_menu_Y+'px;left: '+left_menu_X+'px;display:none;');
		$(window).resize(function() {
			page_offset = $("#top-menu").offset();
			left_menu_Y = parseInt(page_offset.top) + parseInt($("#top-menu").outerHeight());
			left_menu_X = parseInt(page_offset.left)+10;
			$("#left-menu").attr('style', 'position:absolute;background-color: #fff;z-index: 1000;width: 205px;top: '+left_menu_Y+'px;left: '+left_menu_X+'px;display:none;');
		});

		$("#top-menu a[href='/catalog/']").mouseenter(function(){
			$("#left-menu").stop().fadeTo(500, 1, function(){
				$(this).show();
			});
		});
		$("#top-menu a[href='/catalog/']").mouseleave(function() {
			setTimeout(function(){
				if(!$('#left-menu').is(':hover')) {
					$("#left-menu").stop().fadeOut(500, function(){
						$(this).hide();
					});
				}
			},500);
		});
		$("#left-menu").mouseenter(function(){
			$('#left-menu').stop().fadeTo(500, 1, function(){
				$(this).show();
			});
		});
		$("#left-menu").mouseleave(function(){
			setTimeout(function(){
				if(!$('#left-menu').is(':hover') && !$("#top-menu a[href='/catalog/']").is(':hover')) 
				{
					$("#left-menu").stop().fadeOut(500, function(){
						$(this).hide();
					});
				}
			}, 500);
		});

		$("ul#left-menu li.parent").hover(function() {
			var uid = $(this).attr("id"),
				pos = $(this).position(),				
				top = pos.top - 5,
				left = pos.left + $(this).width() + 9;
            			
			eval("timeIn"+uid+" = setTimeout(function(){ $('#'+uid+' > .catalog-section-childs').show(15).css({'top': top + 'px', 'left': left + 'px'}); }, 200);");
            eval("clearTimeout(timeOut"+uid+")");        
		}, function(){
			var uid = $(this).attr("id");
            
			eval("clearTimeout(timeIn"+uid+")");
			eval("timeOut"+uid+" = setTimeout(function(){ $('#'+uid+' > .catalog-section-childs').hide(15); }, 200);");
        });
	});
	//]]>
</script>