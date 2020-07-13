<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS($templateFolder.'/style_new.css'); ?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.maskedinput.min.js");?>

<?if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y") {
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
		if(strlen($arResult["REDIRECT_URL"]) > 0) {
			$APPLICATION->RestartBuffer();?>
			<script type="text/javascript">
				window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?die();
		}
	}
}

CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));?>

<?if($_SESSION['credit_line']=='Y' && $arResult['credit_line'] == true){
    echo '<div class="CL_checked" style="visibility: hidden;"></div>';
}?>

<a name="order_form"></a>

<div id="order_form_div" class="order-checkout">
	<NOSCRIPT>
		<div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
	</NOSCRIPT>

	<?if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N") {
		
		if(!empty($arResult["ERROR"])) {
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);
		} elseif(!empty($arResult["OK_MESSAGE"])) {
			foreach($arResult["OK_MESSAGE"] as $v)
				echo ShowNote($v);
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
	
	} else {
		
		if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
			if(strlen($arResult["REDIRECT_URL"]) == 0) {
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
			}
		} else {?>
			<script type="text/javascript">
                <?if(CSaleLocation::isLocationProEnabled()):
                $city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();?>

                BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
                    'source' => $this->__component->getPath() . '/get.php',
                    'cityTypeId' => intval($city['ID']),
                    'messages' => array(
                        'otherLocation' => '--- ' . GetMessage('SOA_OTHER_LOCATION'),
                        'moreInfoLocation' => '--- ' . GetMessage('SOA_NOT_SELECTED_ALT'),
                        'notFoundPrompt' => '<div class="-bx-popup-special-prompt">' . GetMessage('SOA_LOCATION_NOT_FOUND') . '.<br />' . GetMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
                                '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
                                '#ANCHOR_END#' => '</a>'
                            )) . '</div>'
                    )
                ))?>);
                <?endif?>

				var BXFormPosting = false;
				function submitForm(val) {
					if(BXFormPosting === true)
						return true;

					BXFormPosting = true;
					if(val != 'Y')
						BX('confirmorder').value = 'N';

					var orderForm = BX('ORDER_FORM');
					BX.showWait();

					<?if(CSaleLocation::isLocationProEnabled()):?>
						BX.saleOrderAjax.cleanUp();
					<?endif?>

					BX.ajax.submit(orderForm, ajaxResult);

					return true;
				}

				function ajaxResult(res) {
					var orderForm = BX('ORDER_FORM');
					try {
						var json = JSON.parse(res);
						BX.closeWait();

						if(json.error) {
							BXFormPosting = false;
							return;
						} else if(json.redirect) {
							window.top.location.href = json.redirect;
						}
					} catch(e) {
						BXFormPosting = false;
						BX('order_form_content').innerHTML = res;

						<?if(CSaleLocation::isLocationProEnabled()):?>
							BX.saleOrderAjax.initDeferredControl();
						<?endif?>
					}

					BX.closeWait();
					BX.onCustomEvent(orderForm, 'onAjaxSuccess');
				}

				function SetContact(profileId) {
					BX("profile_change").value = "Y";
					submitForm();
				}
			</script>
			
			<?if($_POST["is_ajax_post"] != "Y") {?>
				<form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
					<?=bitrix_sessid_post()?>
					<div id="order_form_content" class="myorders">
			<?} else {
				$APPLICATION->RestartBuffer();
			}?>

			<div class="basket_error_message"></div>

<?//			if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y") {
//				foreach($arResult["ERROR"] as $v)
//					echo ShowError($v);?>
<!--				<script type="text/javascript">-->
<!--					top.BX.scrollToNode(top.BX('ORDER_FORM'));-->
<!--				</script>-->
<!--			--><?



            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/address.php");
            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");


//			if($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d") {
//				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
//				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
//			} else {
//				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
//				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
//			}


//                $dbBasketItems = CSaleBasket::GetList(
//                    array(
//                        "NAME" => "ASC",
//                        "ID" => "ASC"
//                    ),
//                    array(
//                        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
//                        "LID" => SITE_ID,
//                        "ORDER_ID" => "NULL"
//                    ),
//                    false,
//                    false,
//                    array()
//                );
//
//                while ($arItems = $dbBasketItems->Fetch())
//                {
//                    $arBasketItems[] = $arItems;
//                }

//            dd($arBasketItems);
//            dd($_POST);
//
//            dd($arResult['BASKET_ITEMS'][0]['ID']);
//            if($arResult['DELIVERY_PRICE']>0){
//                $arFields = array(
//                    "PRICE" => $arResult['BASKET_ITEMS'][0]['PRICE']+$arResult['DELIVERY_PRICE'],
//                );
//                dd(CSaleBasket::Update($arResult['BASKET_ITEMS'][0]['ID'], $arFields));
//            }

//                        dd(CSaleBasket::GetByID($arResult['BASKET_ITEMS'][0]['ID']));
//                        dd(CSaleOrder::GetByID($arResult["ORDER_ID"]));


			if($_POST["is_ajax_post"] != "Y") {?>
					</div>
					<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
					<input type="hidden" name="profile_change" id="profile_change" value="N">
					<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
					<input type="hidden" name="json" value="Y">
					<div align="left">
<!--						<button name="submitbutton" class="btn_buy popdef bt3 confirm_order_btn" value="--><?//=GetMessage('SOA_TEMPL_BUTTON')?><!--">--><?//=GetMessage("SOA_TEMPL_BUTTON")?><!--</button>-->

					</div>
                    <div class="basket_button_confirm">Оформить заказ</div>
				</form>

				<?if($arParams["DELIVERY_NO_AJAX"] == "N") {?>
					<div style="display:none;">
						<?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", 
							array(),
							null,
							array('HIDE_ICONS' => 'Y')
						);?>
					</div>
				<?}
			} else {?>
				<script type="text/javascript">
					top.BX('confirmorder').value = 'Y';
					top.BX('profile_change').value = 'N';
				</script>
				<?die();
			}
		}
	}?>
</div>

<?//dd($arResult)?>



<script>
    $(document).ready(function(){
        cl_data ={};
        cl_data['order_sum'] = $('.validate_opder_price').val();
        flag_basket = true;
        // запись в куки элементов формы при наборе
        $('.input_basket').on('keyup', function () {
            $.cookie('basket_'+$(this).attr('data-name'), $(this).val().trim(), {
                expires: 1,
                path: '/',
            });
        });
        // снимаем выделение с незаполненых элементов прри вводе
        $('.input_basket').on('change', function () {
            $(this).removeClass('alert_element');
        });

        // окрашиваем красным в случаее неправильного ввода ящика
        $('#ORDER_PROP_2').on('change keyup', function () {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
            if(!pattern.test($(this).val())){
                $(this).addClass('alert_element');
            }
        });


        // заполняем способы оплаты
        paySystemFill($('.delivery_item').eq(0).data('paysystem').split(','));

        if($('.CL_checked').length >=1){
            showCLmodal();
        };


        // кнопка выбора доставки
        $('.delivery_item').on('click', function () {
            $('.paysystem_item').removeClass('block_hidden');
            // возвращаем блок адрес
            $.each($('.address_hidden').find('.validate_check'), function (item, value) {
                if($(value).hasClass("validate_basket") == false){
                    $(value).addClass('validate_basket');
                }
            });
            $('.address_hidden').show();

            $('.delivery_item').find('.check_elem_delivery').removeClass('delivery_check_elem_active');
            $(this).find('.check_elem_delivery').addClass('delivery_check_elem_active');
            console.log('$(this).data(\'delivery\')', $(this).data('delivery'));
            $('#DELIVERY_ID').val($(this).data('delivery'));
            paySystemFill($(this).data('paysystem').split(','));
            //для самовывоза
            if($(this).attr('id')== 'delivery_id_2'){
                $.each($('.address_hidden').find('.validate_check'), function (item, value) {
                    $(value).removeClass('validate_basket');
                });
                $('.address_hidden').hide();
            }

        });

        // кнопка выбора платежной системы
        $('.paysystem_block').on('click', '.paysystem_item', function () {
            $('.paysystem_item').find('.check_elem').removeClass('check_elem_active');
            $('.paysystem_item').find('.form_paysystem').remove();
            $(this).find('.check_elem').addClass('check_elem_active');
            $(this).append('<input class="form_paysystem" type="hidden" name="PAY_SYSTEM_ID" value="' + $(this).data('pay') + '">');
            if($(this).attr('id') == 'paysystem_id_315'){
                showCLmodal();
            }
        });

        // валидация элементов формы
        $('.basket_button_confirm').click(function () {
            flag_basket = true;
            $('.basket_error_message').children().remove();
            var validate_items = $('#order_form_div').find('.validate_basket');
            $.each(validate_items, function (i,item) {
                if(!$(item).val().trim()){
                    $(item).addClass('alert_element');
                    flag_basket = false;
                    $('.basket_error_message').append('<div class="alert_message">Заполните поле: '+$(item).attr('placeholder').replace('*', '')+'</div>');
                }
                if($(item).attr('id') == 'ORDER_PROP_2'){
                    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,6}\.)?[a-z]{2,6}$/i;
                    if(!pattern.test($(item).val())){
                        $(this).addClass('alert_element');
                        $('.basket_error_message').append('<div class="alert_message incorrect_mail">E-mail введен неверно</div>');
                        flag_basket = false;
                    }
                }
            });

            // для самовывоза устанавливаем адрес
            if($('.pickup_check').hasClass('validate_basket') == false){
                $('#ORDER_PROP_7').val('Самовывоз');
            }

            // вызов модального окна с кредит-лайном
            if ($('.paysystem_wrap').find('.check_elem_active').parent().parent().find('.form_paysystem').val() == 315) {
                showCLmodal();
            } else {
                // нет ошибок - подтвеждаем заказ
                if (flag_basket == true) {
                    basket_loader();
                    submitForm('Y');
                } else {
                    $('html, body').animate({scrollTop: $('.basket_error_message').offset().top}, 850);
                }
            }
        });

    });

    // отображение и выбор платежных систем
    function paySystemFill(arPayDelivery){
        var arPay = $.parseJSON('<?=json_encode($arResult['PAY_SYSTEM_NEW'])?>');
        var content = '';
        var count = 1;
        // формируем массив с доступными платежными системами
        if(arPayDelivery) {
            $('.paysystem_wrap').children().remove();
            var select_pays = {};
            $.each(arPayDelivery, function (i,value) {
                if(arPay[value]){
                    select_pays[value] = arPay[value];
                }
            });
            arPay = select_pays;
        }

        $.each(arPay, function (i, item) {
            if (count == 1) {
                var check_class = 'check_elem_active';
                var check_input = '<input class="form_paysystem" type="hidden" name="PAY_SYSTEM_ID" value="'+i+'">';
            } else {
                var check_class = '';
                var check_input = '';
            }
            content = content + '<div class="paysystem_item" data-pay="'+i+'" id="paysystem_id_'+i+'">'+
                '            <div class="check_pay_item"><div class="check_elem '+check_class+'"></div></div>'+
                check_input+
                '            <img src="'+item["img"]+'" alt="">'+
                '            <div class="paysystem_info">'+
                '                <div class="name">'+item["NAME"]+'</div>'+
                '                <p>'+item["DESCRIPTION"]+'</p>'+
                '            </div>'+
                '        </div>';
            count++;
        });

        $('.paysystem_wrap').append(content);
    }

</script>

<?$APPLICATION->IncludeComponent("mainpage:credit.line.widget", "",
    Array(),
    false,
    Array()
);?>
<div id="spiner_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
    </div>
</div>
