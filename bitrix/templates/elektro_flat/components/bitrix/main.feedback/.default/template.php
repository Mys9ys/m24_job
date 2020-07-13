<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<script src="/bitrix/templates/elektro_flat/components/bitrix/main.feedback/.default/script.js"></script>

<style>
    .greenopacity{
        background: rgba(38, 109, 0, 0.5)!important;
    }
</style>

<div class="mfeedback">
	<?$frame = $this->createFrame("mfeedback")->begin();
		if(!empty($arResult["ERROR_MESSAGE"])) {
			foreach($arResult["ERROR_MESSAGE"] as $v)
				ShowError($v);
		}
		if(strlen($arResult["OK_MESSAGE"]) > 0) {
			echo $arResult["OK_MESSAGE"];
		}?>

		<form action="<?=$APPLICATION->GetCurPage()?>" method="POST">
		<?=bitrix_sessid_post()?>
			<div class="row">
				<div class="span1">
					<?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
				</div>
				<div class="span2">
					<input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
				</div>
				<div class="clr"></div>
			</div>
			<div class="row">
				<div class="span1">
					<?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
				</div>
				<div class="span2">
					<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
				</div>
				<div class="clr"></div>
			</div>
			<div class="row">
				<div class="span1">
					<?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
				</div>
				<div class="span2">
					<textarea name="MESSAGE" rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea>
				</div>
				<div class="clr"></div>
			</div>
			<?if($arParams["USE_CAPTCHA"] == "Y"):?>
				<div class="row">
					<div class="span1">
						<?=GetMessage("MFT_CAPTCHA")?><span class="mf-req">*</span>
					</div>
					<div class="span2">
						<input type="text" name="captcha_word" size="30" maxlength="50" value="" />
						<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>" />						
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="127" height="30" alt="CAPTCHA" />
					</div>
					<div class="clr"></div>
				</div>
			<?endif;?>
            <div style="font-size:1.0em;text-align:center;padding:10px;">
                <input style="transform:scale(1.5);" class="cp-policy-field-agree" type="checkbox" data-target="#button_order_main" checked>
                <span style="font-weight:700; color:#8184a1;"><?=GetMessage("MFT_assept")?></span><br>
                <a href="/personaldata/agree.php" target="_blank" style="color: red;"><?=GetMessage("MFT_link")?></a>
            </div>
            <div class="submit">
				<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
				<button type="submit" name="submit" class="btn_buy popdef" value="<?=GetMessage("MFT_SUBMIT")?>"><?=GetMessage("MFT_SUBMIT")?></button>
			</div>
		</form>
	<?$frame->end();?>
	<div class="clr"></div>
</div>