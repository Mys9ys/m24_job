<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

// BEGIN Замена #ВГОРОДЕ# на региональные значения (КВ)
switch ($_SERVER['SERVER_NAME']) {
        case "xn--90aedc4atap.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Белгороде'; //Белгород
             break;
        case "xn--b1agd0aean.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Воронеже'; //Воронеж
             break;
        case "xn--80acgfbsl1azdqr.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Екатеринбурге'; //Екатеринбург
             break;
        case "xn--80aauks4g.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Казани'; //Казань
             break;
        case "xn--j1aarei.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Курске'; //Курск
             break;
        case "xn--e1afhbv7b.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Липецке'; //Липецк
             break;
        case "xn----7sbdqaabf2clfe5a7hpcg.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Набережных Челнах'; //Наберебжные Челны
             break;
        case "xn-----7kcgn5cdbagnnnx.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Ростове-на-Дону'; //Ростов-на-Дону
             break;
        case "xn--80avue.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Туле'; //Тула
             break;
        case "xn--e1aner7ci.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Тюмени'; //Тюмень
             break;
        case "xn--k1afg2e.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Орле'; //Орёл
             break;
        case "xn--80adxhks.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Москве'; //Москва
             break;
        
        
        case "xn--80antj7do.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Рязани'; //Рязань
             break;
        case "xn--90absbknhbvge.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Новосибирске'; //Новосибирск
             break;
        case "xn----7sbeiia6axumbcqds.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Санкт-Петербурге'; //Санкт-Петербург
             break;     
        case "xn----dtbdeglbi6acdmca3a.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Нижнем Новгороде'; //Нижний Новгород
             break;
        case "xn--80aaa0cvac.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Самаре'; //Самара
             break;
        case "xn--80aalwqglfe.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Краснодаре'; //Краснодар
             break; 
        case "xn--80a1bd.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Уфе'; //Уфа
             break; 
        case "xn--e1aohf5d.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Перми'; //Пермь
             break;
        case "xn--80addag2buct.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Волгограде'; //Волгоград
             break;
        case "xn--h1aeawgfg.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Иркутске'; //Иркутск
             break;
        case "xn--b1afaslnbn.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Кемерово'; //Кемерово
             break;
        case "xn--80aacf4bwnk3a.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Хабаровске'; //Хабаровск
             break;
        case "xn--80atblfjdfd2l.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Красноярске'; //Красноярск
             break;
        case "xn--90asilg6f.xn--24-6kcazf3bybfa8i.xn--p1ai": $v_regione = ' в Брянске'; //Брянск
             break;     
        default:  $v_regione = '';        
    }
$arResult['DETAIL_TEXT'] = str_replace('#ВГОРОДЕ#', $v_regione, $arResult['DETAIL_TEXT']);
// END

?>

<h1>
<? 

use Bitrix\Iblock\Template;
//Подключение модуля инфоблоков.

	$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(43, $arResult["ID"]); 
	$arElMetaProp = $ipropValues->getValues(); 
	if(!empty($arElMetaProp['ELEMENT_PAGE_TITLE'])) echo $arElMetaProp['ELEMENT_PAGE_TITLE'];
	else echo $arResult['NAME'];

?>
</h1>

<div class="news-detail">
	<?if(is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" />
	<?endif?>
	<div class="detail-text"><?=str_replace('#ВГОРОДЕ#', $_SESSION['vregione'], $arResult['DETAIL_TEXT']);?></div>
</div>

<?if(is_array($arResult["TOLEFT"]) || is_array($arResult["TORIGHT"])):?>
	<ul class="stati_prev_next"> 
		<?if(is_array($arResult["TORIGHT"])):?>
			<li class="prev">
				<a href="<?=$arResult["TORIGHT"]["URL"]?>">
					<span class="arrow_prev"></span>
					<?if(!empty($arResult["TORIGHT"]["PREVIEW_PICTURE"]["src"])):?>
						<span class="image_cont">
							<span class="image">
								<img src="<?=$arResult["TORIGHT"]["PREVIEW_PICTURE"]["src"]?>" width="<?=$arResult["TORIGHT"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["TORIGHT"]["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arResult["TORIGHT"]["NAME"]?>" />
							</span>
						</span>
					<?endif;?>
					<span class="title-link"><?=$arResult["TORIGHT"]["NAME"]?></span>
				</a>
			</li>
		<?endif?>
		<?if(is_array($arResult["TOLEFT"])):?>
			<li class="next">
				<a href="<?=$arResult["TOLEFT"]["URL"]?>">
					<span class="title-link"><?=$arResult["TOLEFT"]["NAME"]?></span>
					<?if(!empty($arResult["TOLEFT"]["PREVIEW_PICTURE"]["src"])):?>
						<span class="image_cont">
							<span class="image">
								<img src="<?=$arResult["TOLEFT"]["PREVIEW_PICTURE"]["src"]?>" width="<?=$arResult["TOLEFT"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["TOLEFT"]["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arResult["TOLEFT"]["NAME"]?>" />
							</span>
						</span>
					<?endif;?>
					<span class="arrow_next"></span>
				</a>
			</li>
		<?endif?>
	</ul>
<?endif?>