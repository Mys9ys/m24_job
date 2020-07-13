<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>
<!--noindex-->
<?$catalog_entry = "Каталог товаров";

if(!empty($arResult)):?>
	<ul class="store-horizontal">
		<? //ссылка на главную (КВ)
			/*<li>
				<a href="<?=SITE_DIR?>" <?if($APPLICATION->GetCurPage(true)== SITE_DIR."index.php") echo "class='root-item-selected'";?>><?=GetMessage("MENU_HOME")?></a>
			</li>*/ ?>
		<?$previousLevel = 0;
		foreach($arResult as $arItem):?>

			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

			<?if ($arItem["IS_PARENT"]):?>
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?else:?>
					<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
						<ul>
				<?endif?>
			<?else:?>
				<?if ($arItem["PERMISSION"] > "D"):?>
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<?if($arItem["TEXT"] == $catalog_entry):?>
							<li><a href="<?=$arItem["LINK"]?>" class="catalog_highlighted <?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><i style="color:#fff;margin-right:10px" class="fa fa-align-justify"></i><?=$arItem["TEXT"]?></a>
							</li>
						<?else:?>
							<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
						<?endif?>
					<?else:?>
						<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>
				<?else:?>
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>
				<?endif?>
			<?endif?>

			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
			
		<?endforeach?>

		<?if($previousLevel > 1)://close last item tags?>
			<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
		<?endif?>
	</ul>
<?endif?>
<!--/noindex--> 
