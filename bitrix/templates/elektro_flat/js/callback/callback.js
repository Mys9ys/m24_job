class GRCB{constructor(grcbWrapper){this.time=30;window.grcb_pos=0;var grcbWidget=document.createElement('div');var grcbForm=document.createElement('div');grcbWidget.className='grcb_widget active';grcbForm.className='grcb_form';grcbForm.innerHTML='<div class="grcb_hint" style="top:-78px;height:3em;background-color:rgb(104, 213, 255);text-transform:uppercase;">Заказ обратного звонка</div><div class="grcb_hint" style="top: -55px;"><div style="float:left;margin-top:8px;margin-left:10px;"><input class="grcb-policy" type="checkbox" checked></div>Даю <a style="color:#333;text-decoration:underline;" href="/personaldata/agree.php" target="_blank">согласие</a> на обработку <a style="color:#333;text-decoration:underline;" href="/personaldata/" target="_blank">персональных данных</a></div><input class="grcb_field grcb-phone" type="text" name="grcb-phone" value="" placeholder="+7 (999) 999-99-99"><input class="grcb_field grcb-name" type="text" name="grcb-name" value="" placeholder="Ваше имя"><button class="btn btn-primary grcb_makecall" onClick="ga(\'send\', \'event\', \'Knopka\', \'callback_m24\'); ym(50949848, \'reachGoal\', \'callback_m24\'); return true;"><i class="fa fa-phone"></i></button><div class="close" style="position: absolute;top: -15px;right: -5px;color: #fff;font-size: 30px;width: 30px;height: 30px;line-height: 25px;text-align: center;border-radius: 50%;border: 1px solid #555;    box-shadow: 0 0 15px #000;opacity: 0.8;background-color:rgba(0, 175, 242, 1);">×</div>';grcbForm.getElementsByClassName('close')[0].addEventListener('click',function(){var grcbWidget=document.getElementsByClassName('grcb_widget')[0];var grcbForm=document.getElementsByClassName('grcb_form')[0];grcbWidget.style.display='block';grcbWidget.className='grcb_widget active';grcbForm.className='grcb_form collapse'});grcbForm.getElementsByClassName('grcb-policy')[0].addEventListener('change',function(){if(!this.checked){$(grcbForm).find('.grcb_field, .grcb_makecall').prop('disabled',!0)}else{$(grcbForm).find('.grcb_field, .grcb_makecall').prop('disabled',!1)}});var cObj=this;grcbForm.getElementsByClassName('grcb_makecall')[0].addEventListener('click',function(){var grcbWidget=document.getElementsByClassName('grcb_widget')[0];var grcbForm=document.getElementsByClassName('grcb_form')[0];var phone=grcbForm.getElementsByClassName('grcb-phone')[0].value;var name=grcbForm.getElementsByClassName('grcb-name')[0].value;var policy=grcbForm.getElementsByClassName('grcb-policy')[0].value;if(phone!=''&&name!=''){cObj.MakeCall(name,phone);grcbForm.className='grcb_form collapse';grcbForm.style.color='rgb(255, 255, 255)';grcbForm.style.fontSize='40px';grcbForm.style.lineHeight='70px';grcbForm.style.textAlign='center';grcbForm.style.border='3px solid #fff';grcbForm.style.transform='rotate(45deg)';grcbForm.style.overflow='initial';grcbForm.style.display='block';grcbForm.style.backgroundColor='rgba(0, 175, 242, 1)';grcbForm.innerHTML='<div style="width: 70px;height: 70px;position: absolute;top: -3px;left: -3px;border-radius: 50%;border: 3px solid #fff;border-left: 3px solid transparent;background-color: transparent;transform: rotate(0deg);"><div id="grcb-clock" style="line-height:64px;"><i class="fa fa-clock"></i></div></div>';window.setTimeout(function(grcbForm,cObj){grcbForm.className='grcb_form timer';var counter=document.createElement('span');counter.className='grcb_counter';document.getElementById('grcb-clock').remove();grcbForm.appendChild(counter);cObj.Timer()},1100,grcbForm,cObj)}});grcbWidget.addEventListener('click',function(){this.className='grcb_widget';this.style.display='none';grcbForm.className='grcb_form active'});grcbWrapper.appendChild(grcbForm);grcbWrapper.appendChild(grcbWidget);$(document.getElementsByName('grcb-phone')[0]).mask("+7 (999) 999-99-99")}
    MakeCall(name,phone){var cObj=this;$.post('/gravitel/callback.php',{name:name,phone:phone,pos:window.grcb_pos++,link:window.location.href},function(msg){var data=JSON.parse(msg);console.log(data);if(data.action=='continue'){window.setTimeout(function(cObj,name,phone){cObj.MakeCall(name,phone)},15000,cObj,name,phone)}else{console.log('grcb finished')}})}
    Timer(){var counter=document.getElementsByClassName('grcb_counter')[0];--this.time;counter.innerHTML=this.time;document.getElementsByClassName('grcb_form')[0].appendChild(counter);if(this.time>0){window.setTimeout(function(obj){obj.Timer()},1000,this)}else{window.setTimeout(function(grcbForm){grcbForm.style.display='none'},1000,document.getElementsByClassName('grcb_form')[0])}}}