<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("iblock");
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}

?>


<!--noindex-->
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter" style="position: relative;float: left;width: 100%;margin-top: 10px;">
    <div id="filter-block-alert" style="display:none;position:relative;z-index:98;margin:10px;padding-right:40px;" class="alert alert-success" role="alert"><div style="position:absolute;top:5px;right:5px;font-size:30px;cursor:pointer;opacity:0.5;line-height:17px;" class="button-alert-hide"><span>&times;</span></div>Выбрано: <div class="alert-content" style="display:inline-block;"></div><a href="" style="text-decoration:underline;width:auto;"> показать</a></div>
        <input type="hidden" name="set_filter" value="y">
        <div class="virtual" style="display:none"></div>
	<?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
	<?endforeach;?>
	<div style="width:100%;border-radius: 10px;border: 1px solid #9cc218;">
            <div style="max-width:800px;margin:auto;text-align:center;" class="filter-block-top">
                <?
                // Фильтр по цене
                foreach($arResult["ITEMS"] as $key=>$arItem)
                {
                        $key = $arItem["ENCODED_ID"];
                        if(isset($arItem["PRICE"]))
                        {
				if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0) continue;
                                ?>
                                    <div style="display:inline-block;padding:10px;vertical-align:top;">
                                        <span>Цена</span>
                                        <div style="position:relative;width:211px;height:26px;margin:10px 0 10px 0;padding:4px 0 0 0;">
                                            <div id="filter-price-track-base" style="background-color:#9cc218;height:1px;position:absolute;top:1px;left:5px;width:calc(100% - 10px);"></div>
                                            <div id="filter-price-track-cover" style="background-color:#9cc218;height:3px;position:absolute;top:0;left:5px;width:calc(100% - 10px);"></div>
                                            <div id="filter-price-min" style="cursor:pointer;position:absolute;left:0;top:-4px;width:11px;height:11px;background-color:#9cc218;border-radius:50%;"></div>
                                            <div id="filter-price-max" style="cursor:pointer;position:absolute;right:0;top:-4px;width:11px;height:11px;background-color:#9cc218;border-radius:50%;"></div>
                                            <div id="filter-label-price-min" style="position:absolute;bottom:0;left:0;padding-left:10px;"><?=empty($_REQUEST['arrFilter_P1_MIN']) ? intval($arItem["VALUES"]["MIN"]["VALUE"]) : intval($_REQUEST['arrFilter_P1_MIN'])?></div>
                                            <div id="filter-label-price-max" style="position:absolute;bottom:0;right:0;padding-right:10px;"><?=empty($_REQUEST['arrFilter_P1_MAX']) ? intval($arItem["VALUES"]["MAX"]["VALUE"]) : intval($_REQUEST['arrFilter_P1_MAX'])?></div>
                                            <input type="hidden" name="arrFilter_P1_MIN" id="field-price-min" value="<?=intval($arItem["VALUES"]["MIN"]["VALUE"])?>">
                                            <input type="hidden" name="arrFilter_P1_MAX" id="field-price-max" value="<?=intval($arItem["VALUES"]["MAX"]["VALUE"])?>">
                                        </div>
                                    </div>
                                <?
                        }
		}

                // Производство и производитель
                $itemsCount = 0;
                foreach($arResult["ITEMS"] as $key=>$arItem)
                {
                        if($arItem["CODE"] == 'BASE') continue;
                        if(empty($arItem["VALUES"])) continue;
                        if($arItem["CODE"] == 'COUNTRY')
                        {
                            ?>
                            <div style="display:inline-block;padding:10px;vertical-align:top;">
                                <select id="field-country" style="margin-top: 10px;height: 30px;padding: 5px;border-radius: 10px;font-size: 1em;border-color: #9cc218;vertical-align:top;">
                                        <option value="" selected>Производство</option>
                                        <? foreach($arItem["VALUES"] as $filter) { ?>
                                            <option value="<?=$filter['CONTROL_ID']?>"><?=$filter["VALUE"]?></option>
                                        <? } ?>
                                </select>
                                <input type="hidden" id="field-country-hidden" value="Y">
                            </div>
                            <?
                            continue;
                        }

                        if($arItem["CODE"] == 'MANUFACTURER')
                        {
                            ?>
                            <div style="display:inline-block;padding:10px;vertical-align:top;">
                                <select id="field-manufacturer" style="margin-top: 10px;height: 30px;padding: 5px;border-radius: 10px;font-size: 1em;border-color: #9cc218;vertical-align:top;">
                                        <option value="" selected>Производитель</option>
                                        <? foreach($arItem["VALUES"] as $filter) { ?>
                                            <option value="<?=$filter['CONTROL_ID']?>"><?=$filter["VALUE"]?></option>
                                        <? } ?>
                                </select>
                                <input type="hidden" id="field-manufacturer-hidden" value="Y">
                            </div>
                            <?
                            continue;
                        }
                        $itemsCount++;
                }
                ?>
                    <div style="display:inline-block;padding:10px;vertical-align:top;margin-top: 10px;">
                        <button class="btn btn-default" style="background-color:#9cc218;color:#fff;font-size:12px;width:110px;text-transform:uppercase;border-radius:10px;">показать</button>
                    </div>
                    <div style="display:inline-block;">
                        <div class="filter-button-clear" style="display:none;padding:10px;vertical-align:top;padding-top:15px;cursor:pointer;margin-top: 10px;">
                            <div style="display:inline-block;border:1px solid #9cc218;border-radius:50%;color:#9cc218;width:20px;height:20px;text-align:center;font-size:14px;padding-left:1px;"><i style="line-height:19px;" class="fa fa-remove"></i></div>    
                            <span style="color:#9cc218">Очистить</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="filter-tags-block"></div>
                    <div class="button-extended-search" data-toggle="collapse" aria-expanded="false" data-target="#filter-extended" style="padding-bottom:10px;padding-top:10px;text-align:center;cursor:pointer;">
                        <span style="text-transform:uppercase;font-size:13px;">Расширенный поиск&nbsp;</span>
                    </div>
                </div>
            
        </div>
        <div style="position:relative;">
                <div id="filter-extended" class="filter-extended collapse" style="position:absolute;left:0;top:-10px;z-index:98;background-color:#fff;padding: 10px;width:100%;padding-bottom:30px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;border:1px solid #9cc218;border-top:0;">
                <div class="row" style="max-width:800px;margin:auto;">
                <div class="col-xs-12 col-sm-6 col-lg-4">
                <? // Расширенный фильтр
                $i = 0;
                foreach($arResult["ITEMS"] as $key=>$arItem)
                {
                    if($arItem["CODE"] == 'BASE') continue;
                    if(in_array($arItem["CODE"], Array("MANUFACTURER", "COUNTRY"))) 
                    {
                        foreach($arItem["VALUES"] as $val)
                        {
                            if($_REQUEST[$val['CONTROL_ID']] == 'Y') $selected[$val['CONTROL_ID']] = true;
                        }
                        continue;
                    }
                    if(empty($arItem["VALUES"])) continue;
                    if($i >= ceil($itemsCount/3)) 
                    {
                        $i = 1;
                        ?>
                            </div><div class="col-xs-12 col-sm-4">
                        <?
                    }
                    else
                    {
                        $i++;
                    }

                    ?>
                    <div style="padding-bottom:10px;padding-top:10px;">            
                        <? if(count($arItem['VALUES'])>1) { ?>
                            <div><a data-toggle="collapse" aria-expanded="false" href="#filter-block-<?=strtolower($arItem['CODE'])?>">
                                <?=$arItem['NAME']?>
                            </a></div>
                            <div class="collapse" id="filter-block-<?=strtolower($arItem['CODE'])?>">
                                <ul style="list-style:none;padding-left:5px;">
                                    <? 
                                        foreach($arItem['VALUES'] as $filterItem)
                                        {
                                            if($_REQUEST[$filterItem['CONTROL_ID']] == 'Y')
                                            {
                                                $checked = 'checked';
                                                $expanded[$arItem['CODE']] = true;
                                            }
                                            else
                                            {
                                                $checked = '';
                                            }
                                            ?>
                                            <li class="checkbox">
                                                    <input type="checkbox" name="<?=$filterItem["CONTROL_ID"]?>" id="<?=$filterItem["CONTROL_ID"]?>" value="Y" <?=$checked?>>
                                                    <label style="padding-right:30px" for="<?=$filterItem["CONTROL_ID"]?>"><?=$filterItem["VALUE"]?></label>
                                            </li>
                                            <?
                                        }
                                    ?>
                                </ul>
                            </div>
                        <? } else { ?>
                            <div id="filter-block-<?=strtolower($arItem['CODE'])?>">
                                <ul style="list-style:none;padding-left:5px;">
                                    <? 
                                        foreach($arItem['VALUES'] as $filterItem)
                                        {
                                            if($_REQUEST[$filterItem['CONTROL_ID']] == 'Y')
                                            {
                                                $checked = 'checked';
                                                $expanded[$arItem['CODE']] = true;
                                            }
                                            else
                                            {
                                                $checked = '';
                                            }
                                            ?>
                                            <li class="checkbox" style="margin-top:0;">
                                                    <input type="checkbox" name="<?=$filterItem["CONTROL_ID"]?>" id="<?=$filterItem["CONTROL_ID"]?>" value="Y" <?=$checked?>>
                                                    <label style="padding-right:30px;padding-left:5px;color:#5d7800;" for="<?=$filterItem["CONTROL_ID"]?>"><? echo (strtolower($filterItem['VALUE']) == 'да') ? $arItem['NAME'] : $arItem['NAME'].' ('.$filterItem['VALUE'].')'; ?></label>
                                            </li>
                                            <?
                                        }
                                    ?>
                                </ul>
                            </div>
                        <? } ?>
                    </div>
                    <?
                }
                ?>
                </div>
            </div>
        </div>
            </div>
        <style>
                .hidden-block
                {
                    display:none;
                }
                .smartfilter a
                {
                    text-decoration:none;
                    display:inline-block;
                    width:100%;
                    padding-right:13px;
                    padding-left:10px;
                }
                .smartfilter #filter-block-alert
                {
                    display: inline-block;
                }
                .smartfilter .virtual
                {
                    overflow:hidden;
                    height:0;
                    text-align:center;
                }
                .smartfilter a[aria-expanded="true"]:after
                {
                    font-family: FontAwesome;
                    content: "\f0d8";
                    float:right;
                }
                .smartfilter a[aria-expanded="false"]:after
                {
                    font-family: FontAwesome;
                    content: "\f0d7";
                    float:right;
                }
                .button-extended-search[aria-expanded="true"]:after
                {
                    font-family: FontAwesome;
                    content: "\f068";
                    font-size:14px;
                    border-radius:50%;
                    border:1px solid #999;
                    color:#999;
                    width: 20px;
                    height: 20px;
                    line-height: 20px;
                    display: inline-block;
                }
                .button-extended-search[aria-expanded="false"]:after
                {
                    font-family: FontAwesome;
                    content: "\f067";
                    font-size:14px;
                    border-radius:50%;
                    border:1px solid #999;
                    color:#999;
                    width: 20px;
                    height: 20px;
                    line-height: 20px;
                    display: inline-block;
                }
                .smartfilter ul
                {
                    margin-bottom:0;
                    margin-top:0;
                }
                .smartfilter li.checkbox {
                        position:relative;
                        margin-bottom:0;
                        margin-top:10px;
                }
                .smartfilter .checkbox input[type=checkbox] {
                        display:none;
                }
                .smartfilter .checkbox label:after {
                        content:'';
                        display:block;
                        height:14px;
                        width:14px;
                        outline:1px solid #9cc218;
                        position:absolute;
                        top:0;
                        right:10px;
                }
                .smartfilter .checkbox input[type=checkbox]:checked + label:after {
                        outline:1px solid #9cc218;
                        border:2px solid #fff;
                        width:14px;
                        height:14px;
                        background-color:#7b9914;
                }
                .smartfilter .filter-tags-block
                {
                    text-align:center;
                }
                .smartfilter .filter-tags-block .filter-tag
                {
                    position:relative;
                    display:inline-block;
                    border-radius:5px;
                    margin:5px;
                    background-color:#e5f3b3;
                    border:1px solid #9cc218;
                    padding: 1px 20px 1px 5px;
                    overflow: hidden;
                    max-width: 280px;
                    white-space: nowrap;
                }
                .tag-button-remove
                {
                    position:absolute;
                    top:0;
                    right:0;
                    width: 16px;
                    height: 18px;
                    line-height: 18px;
                    text-align:center;
                    background-color:#e5f3b3;
                    cursor:pointer;
                }
        </style>
</form>
<!--/noindex-->

<script>
	//var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
        $(document).ready(function(){

            var filterTags = {};
            $('form.smartfilter').submit(function(){
               if($('#field-country').val()) $('#field-country-hidden').attr('name', $('#field-country').val());
               if($('#field-manufacturer').val()) $('#field-manufacturer-hidden').attr('name', $('#field-manufacturer').val());
            });
            
            <?  // Раскрытие списков, если есть отмеченные чекбоксы
                if(!empty($expanded)) 
                {
                    foreach($expanded as $code => $value) { 
                        if($value)
                        { 
                            ?>
                                    $('#filter-block-<?=strtolower($code)?>').addClass('in');
                                    var inputElement = $('#filter-block-<?=strtolower($code)?>').find('input:checked');
                                    inputElement.toArray().forEach(function(item, i, arr){
                                        filterTags[$(item).attr('id')] = $(item).parent().find('label').html();
                                    });
                            <?
                        }
                    }
                    ?>
                        $('.filter-button-clear').show();
                    <?
                } 
            ?>
                    
            // Обработка изменения полей формы
            $('.smartfilter').find('.filter-block-top').find('input, select').change(function(){FilterQuantityHint.call($('.smartfilter').find('.filter-block-top'));});
            $('.smartfilter').find('.filter-extended').find('input').change(function(){
                if($(this).prop('checked')) AddTag($(this).attr('id'), $('.smartfilter').find('#'+$(this).attr('id')).parent().find('label').html());
                else DelTag($(this).attr('id'));
                FilterQuantityHint.call($('.smartfilter').find('#'+$(this).attr('id')));
            });
            
            // Добавляем выбранные теги
            function AddTag(fTagId, fTagName){
                $('.smartfilter').find('.filter-tags-block').append('<div class="filter-tag" title="'+fTagName+'">'+fTagName+'<div class="tag-button-remove" data-target="#'+fTagId+'"><i class="fa fa-remove"></i></div></div>');
                $('.smartfilter').find('.filter-tags-block').find('.tag-button-remove[data-target="#'+fTagId+'"]').click(function(){
                    $('.smartfilter').find('input'+$(this).data('target')).prop('checked', false);
                    FilterQuantityHint.call($('.smartfilter').find('.filter-block-top'));
                    $(this).parent().stop().animate({width:'0px', opacity:'0'}, 500, function(){
                        $(this).remove();
                    })
                });
                window.FilterTagBlockInitialHeight = $('.filter-tags-block').outerHeight()+'px';
            }
            function DelTag(fTagId)
            {
                $('.smartfilter').find('.filter-tags-block').find('.tag-button-remove[data-target="#'+fTagId+'"]').click();
            }
            for(key in filterTags)
            {
                AddTag(key, filterTags[key]);
            }

            // Скрываем теги при раскрытии расширенного фильтра и показываем при сворачивании расширенного фильтра
            window.FilterTagBlockInitialHeight = $('.filter-tags-block').outerHeight()+'px';
            $('.filter-tags-block').css("max-height",$('.filter-tags-block').outerHeight()+'px');
            $('.smartfilter').find('.button-extended-search').click(function(){
                if($('.filter-tags-block').hasClass('hidden-block')) 
                {
                    $('.filter-tags-block').removeClass('hidden-block').stop().animate({"max-height":window.FilterTagBlockInitialHeight,opacity:'1'}, 500, function(){
                        
                    });
                }
                else 
                {
                    $('.filter-tags-block').stop().animate({"max-height":"0px",opacity:'0'}, 500, function(){
                        $('.filter-tags-block').addClass('hidden-block');
                        $('.filter-tags-block').css("max-height","");
                    });
                }
            });

            <?  // Выбираем отмеченные опции в select
                if(!empty($selected)) 
                {   
                    foreach($selected as $code => $value) { 
                        if($value)
                        { 
                            ?>
                                    $('#field-country, #field-manufacturer').find('option[value="<?=$code?>"]').prop('selected', 'true');
                            <?
                        }
                    }
                    ?>
                        $('.filter-button-clear').show();
                    <?
                } 
            ?>
                    
            // Очистка формы фильтра
            $('.smartfilter').find('.filter-button-clear').click(function(){
                window.location.href = window.location.pathname;
            });
            
            // Скрытие alert
            $('.smartfilter').find('.button-alert-hide').click(function(){
                $('.smartfilter').find('.virtual').stop().animate({"height":"0px"}, 500, function(){
                    $('#filter-block-alert').hide();
                });
            });
            
            function FilterQuantityHint()
            {
                if(typeof(window.smartFilterRequest) != 'undefined') window.smartFilterRequest.abort();
                var formdata = {
                    set_filter: 'y',
                    ajax: 'y'
                };
                if($('.smartfilter').find('#field-manufacturer').val() != '') formdata[$('#field-manufacturer').val()] = 'Y';
                if($('.smartfilter').find('#field-country').val() != '') formdata[$('#field-country').val()] = 'Y';
                if($('.smartfilter').find('#field-price-min').val() != '') formdata[$('#field-price-min').attr('name')] = $('#field-price-min').val();
                if($('.smartfilter').find('#field-price-max').val() != '') formdata[$('#field-price-max').attr('name')] = $('#field-price-max').val();
                
                $('.smartfilter').find('input:checked').toArray().forEach(function(item, i, arr){
                    formdata[$(item).attr('name')] = $(item).val();
                });
                
                $('#filter-block-alert').hide();
                var newParent;
                if($(this).attr('class') == 'filter-block-top') newParent = this;
                else newParent = $(this).parent().parent();
                
                $('.smartfilter').find('.virtual').stop().animate({"height":"0px"}, function(){
                    $('.smartfilter').prepend($('#filter-block-alert').detach().hide());
                    var alertElement = $('#filter-block-alert');
                    $(this).remove();
                    newParent.after('<div class="virtual"></div>');
                    window.smartFilterRequest = $.get(window.location.pathname, formdata, function(data){
                        /*data.PROPERTY_ID_LIST.forEach(function(prop, i, arr){
                            //prop.VALUES
                        });*/
                        var totalCount = data.ELEMENT_COUNT;
                        var aLink = '?';

                        for(item in formdata)
                        {
                            console.log('item', item);
                            if(item == 'ajax') continue;
                            else if(aLink == '?')
                            {
                                aLink += item + '=' + formdata[item];
                            }
                            else
                            {
                                aLink += '&' + item + '=' + formdata[item];

                            }
                        }
                        $('.smartfilter').find('.virtual').append(alertElement.detach());
                        $('#filter-block-alert').find('a').attr('href', aLink);
                        $('#filter-block-alert').find('.alert-content').html(totalCount);
                        $('#filter-block-alert').show();
                        $('.smartfilter').find('.virtual').stop().animate({'height':'67px'});
                    }, 'json');
                });
            }
            
            // Обработка перетаскивания
            $('#filter-price-min, #filter-price-max').draggable(
                {
                    axis: 'x',
                    containment: 'parent',
                    create: function() {
                        var priceMin = <?=$arItem["VALUES"]["MIN"]["VALUE"]?>;
                        var priceMax = <?=$arItem["VALUES"]["MAX"]["VALUE"]?>;
                        var priceTargetMin = parseInt($('#filter-label-price-min').html());
                        var priceTargetMax = parseInt($('#filter-label-price-max').html());
                        
                        var posMin = Math.floor(200 * (priceTargetMin - priceMin) / (priceMax - priceMin));
                        var posMax = Math.ceil(200 * (priceTargetMax - priceMin) / (priceMax - priceMin));
                        
                        $('#filter-price-track-cover').css('left', (posMin+5)+'px');
                        $('#filter-price-track-cover').css('width', (posMax-posMin)+'px');
                        
                        $('#filter-price-min').css('left', posMin+'px');
                        $('#filter-price-max').css('left', posMax+'px');
                        if(priceTargetMin != priceMin) 
                        {
                            $('#field-price-min').val(priceTargetMin).prop('disabled', false);
                        }
                        else 
                        {
                            // $('#field-price-min').val('').prop('disabled', true);;
                        }
                        if(priceTargetMax != priceMax) 
                        {
                            $('#field-price-max').val(priceTargetMax).prop('disabled', false);
                        }
                        else 
                        {
                            // $('#field-price-max').val('').prop('disabled', true);
                        }
                    },
                    start: function() {
                        
                    },
                    stop: function() {
                        var posMin = parseInt($('#filter-price-min').position().left);
                        var posMax = parseInt($('#filter-price-max').position().left);
                        $('#filter-price-track-cover').css('left', (posMin+5)+'px');
                        $('#filter-price-track-cover').css('width', (posMax-posMin)+'px');
                        
                        var priceMin = <?=$arItem["VALUES"]["MIN"]["VALUE"]?>;
                        var priceMax = <?=$arItem["VALUES"]["MAX"]["VALUE"]?>;
                        var priceTargetMin = Math.ceil(priceMin + (priceMax - priceMin) * posMin/200);
                        var priceTargetMax = Math.ceil(priceMin + (priceMax - priceMin) * posMax/200);
                        $('#filter-label-price-min').html(priceTargetMin);
                        $('#filter-label-price-max').html(priceTargetMax);
                        if(priceTargetMin != priceMin) 
                        {
                            $('#field-price-min').val(priceTargetMin).prop('disabled', false);
                        }
                        else 
                        {
                            // $('#field-price-min').val('').prop('disabled', true);;
                        }
                        if(priceTargetMax != priceMax) 
                        {
                            $('#field-price-max').val(priceTargetMax).prop('disabled', false);
                        }
                        else 
                        {
                            // $('#field-price-max').val('').prop('disabled', true);
                        }
                        FilterQuantityHint.call($('.smartfilter').find('.filter-block-top'));
                    },
                    drag: function(e) {
                        var posMin = parseInt($('#filter-price-min').position().left);
                        var posMax = parseInt($('#filter-price-max').position().left);
                        
                        if($(this).attr('id') == 'filter-price-min') 
                        {
                            if(posMin+13 > posMax)
                            {
                                e.preventDefault();
                                $('#filter-price-min').css('left', posMax-13+'px');
                            }
                        }
                        if($(this).attr('id') == 'filter-price-max') 
                        {
                            if(posMax-13 < posMin)
                            {                        
                                e.preventDefault();
                                $('#filter-price-max').css('left', posMin+13+'px');
                            }
                        }
                        posMin = parseInt($('#filter-price-min').position().left);
                        posMax = parseInt($('#filter-price-max').position().left);
                        $('#filter-price-track-cover').css('left', (posMin+5)+'px');
                        $('#filter-price-track-cover').css('width', (posMax-posMin)+'px');
                        
                        var priceMin = <?=$arItem["VALUES"]["MIN"]["VALUE"]?>;
                        var priceMax = <?=$arItem["VALUES"]["MAX"]["VALUE"]?>;
                        
                        var priceTargetMin = Math.ceil(priceMin + (priceMax - priceMin) * posMin/200);
                        var priceTargetMax = Math.ceil(priceMin + (priceMax - priceMin) * posMax/200);
                        
                        $('#filter-label-price-min').html(priceTargetMin);
                        $('#filter-label-price-max').html(priceTargetMax);
                    }               
                } 
            );            
        });
</script>