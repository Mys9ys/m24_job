<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!function_exists("showFilePropertyField")) {
	function showFilePropertyField($name, $property_fields, $values, $max_file_size_show=50000) {
		$res = "";

		if(!is_array($values) || empty($values))
			$values = array(
				"n0" => 0,
			);

		if($property_fields["MULTIPLE"] == "N") {
			$res = "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
		} else {
			$res = '
			<script type="text/javascript">
				function addControl(item)
				{
					var current_name = item.id.split("[")[0],
						current_id = item.id.split("[")[1].replace("[", "").replace("]", ""),
						next_id = parseInt(current_id) + 1;

					var newInput = document.createElement("input");
					newInput.type = "file";
					newInput.name = current_name + "[" + next_id + "]";
					newInput.id = current_name + "[" + next_id + "]";
					newInput.onchange = function() { addControl(this); };

					var br = document.createElement("br");
					var br2 = document.createElement("br");

					BX(item.id).parentNode.appendChild(br);
					BX(item.id).parentNode.appendChild(br2);
					BX(item.id).parentNode.appendChild(newInput);
				}
			</script>
			';

			$res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
			$res .= "<br/><br/>";
			$res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[1]\" id=\"".$name."[1]\" onChange=\"javascript:addControl(this);\"></label>";
		}
		return $res;
	}
}

if(!function_exists("PrintPropsForm")) {
	function PrintPropsForm($arSource = array(), $locationTemplate = ".default") {
		if(!empty($arSource)) {
			foreach($arSource as $arProperties) {?>					
				<div class="property" data-property-id-row="<?=intval(intval($arProperties["ID"]))?>">
					<?if($arProperties["TYPE"] == "CHECKBOX") {?>
						
						<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">
						<div class="label">
							<?=$arProperties["NAME"]?>
							<?if($arProperties["REQUIED_FORMATED"]=="Y"):?>
								<span class="star">*</span>
							<?endif;?>
						</div>
						<div class="block">
							<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>
							<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
								<div class="description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
							<?endif;?>
						</div>
						<div class="clr"></div>
					
					<?} elseif($arProperties["TYPE"] == "TEXT") {?>
						
						<div class="label">
							<?=$arProperties["NAME"]?>
							<?if($arProperties["REQUIED_FORMATED"]=="Y"):?>
								<span class="star">*</span>
							<?endif;?>
						</div>
						<div class="block">
							<input type="text" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" />
							<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
								<div class="description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
							<?endif;?>
						</div>
						<div class="clr"></div>
					
					<?} elseif($arProperties["TYPE"] == "SELECT") {?>
						
						<div class="label">
							<?=$arProperties["NAME"]?>
							<?if($arProperties["REQUIED_FORMATED"]=="Y"):?>
								<span class="star">*</span>
							<?endif;?>
						</div>
						<div class="block">
							<select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
								<?foreach($arProperties["VARIANTS"] as $arVariants):?>
									<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<?endforeach;?>
							</select>
							<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
								<div class="description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
							<?endif;?>
						</div>
						<div class="clr"></div>
					
					<?} elseif($arProperties["TYPE"] == "MULTISELECT") {?>
						
						<div class="label">
							<?=$arProperties["NAME"]?>
							<?if($arProperties["REQUIED_FORMATED"]=="Y"):?>
								<span class="star">*</span>
							<?endif;?>
						</div>
						<div class="block">
							<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
								<?foreach($arProperties["VARIANTS"] as $arVariants):?>
									<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<?endforeach;?>
							</select>
							<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
								<div class="description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
							<?endif;?>
						</div>
						<div class="clr"></div>
					
					<?} elseif($arProperties["TYPE"] == "TEXTAREA") {?>
						
						<div class="label">
							<?=$arProperties["NAME"]?>
							<?if($arProperties["REQUIED_FORMATED"]=="Y"):?>
								<span class="star">*</span>
							<?endif;?>
						</div>
						<div class="block">
							<textarea rows="<?=$arProperties["SIZE2"]?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>
							<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
								<div class="description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
							<?endif;?>
						</div>
						<div class="clr"></div>
					
					<?} elseif($arProperties["TYPE"] == "LOCATION") {?>
						
						<div class="label">
							<?=$arProperties["NAME"]?>
							<?if($arProperties["REQUIED_FORMATED"]=="Y"):?>
								<span class="star">*</span>
							<?endif;?>
						</div>

                        <?global $LOCATION_CITY_NAME?>
                        <div class="block block_city">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="hidden" autocomplete="off" name="ORDER_PROP_6" value="129" class="dropdown-field" id="ORDER_PROP_6" placeholder="Введите название ..."  >
                            <input type="text" autocomplete="off" name="" value="<?if(!empty($_COOKIE['city_search_basket'])) {echo $_COOKIE['city_search_basket'];} else { echo 'г.'.$LOCATION_CITY_NAME;}?>" class="dropdown-field" id="city_search" placeholder="Введите название ..." >
                            <i class="fa fa-times clear_city_search" aria-hidden="true"></i>
                            <div class="search-box">
                                <i class="fa fa-times-circle-o close-btn" aria-hidden="true"></i>
                                <div class="search-content"></div>
                            </div>
                        </div>
                        <style>
                            .search-box{
                                display: none;
                            }
                            .block_city{
                                position: relative;
                                display: inline-block;
                            }
                            #city_search{
                                /*width: 100%;*/
                                padding: 0 20px;
                            }
                            .block_city .fa-search{
                                position: absolute;
                                margin-top: 8px;
                                margin-left: 7px;
                            }
                            .block_city .fa-times {
                                position: absolute;
                                top: 8px;
                                right: 7px;
                                cursor: pointer;
                            }
                            .search-box{
                                width: 100%;
                                position: absolute;
                                right: -10px;
                                /*left: 50%;*/
                                /*transform: translate(-50%);*/
                                margin-top: 2px;
                                background: rgb(255, 255, 255);
                                border: 2px solid rgba(156, 194, 24, 0.3);
                                box-shadow: 0px 2px 8px 0px rgba(40, 40, 40, 0.3);
                                z-index: 1;
                                padding: 10px 10px;}

                            .close-btn{
                                position: absolute;
                                font-size: 18px;
                                top: -6px;
                                right: -6px;
                                background: rgb(255, 255, 255);
                                border-radius: 50%;
                                color: rgba(156, 194, 24, 1);
                                cursor: pointer;
                            }
                            .search-item{
                                padding: 5px;
                            a{
                                font-weight: bold;
                            }

                            }
                            .search-item:nth-child(n+2){
                                border-top: 1px solid rgba(156, 194, 24, 0.3);
                            }
                            .search-item:hover{
                                background: rgba(156, 194, 24, 0.3);
                                cursor: pointer;
                            }
                        </style>
                        <script>
                            $(document).ready(function () {
                                $('.clear_city_search').click(function () {
                                    $(this).parent().find('#city_search').val('');
                                });
                                $('.close-btn').click(function () {
                                    $('.search-box').hide();
                                });
                                $('#city_search').keyup(function () {
                                    var $this = $(this);
                                    var search = $.trim($this.val()).toLowerCase();

                                    $('.search-content').parent().show();
                                    if (search.length > 2) {
                                        var data = {query: search};
                                        $.post(
                                            '/ajax/getCityName.php',
                                            data,
                                            function (result) {
                                            if (result != 'null') {
                                                $('.search-content').children().remove();
                                                $.each(JSON.parse(result), function (index, value) {
                                                    if(value){
                                                        var content = '<div class="search-item">'+ value +'</div>';
                                                        $('.search-content').append(content);
                                                    } else {
                                                        search_not_found();
                                                    }
                                                });
                                            } else {
                                                search_not_found();
                                            }
                                        });
                                    } else {
                                        search_not_found();
                                    }
                                });
                                $('.search-box').on('click', '.search-item', function () {
                                    var city = $(this).text();
                                    $('#city_search').val(city);
                                    $('.search-box').hide();
                                })
                            });

                            function search_not_found() {
                                $('.search-content').children().remove();
                                content = 'По вашему запросу ни чего не найдено';
                                $('.search-content').append('<p>'+content+'</p>');
                            }
                            // Первую букву запроса делаем заглавной и наклоняем для выделения
                            function CapitalReplace(str, item) {
                                if (str.indexOf(item.charAt(0).toUpperCase()) >-1){
                                    item = item.charAt(0).toUpperCase() + item.substr(1);
                                }
                                return str.replace(item, '<i style="color: rgb(156, 194, 24)">'+item+'</i>');
                            }
                        </script>
<!--						<div class="block">-->
<!--							--><?//$value = 0;
//							if(is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0) {
//								foreach($arProperties["VARIANTS"] as $arVariant) {
//									if($arVariant["SELECTED"] == "Y") {
//										$value = $arVariant["ID"];
//										break;
//									}
//								}
//							}
//
//							if(CSaleLocation::isLocationProMigrated()) {
//								$locationTemplateP = $locationTemplate == 'popup' ? 'search' : 'steps';
//								$locationTemplateP = $_REQUEST['PERMANENT_MODE_STEPS'] == 1 ? 'steps' : $locationTemplateP;
//							}
//
//							if($locationTemplateP == 'steps'):?>
<!--								<input type="hidden" id="LOCATION_ALT_PROP_DISPLAY_MANUAL[--><?//=intval($arProperties["ID"])?><!--]" name="LOCATION_ALT_PROP_DISPLAY_MANUAL[--><?//=intval($arProperties["ID"])?><!--]" value="--><?//=($_REQUEST['LOCATION_ALT_PROP_DISPLAY_MANUAL'][intval($arProperties["ID"])] ? '1' : '0')?><!--" />-->
<!--							--><?//endif?>
<!---->
<!--							--><?//CSaleLocation::proxySaleAjaxLocationsComponent(
//								array(
//									"AJAX_CALL" => "N",
//									"COUNTRY_INPUT_NAME" => "COUNTRY",
//									"REGION_INPUT_NAME" => "REGION",
//									"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
//									"CITY_OUT_LOCATION" => "Y",
//									"LOCATION_VALUE" => $value,
//									"ORDER_PROPS_ID" => $arProperties["ID"],
//									"ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
//									"SIZE1" => $arProperties["SIZE1"],
//								),
//								array(
//									"ID" => $value,
//									"CODE" => "",
//									"SHOW_DEFAULT_LOCATIONS" => "Y",
//									"JS_CALLBACK" => "submitFormProxy",
//									"JS_CONTROL_DEFERRED_INIT" => intval($arProperties["ID"]),
//									"JS_CONTROL_GLOBAL_ID" => intval($arProperties["ID"]),
//									"DISABLE_KEYBOARD_INPUT" => 'Y',
//									"PRECACHE_LAST_LEVEL" => "Y",
//									"PRESELECT_TREE_TRUNK" => "Y",
//									"SUPPRESS_ERRORS" => "Y"
//								),
//								$locationTemplateP,
//								true,
//								'location-block-wrapper'
//							)?>
<!--							--><?//if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
<!--								<div class="description">-->
<!--									--><?//=$arProperties["DESCRIPTION"]?>
<!--								</div>-->
<!--							--><?//endif;?>
<!--						</div>-->
						<div class="clr"></div>
					
					<?} elseif($arProperties["TYPE"] == "RADIO") {?>
						
						<div class="label">
							<?=$arProperties["NAME"]?>
							<?if($arProperties["REQUIED_FORMATED"]=="Y"):?>
								<span class="star">*</span>
							<?endif;?>
						</div>
						<div class="block">
							<?if(is_array($arProperties["VARIANTS"])) {
								foreach($arProperties["VARIANTS"] as $arVariants):?>
									<input type="radio" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>" value="<?=$arVariants["VALUE"]?>" <?if($arVariants["CHECKED"] == "Y") echo " checked";?> />
									<label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label>
									</br>
								<?endforeach;
							}?>
							<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
								<div class="description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
							<?endif;?>
						</div>
						<div class="clr"></div>
					
					<?} elseif($arProperties["TYPE"] == "FILE") {?>
						
						<div class="label">
							<?=$arProperties["NAME"]?>
							<?if($arProperties["REQUIED_FORMATED"]=="Y"):?>
								<span class="star">*</span>
							<?endif;?>
						</div>
						<div class="block">
							<?=showFilePropertyField("ORDER_PROP_".$arProperties["ID"], $arProperties, $arProperties["VALUE"], $arProperties["SIZE1"])?>
							<?if(strlen(trim($arProperties["DESCRIPTION"])) > 0):?>
								<div class="description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
							<?endif;?>
						</div>
						<div class="clr"></div>
					
					<?}?>
				</div>
				<?if(CSaleLocation::isLocationProEnabled()):
					$propertyAttributes = array(
						'type' => $arProperties["TYPE"],
						'valueSource' => $arProperties['SOURCE'] == 'DEFAULT' ? 'default' : 'form'
					);
					if(intval($arProperties['IS_ALTERNATE_LOCATION_FOR']))
						$propertyAttributes['isAltLocationFor'] = intval($arProperties['IS_ALTERNATE_LOCATION_FOR']);

					if(intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']))
						$propertyAttributes['altLocationPropId'] = intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']);

					if($arProperties['IS_ZIP'] == 'Y')
						$propertyAttributes['isZip'] = true;?>
					
					<script>
						(window.top.BX || BX).saleOrderAjax.addPropertyDesc(<?=CUtil::PhpToJSObject(array(
							'id' => intval($arProperties["ID"]),
							'attributes' => $propertyAttributes
						))?>);
					</script>
				<?endif;
			}
		}
	}
}?>