<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");?>


<div class="order-info basket_personal_info_block">
    <div class="block_basket_title">Укажите данные покупателя</div>
<!--	<div class="order-info_in">-->
<!--		--><?//if(!empty($arResult["ORDER_PROP"]["USER_PROFILES"])) {?>
<!--			<div class="user_profile">-->
<!--				<div class="label">-->
<!--					--><?//if($arParams["ALLOW_NEW_PROFILE"] == "Y"):
//						echo GetMessage("SOA_TEMPL_PROP_CHOOSE");
//					else:
//						echo GetMessage("SOA_TEMPL_EXISTING_PROFILE");
//					endif;?>
<!--				</div>-->
<!--				<div class="block">-->
<!--					--><?//if($arParams["ALLOW_NEW_PROFILE"] == "Y"):?>
<!--						<select name="PROFILE_ID" id="ID_PROFILE_ID" class="selectbox" onChange="SetContact(this.value)">-->
<!--							<option value="0">--><?//=GetMessage("SOA_TEMPL_PROP_NEW_PROFILE")?><!--</option>-->
<!--							--><?//foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles) {?>
<!--								<option value="--><?//= $arUserProfiles["ID"] ?><!--"--><?//if ($arUserProfiles["CHECKED"]=="Y") echo " selected";?><!--><?//=$arUserProfiles["NAME"]?><!--</option>-->
<!--							--><?//}?>
<!--						</select>-->
<!--					--><?//else:
//						if(count($arResult["ORDER_PROP"]["USER_PROFILES"]) == 1) {
//							foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles) {
//								echo "<b>".$arUserProfiles["NAME"]."</b>";?>
<!--								<input type="hidden" name="PROFILE_ID" id="ID_PROFILE_ID" value="--><?//=$arUserProfiles["ID"]?><!--" />-->
<!--							--><?//}
//						} else {?>
<!--							<select name="PROFILE_ID" id="ID_PROFILE_ID" class="selectbox" onChange="SetContact(this.value)">-->
<!--								--><?//foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles) {?>
<!--									<option value="--><?//= $arUserProfiles["ID"] ?><!--"--><?//if ($arUserProfiles["CHECKED"]=="Y") echo " selected";?><!--><?//=$arUserProfiles["NAME"]?><!--</option>-->
<!--								--><?//}?>
<!--							</select>-->
<!--						--><?//}
//					endif;?>
<!--				</div>-->
<!--				<div class="clr"></div>-->
<!--			</div>-->
<!--		--><?//}?>

		<?
//        PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
//		PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
//		PrintPropsForm($arResult["ORDER_PROP"]["RELATED"], $arParams["TEMPLATE_LOCATION"]);
		?>

<!--	</div>-->
    <?//альтернативная форма заполнения?>
    <input class="form_input_basket validate_basket input_basket" data-name="name" type="text" name="ORDER_PROP_1" id="ORDER_PROP_1" value="<?=$_COOKIE['basket_name']?>" placeholder="Ф.И.О.*">
    <input class="form_input_basket validate_basket input_basket" data-name="mail" type="text" name="ORDER_PROP_2" id="ORDER_PROP_2" value="<?=$_COOKIE['basket_mail']?>" placeholder="E-Mail*">
    <input class="form_input_basket validate_basket input_basket phonenumber" data-name="phone" type="text" name="ORDER_PROP_3" value="<?=$_COOKIE['basket_phone']?>" id="ORDER_PROP_3" placeholder="Телефон*">
    <input class="phonenumber_format" type="hidden">
</div>

    <script>
        $(document).ready(function () {
            // валидация номера по маске
            $(".phonenumber").mask("+7 (999) 999-99-99");
            $(".phonenumber").change(function () {
                var phonenumber = $(this).val().replace(/\+7 \(([0-9]{3})\) ([0-9]{3})\-([0-9]{2})\-([0-9]{2})/ig, "$1$2$3$4");
                $("#phonenumber_format").val(phonenumber);
            });
            $('#ORDER_PROP_1').suggestions({
                serviceUrl: "https://dadata.ru/api/v2",
                token: "201f84e5f54961f94507cfa28412e689154eeffa",
                type: "NAME",
                count: 5,
                onSelect: function(suggestion) {}
            });



        });
    </script>
<?if(!CSaleLocation::isLocationProEnabled()):?>
	<div style="display:none;">
		<?$APPLICATION->IncludeComponent("bitrix:sale.ajax.locations", $arParams["TEMPLATE_LOCATION"],
			array(
				"AJAX_CALL" => "N",
				"COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
				"REGION_INPUT_NAME" => "REGION_tmp",
				"CITY_INPUT_NAME" => "tmp",
				"CITY_OUT_LOCATION" => "Y",
				"LOCATION_VALUE" => "",
				"ONCITYCHANGE" => "submitForm()",
			),
			null,
			array('HIDE_ICONS' => 'Y')
		);?>
	</div>
<?endif?>