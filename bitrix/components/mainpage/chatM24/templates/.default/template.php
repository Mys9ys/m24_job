<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/chatM24/style.min.css');?>

<?if($arParams['footer'] == true){?>
<!--    --><?//dd('mi tyty')?>
    <div class="chat_m24_wrap">
        <img class="chars1_img" src="/bitrix/components/mainpage/chatM24/image/chair1.png" alt="">
        <img class="chars2_img img_hide" src="/bitrix/components/mainpage/chatM24/image/chair2.png" alt="">
        <div class="chat_m24">
            <span class="chat_title">Начать чат</span>
            <a class="whatsapp_btn social_btn" href="https://api.whatsapp.com/send?phone=79299408417" target="_blank">
                <i class="fa fa-whatsapp"></i>
            </a>
            <a class="telegram_btn social_btn" href="https://tele.click/Massagery24Bot" target="_blank">
                <i class="fa fa-telegram"></i>
            </a>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.chat_m24_wrap').on('mouseenter mouseleave', function () {
                $(this).find('img').each(function (key,item) {
                    $(item).toggleClass('img_hide')
                });
            });
        });
    </script>

    <?return;
}?>
<?if($arParams['callbaska']== 'Y'){?>

    <div class="chat_m24 region_chatM24">
        <div class="chatM24_open ">
            <i class="fa fa-phone block_show" aria-hidden="true"></i>
        </div>
        <div class="chat_block_wrapper">
           <div class="chat_block_hidden">
               <div class="chat_block">
                   <span class="chat_title">Обратный<br> звонок</span>
                   <div class="callbaska_box_btn social_btn" title="Обратный звонок">
                       <i class="fa fa-phone fa-callbaska" aria-hidden="true"></i>
                   </div>
               </div>
               <div class="chat_block">
                   <span class="chat_title">Начать<br> чат</span>
                   <a class="whatsapp_btn social_btn" href="https://api.whatsapp.com/send?phone=79299408417" target="_blank">
                       <i class="fa fa-whatsapp"></i>
                   </a>
                   <a class="telegram_btn social_btn" href="https://tele.click/Massagery24Bot" target="_blank">
                       <i class="fa fa-telegram"></i>
                   </a>
               </div>
           </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.callbaska_box_btn').click(function () {
                $('.grcb_widget').click();
            });
            $('.chatM24_open').on('click', '.block_show', function(){
                var $this_parent = $(this).parent();
                $this_parent.parent().find('.chat_block_hidden').show("drop", { direction: "right" }, 1000);
                $this_parent.children().remove().append('<div class="chatM24_close">+</div>');
                $this_parent.append('<div class="chatM24_close">+</div>');
            });
            $('.chatM24_open').on('click', '.chatM24_close', function(){
                var $this_parent = $(this).parent();
                $this_parent.parent().find('.chat_block_hidden').hide("drop", { direction: "right" }, 1000);
                $this_parent.children().remove();
                $this_parent.append('<i class="fa fa-phone" aria-hidden="true"></i>');
            });
        });
    </script>
<?} else {?>
    <div class="chat_m24">
        <span class="chat_title">Начать чат</span>
        <a class="whatsapp_btn social_btn" href="https://api.whatsapp.com/send?phone=79299408417" target="_blank">
            <i class="fa fa-whatsapp"></i>
        </a>
        <a class="telegram_btn social_btn" href="https://tele.click/Massagery24Bot" target="_blank">
            <i class="fa fa-telegram"></i>
        </a>
    </div>
<?}?>
<script>
    $(document).ready(function(){
        $('.chat_m24').find('.whatsapp_btn').click(function(){
            var elem = $('.chat_m24').find('.whatsapp_btn');
            if(!$(this).hasClass('amolead')) {
                $.post('/api/new_whatsapp_lead/', {}, function(data){
                    if(data.status == 'OK') {
                        elem.addClass('amolead');
                    }
                }, 'json');
            }
        });
    });
</script>