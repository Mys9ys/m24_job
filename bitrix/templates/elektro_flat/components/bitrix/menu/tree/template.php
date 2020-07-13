<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult) < 1)
	return;?>

<ul id="left-menu">
	<?$previousLevel = 0;	
	foreach($arResult as $key => $arItem):		
		if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):
			echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		endif;
		if($arItem["IS_PARENT"]):?>
			<li id="id<?=$key?>" class="parent<?if($arItem['SELECTED']):?> selected<?endif?>">
				<a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?><span class="arrow"></span></a>
				<ul class="submenu">			
		<?else:
			if($arItem["PERMISSION"] > "D"):?>
				<li id="id<?=$key?>"<?if($arItem["SELECTED"]):?> class="selected"<?endif?>>
					<a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>
				</li>				
			<?endif;
		endif;
		$previousLevel = $arItem["DEPTH_LEVEL"];		
	endforeach;
	if($previousLevel > 1):
		echo str_repeat("</ul></li>", ($previousLevel-1) );
	endif;?>
</ul>

<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function(){
		$("ul#left-menu > li.parent").hover(function() {
			var uid = $(this).attr("id"),
				pos = $(this).offset(),				
				top = pos.top - 5,
				left = pos.left + $(this).width() + 9;
            			
			eval("timeIn"+uid+" = setTimeout(function(){ $('#'+uid+' > .submenu').show(15).css({'top': top + 'px', 'left': left + 'px'}); }, 200);");
            eval("clearTimeout(timeOut"+uid+")");        
		}, function(){
			var uid = $(this).attr("id");
            
			eval("clearTimeout(timeIn"+uid+")");
			eval("timeOut"+uid+" = setTimeout(function(){ $('#'+uid+' > .submenu').hide(15); }, 200);");
        });
	});
	//]]>
</script>