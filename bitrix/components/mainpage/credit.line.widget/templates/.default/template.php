<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/m24/credit.line.widget/style.css');?>
<? $APPLICATION->AddHeadScript("/bitrix/components/m24/credit.line.widget/script.js"); ?>


<div id="cl-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">


		<div class="hc-contacts">
			<div>8 800 222-16-90</div>
			<div>info@massagery24.ru</div>
		</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
        <h4 class="hc-header">Заявка на рассрочку</h4>

		<input type="hidden" class="cl-field-summ-base" name="cl-field-summ-base" value="">
		<input type="hidden" name="cl-field-product-id" value="">
		<input type="hidden" name="cl-field-product-name" value="">
<!--        <input class="phonenumber_format" type="hidden">-->
		<div class="row">
			<div class="col-sm-6">
				<div class="input-group">
					<div class="input-group-addon">Я хочу взять рассрочку</div>
					<input type="text" class="form-control cl-field-summ-total" name="cl-field-summ-total">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
					<div class="input-group-addon">Ежемесячный платеж</div>
					<input type="text" class="form-control cl-field-payment-monthly" name="cl-field-payment-monthly">
				</div>
			</div>
		</div>
		<div class="row" style="overflow:visible;border-bottom:1px solid #ccc;border-top: 1px solid #ccc;padding-top:10px;">
			<div class="col-sm-3">
				<span class="slider_addon">Срок рассрочки</span>
			</div>
			<div class="col-sm-6">
				<input id="slider_length" class="cl-field-payment-length cl_range" type="range" min="1" step="1" max="12"  value="12"  name="cl-field-payment-length">
			</div>
			<div class="col-sm-3">
				<span class="slider_addon"><span id="slider_length_text">12</span> мес</span>
			</div>
		</div>
		<div class="row" style="overflow:visible;border-bottom:1px solid #ccc;margin-bottom:10px;padding-top:10px;">
			<div class="col-sm-3">
				<span class="slider_addon">Первоначальный платеж</span>
			</div>
			<div class="col-sm-6">
				<input id="slider_initial" class="cl-field-payment-initial cl_range" type="range" min="0" step="10" max="50"  value="0" name="cl-field-payment-initial">
			</div>
			<div class="col-sm-3">
				<span class="slider_addon"><span id="slider_initial_text">0</span> %</span>
			</div>
		</div>
		<div class="row" style="overflow:visible;">
			<div class="col-sm-12">
				<div class="input-group">
					<div class="input-group-addon">ФИО<span class="f-required">*</span></div>
					<input type="text" class="form-control cl-field-client-fullname" name="cl-field-client-fullname" value="<?=$arResult['fullname']?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="input-group">
					<div class="input-group-addon">Телефон конт.<span class="f-required">*</span></div>
					<input type="text" class="form-control cl-field-client-mobile" name="cl-field-client-mobile" value="<?=$arResult['phone']?>">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
					<div class="input-group-addon">E-mail<span class="f-required">*</span></div>
					<input type="text" class="form-control cl-field-client-email" name="cl-field-client-email" value="<?=$arResult['email']?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="input-group">
					<div class="input-group-addon">Телефон доп.</div>
					<input type="text" class="form-control cl-field-client-phone" name="cl-field-client-phone">
				</div>
			</div>
			<div class="col-sm-6">
				<div style="padding-top:7px;">
					<input type="checkbox" class="cl-field-client-age18" style="width: 20px;height:20px;margin:0;float:left;margin-left:12px;" name="cl-field-client-age18">
					<div style="display:inline-block;line-height:20px;padding-left:10px;font-size:12px;">Мне исполнилось 18 лет<span class="f-required">*</span></div>
				</div>
			</div>
		</div>
		
		<div class="row" style="overflow:visible;">
			<div class="col-sm-12">
				<div class="input-group">
					<div class="input-group-addon" style="text-align:left;">Адрес<span class="f-required">*</span></div>
					<input type="text" class="form-control cl-field-client-address" name="cl-field-client-address">
				</div>
			</div>
		</div>
		<!--<div class="row">
			<div class="col-sm-4">
				<div class="input-group-addon" style="text-align:left;">Стаж работы в организации</div>
			</div>
			<div class="col-sm-3">
				<div class="input-group">
					<input type="text" class="form-control" name="cl-field-experience-years" style="max-width:50px">
					<div style="display:inline-block;line-height:34px;padding-left:10px;font-size:12px;">лет</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="input-group">
					<input type="text" class="form-control" name="cl-field-experience-months" style="max-width:50px">
					<div style="display:inline-block;line-height:34px;padding-left:10px;font-size:12px;">мес</div>
				</div>
			</div>
		</div>-->
		<div class="row">
			<div class="col-sm-12">
				<div style="padding-top:7px;">
					<input type="checkbox" style="width: 20px;height:20px;margin:0;float:left;margin-left:12px;" name="cl-field-client-agree">
					<div style="display:inline-block;line-height:20px;padding-left:10px;font-size:12px;">Я даю согласие на обработку моих персональных данных <span class="f-required">*</span></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 cl-error-message"></div>
		</div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default button_hc_send" disabled>Оформить заявку</button>
		<div class="bank_icon" style="width:100%;text-align:center;overflow:hidden;">
            <img src="/bitrix/components/mainpage/credit.line.widget/image/alfabank.png" alt="">
            <img src="/bitrix/components/mainpage/credit.line.widget/image/home.png" alt="">
            <img src="/bitrix/components/mainpage/credit.line.widget/image/kredit_evro.png" alt="">
            <img src="/bitrix/components/mainpage/credit.line.widget/image/opt.png" alt="">
            <img src="/bitrix/components/mainpage/credit.line.widget/image/pochta-bank.png" alt="">
            <img src="/bitrix/components/mainpage/credit.line.widget/image/renessans.png" alt="">
            <img src="/bitrix/components/mainpage/credit.line.widget/image/paylate.png" alt="">
		</div>
      </div>
    </div>
  </div>
</div>
<link href="https://dadata.ru/static/css/lib/suggestions-15.6.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="https://dadata.ru/static/js/lib/jquery.suggestions-15.6.min.js"></script>
<script>
$(document).ready(function(){

    $('#slider_length').on('change', function () {
        $("#slider_length_text").text($(this).val());
        var base = $('#cl-modal input[name="cl-field-summ-base"]').val();
        var pMonthly = $('#cl-modal input[name="cl-field-payment-monthly"]').val();
        var pInitial = $('#cl-modal input[name="cl-field-payment-initial"]').val();
        var pLength = $('#cl-modal input[name="cl-field-payment-length"]').val();

        var pTotal = Math.ceil(base - (base * pInitial*0.01));
        var pMonthly = Math.ceil((base - (base * pInitial*0.01)) / pLength);

        $('#cl-modal input[name="cl-field-summ-total"]').val(pTotal);
        $('#cl-modal input[name="cl-field-payment-monthly"]').val(pMonthly);
        // console.log('change');

    });

    $('#slider_initial').on('change', function () {
        $("#slider_initial_text").text($(this).val());
        var base = $('#cl-modal input[name="cl-field-summ-base"]').val();
        var pMonthly = $('#cl-modal input[name="cl-field-payment-monthly"]').val();
        var pInitial = $('#cl-modal input[name="cl-field-payment-initial"]').val();
        var pLength = $('#cl-modal input[name="cl-field-payment-length"]').val();

        var pTotal = Math.ceil(base - (base * pInitial*0.01));
        var pMonthly = Math.ceil((base - (base * pInitial*0.01)) / pLength);

        $('#cl-modal input[name="cl-field-summ-total"]').val(pTotal);
        $('#cl-modal input[name="cl-field-payment-monthly"]').val(pMonthly);
        // console.log('change');

    });


	$('.button_cl_widget').on('click', function(){

	});
	$('.button_hc_send').on('click', function(){
		var pElem = $('#cl-modal');
		var pBase = $('#cl-modal input[name="cl-field-summ-base"]').val();
		var pInitial = $('#cl-modal input[name="cl-field-payment-initial"]').val();
		var pLength = $('#cl-modal input[name="cl-field-payment-length"]').val();
		var pInitialAmount = Math.floor(pBase * pInitial *0.01);


		
		var formData = {};
        if($('.product_item').length>1){
            dataOne = [];
            $.each($('.product_item'), function (i, value) {
                dataOne.push($(this).data());
            });
            formData = {
                credit_line: {
                    client: {
                        phone: pElem.find('input[name="cl-field-client-mobile"]').val(),
                        fullname: pElem.find('input[name="cl-field-client-fullname"]').val(),
                        email: pElem.find('input[name="cl-field-client-email"]').val(),
                        extPhone: pElem.find('input[name="cl-field-client-phone"]').val(),
                        address: pElem.find('input[name="cl-field-client-address"]').val()
                    },
                    products: dataOne,
                    payment: {
                        initial: pInitialAmount,
                        duration: parseInt(pLength, 10),
                        discount: 14
                    }
                }
            };
        } else {
            formData = {
                credit_line: {
                    client: {
                        phone: pElem.find('input[name="cl-field-client-mobile"]').val(),
                        fullname: pElem.find('input[name="cl-field-client-fullname"]').val(),
                        email: pElem.find('input[name="cl-field-client-email"]').val(),
                        extPhone: pElem.find('input[name="cl-field-client-phone"]').val(),
                        address: pElem.find('input[name="cl-field-client-address"]').val()
                    },
                    products: $('.product_item').data(),
                    payment: {
                        initial: pInitialAmount,
                        duration: parseInt(pLength, 10),
                        discount: 14
                    }
                }
            };
        }

		console.log('formData', formData);
        basket_loader();
		$.post('/api/credit_line_gate/api/set_order/', formData, function(data){
		// $.post('/api/test/', formData, function(data){
			if(data.status == 'OK') 
			{
				$('#cl-modal .modal-footer').html('');
				$('#cl-modal .modal-body').html('<div style="text-align:center;font-size:16px;">Ваша заявка принята<br>Ожидайте звонка менеджера</div>');
				// костыль, закрывающий текущую корзину от дальнейших манипуляций, после заказа рассрочки
				var arData = {
                    operation: 'ordered',
				    name:formData.credit_line.client.fullname,
                    mail:formData.credit_line.client.email,
                    phone:formData.credit_line.client.phone,
                    all_address:formData.credit_line.client.address,
                    order_price: $('.validate_opder_price').val(),
                    PRICE_DELIVERY: $('.basket_delivery_price').data('delivery_price'),
                    DELIVERY_ID: $('#DELIVERY_ID').val(),
                };
				console.log('arData',arData);
                $('#spiner_modal').modal('hide');
                $.post(
                    '/bitrix/templates/elektro_flat_copy/components/bitrix/sale.order.ajax/new/ajax/',
                    arData,
                    function (result) {
                        $('.title_name').text('Моя корзина');
                        $('#order_form_div').children().remove();
                        $('#order_form_div').append(
                            '<div class="cart-notetext">В вашей корзине ещё нет товаров.</div>' +
                            '<a href="/" class="btn_repeat_buy bt3">Начать покупки</a>'
                        );
                    }
                );
			}
			else if(data.status == 'ERROR')
			{
				$('#cl-modal .cl-error-message').html(data.error[0]);
			}
			else
			{
				$('#cl-modal .cl-error-message').html('Неизвестная ошибка');
			}
		}, 'json');
		
	});

});
function showCLmodal(){

    var validate_items = $('#order_form_div').find('.validate_basket');

    $.each(validate_items, function (i, item) {
        cl_data[$(item).data('name')] = $(item).val();
    });


    $('.cl-field-client-fullname').val(cl_data['name']);
    $('.cl-field-client-mobile').val(cl_data['phone']);
    $('.cl-field-client-email').val(cl_data['mail']);
    $('.cl-field-summ-base').val(cl_data['order_sum']);


    console.log('base', $('.cl-field-summ-base').val());

    $('#cl-modal input[name="cl-field-summ-total"]').val($(this).data('price'));
    $('#cl-modal input[name="cl-field-payment-monthly"]').val(Math.ceil($(this).data('price')/12));

    $('#cl-modal input[name="cl-field-client-mobile"]').mask("+7 (999) 999-99-99");
    // $('#cl-modal input[name="cl-field-client-mobile"]').change(function () {
    //     var phonenumber = $(this).val().replace(/\+7 \(([0-9]{3})\) ([0-9]{3})\-([0-9]{2})\-([0-9]{2})/ig, "$1$2$3$4");
    //     $("#phonenumber_format").val(phonenumber);
    // });
    $('#cl-modal input[name="cl-field-client-phone"]').mask("+7 (999) 999-99-99");

    $('#cl-modal input[name="cl-field-client-fullname"]').suggestions({
        serviceUrl: "https://dadata.ru/api/v2",
        token: "201f84e5f54961f94507cfa28412e689154eeffa",
        type: "NAME",
        count: 5,
        onSelect: function(suggestion) {}
    });
    $('#cl-modal input[name="cl-field-client-address"]').suggestions({
        serviceUrl: "https://dadata.ru/api/v2",
        token: "201f84e5f54961f94507cfa28412e689154eeffa",
        type: "ADDRESS",
        count: 5,
        onSelect: function(suggestion) {}
    });

    function calcChanges(){
        if(
            $('#cl-modal input[name="cl-field-client-age18"]').prop('checked') &&
            $('#cl-modal input[name="cl-field-client-fullname"]').val() != '' &&
            $('#cl-modal input[name="cl-field-client-email"]').val() != '' &&
            $('#cl-modal input[name="cl-field-client-mobile"]').val() != '' &&
            $('#cl-modal input[name="cl-field-client-address"]').val() != '' &&
            $('#cl-modal input[name="cl-field-client-agree"]').prop('checked')
        )
        {
            $('.button_hc_send').prop('disabled', false);
        }
        else
        {
            $('.button_hc_send').prop('disabled', true);
        }
    }

    $('#cl-modal input[name="cl-field-client-age18"], '+
        '#cl-modal input[name="cl-field-client-fullname"], '+
        '#cl-modal input[name="cl-field-client-email"], '+
        '#cl-modal input[name="cl-field-client-mobile"], '+
        '#cl-modal input[name="cl-field-client-address"], '+
        '#cl-modal input[name="cl-field-client-agree"]').change(calcChanges);

    $('#cl-modal').modal('show');





    var base = $('#cl-modal input[name="cl-field-summ-base"]').val();
    var pMonthly = $('#cl-modal input[name="cl-field-payment-monthly"]').val();
    var pInitial = $('#cl-modal input[name="cl-field-payment-initial"]').val();
    var pLength = $('#cl-modal input[name="cl-field-payment-length"]').val();
    var pTotal = Math.ceil(base - (base * pInitial*0.01));
    var pMonthly = Math.ceil((base - (base * pInitial*0.01)) / pLength);

    $('#cl-modal input[name="cl-field-summ-total"]').val(pTotal);
    $('#cl-modal input[name="cl-field-payment-monthly"]').val(pMonthly);
    $('.cl-field-payment-monthly').val(Math.ceil((cl_data['order_sum'] - (cl_data['order_sum'] * pInitial*0.01)) / pLength));
    $('#cl-modal').modal('show');
}
</script>
<style>
    input:focus, button:focus{
        outline: none;
    }
    #cl-modal{
        /*display: none;*/
    }
    .modal-content{
        border-radius: 15px!important;
        overflow: hidden;
    }
#cl-modal .modal-header
{

	background-color:rgb(156, 194, 24);
	padding:0;
	height:55px;
	background-repeat: no-repeat;
    background-position: right;
}
#cl-modal .close
{
	font-size: 30px;
    margin-top: 1px;
    margin-right: 5px;
    color: #fff;
    opacity: 0.7;
}
#cl-modal .hc-logo 
{
	vertical-align:top;
}
#cl-modal .hc-contacts
{
	display:inline-block;
	vertical-align:top;
	height:49px;
	margin-top:3px;
	margin-bottom:3px;
	font-size:16px;
	color:#fff;
	padding: 2px 10px;
}
#cl-modal .modal-content
{
	border-radius:0;
	border:0;
}
#cl-modal .hc-header
{
	margin: 10px 5px 20px 5px;
	text-transform:uppercase;
	text-align: center;
	font-size:16px;
}
#cl-modal .modal-body
{
	color:#000 !important;
}
#cl-modal .input-group-addon
{
	font-size:12px;
	border:0;
	background-color:transparent;
	color:#000;
}
#cl-modal input.form-control, #cl-modal select.form-control
{
	font-size:12px;
	border-radius:0;
	background-color:#ebebeb;
	border:0;
	box-shadow:none;
}
#cl-modal .col-sm-6, #cl-modal .col-sm-12, #cl-modal .col-sm-4, #cl-modal .col-sm-3
{
	margin-bottom:10px;
}
#cl-modal input[type="checkbox"]
{
	width:20px;
	height:20px;
}
#cl-modal .button_hc_send
{
	text-transform:uppercase;
	color:#fff;
	background-color:rgb(234, 182, 41);
	border:0;
	border-radius:10px;
	/*width:120px;*/
}
#cl-modal .modal-footer
{
	border-top:0;
	margin-right:15px;
}
#cl-modal .slider_addon
{
	font-size:12px;
	padding-left:12px;
	padding-right:12px;
	display:inline-block;
}
#cl-modal .slider-selection, #cl-modal .slider-track
{
	border-radius:0;
}
.cl_range{
    -webkit-appearance: none;
    background-color:rgba(156, 194, 24, 0.7);
    height: 14px;
    margin-top:3px;
}
.cl_range::-webkit-slider-thumb{
    -webkit-appearance: none;
    background-color:rgba(156, 194, 24, 1);
    width: 20px;
    height: 20px;
}

#cl-modal .slider-selection
{

}
#cl-modal .slider.slider-horizontal
{
	width:100%;
}
#cl-modal .min-slider-handle
{
	border: 1px solid #900;
	cursor:pointer;
}
#cl-modal .cl-error-message
{
	color:#c00;
}
    .bank_icon{
        display: inline-block;
        margin-top: 1em;
    }
    .bank_icon img{
        width: 13.5%;
    }
</style>