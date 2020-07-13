<?

use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arServer = explode('.', $_SERVER['SERVER_NAME']);
$v_regione = '';
if ($arServer[0] != 'xn--24-6kcazf3bybfa8i' && $arServer[0] != 'massagery24') {
    switch ($arServer[0]) {
        case 'xn--80aab6birx' : { $v_regione =  'в Барнауле' ; } break;
        case 'xn--90aedc4atap' : { $v_regione =  'в Белгороде' ; } break;
        case 'xn--90asilg6f' : { $v_regione =  'в Брянске' ; } break;
        case 'xn--80addag2buct' : { $v_regione =  'в Волгограде' ; } break;
        case 'xn--b1agd0aean' : { $v_regione =  'в Воронеже' ; } break;
        case 'xn--80acgfbsl1azdqr' : { $v_regione =  'в Екатеринбурге' ; } break;
        case 'xn--h1aeawgfg' : { $v_regione =  'в Иркутске' ; } break;
        case 'xn--80aauks4g' : { $v_regione =  'в Казани' ; } break;
        case 'xn--b1afaslnbn' : { $v_regione =  'в Кемерово' ; } break;
        case 'xn--80aalwqglfe' : { $v_regione =  'в Краснодаре' ; } break;
        case 'xn--80atblfjdfd2l' : { $v_regione =  'в Красноярске' ; } break;
        case 'xn--j1aarei' : { $v_regione =  'в Курске' ; } break;
        case 'xn--e1afhbv7b' : { $v_regione =  'в Липецке' ; } break;
        case 'xn--80agatlhjjbulh' : { $v_regione =  'в Магнитогорске' ; } break;
        case 'xn----7sbdqaabf2clfe5a7hpcg' : { $v_regione =  'в Набережных Челнах' ; } break;
        case 'xn----dtbdeglbi6acdmca3a' : { $v_regione =  'в Нижнем Новгороде' ; } break;
        case 'xn--90absbknhbvge' : { $v_regione =  'в Новосибирске' ; } break;
        case 'xn--k1afg2e' : { $v_regione =  'в Орле' ; } break;
        case 'xn--e1aohf5d' : { $v_regione =  'в Перми' ; } break;
        case 'xn-----7kcgn5cdbagnnnx' : { $v_regione =  'в Ростове-на-Дону' ; } break;
        case 'xn--80antj7do' : { $v_regione =  'в Рязани' ; } break;
        case 'xn--80aaa0cvac' : { $v_regione =  'в Самаре' ; } break;
        case 'xn----7sbeiia6axumbcqds' : { $v_regione =  'в Санкт-Петербурге' ; } break;
        case 'xn--h1aliz' : { $v_regione =  'в Сочи' ; } break;
        case 'xn--80ae1alafffj1i' : { $v_regione =  'в Ставрополе' ; } break;
        case 'xn--c1azcgcc' : { $v_regione =  'в Сургуте' ; } break;
        case 'xn--80avue' : { $v_regione =  'в Туле' ; } break;
        case 'xn--e1aner7ci' : { $v_regione =  'в Тюмени' ; } break;
        case 'xn--80a1bd' : { $v_regione =  'в Уфе' ; } break;
        case 'xn--80aacf4bwnk3a' : { $v_regione =  'в Хабаровске' ; } break;
        case 'xn--90ahkico2a6b9d' : { $v_regione =  'в Челябинске' ; } break;

        case 'Барнаул' : { $v_regione =  'в Барнауле';  } break;
        case 'Белгород' : { $v_regione =  'в Белгороде';  } break;
        case 'Брянск' : { $v_regione =  'в Брянске';  } break;
        case 'Волгоград' : { $v_regione =  'в Волгограде';  } break;
        case 'Воронеж' : { $v_regione =  'в Воронеже';  } break;
        case 'Екатеринбург' : { $v_regione =  'в Екатеринбурге';  } break;
        case 'Иркутск' : { $v_regione =  'в Иркутске';  } break;
        case 'Казань' : { $v_regione =  'в Казани';  } break;
        case 'Кемерово' : { $v_regione =  'в Кемерово';  } break;
        case 'Краснодар' : { $v_regione =  'в Краснодаре';  } break;
        case 'Красноярск' : { $v_regione =  'в Красноярске';  } break;
        case 'Курск' : { $v_regione =  'в Курске';  } break;
        case 'Липецк' : { $v_regione =  'в Липецке';  } break;
        case 'Магнитогорск' : { $v_regione =  'в Магнитогорске';  } break;
        case 'Набережные Челны' : { $v_regione =  'в Набережных Челнах';  } break;
        case 'Нижний Новгород' : { $v_regione =  'в Нижнем Новгороде';  } break;
        case 'Новосибирск' : { $v_regione =  'в Новосибирске';  } break;
        case 'Орёл' : { $v_regione =  'в Орле';  } break;
        case 'Пермь' : { $v_regione =  'в Перми';  } break;
        case 'Ростов-на-Дону' : { $v_regione =  'в Ростове-на-Дону';  } break;
        case 'Рязань' : { $v_regione =  'в Рязани';  } break;
        case 'Самара' : { $v_regione =  'в Самаре';  } break;
        case 'Санкт-Петербург' : { $v_regione =  'в Санкт-Петербурге';  } break;
        case 'Сочи' : { $v_regione =  'в Сочи';  } break;
        case 'Ставрополь' : { $v_regione =  'в Ставрополе';  } break;
        case 'Сургут' : { $v_regione =  'в Сургуте';  } break;
        case 'Тула' : { $v_regione =  'в Туле';  } break;
        case 'Тюмень' : { $v_regione =  'в Тюмени';  } break;
        case 'Уфа' : { $v_regione =  'в Уфе';  } break;
        case 'Хабаровск' : { $v_regione =  'в Хабаровске';  } break;
        case 'Челябинск' : { $v_regione =  'в Челябинске';  } break;

        case 'barnaul' : { $v_regione =  'в Барнауле' ; } break;
        case 'belgorod' : { $v_regione =  'в Белгороде' ; } break;
        case 'bryansk' : { $v_regione =  'в Брянске' ; } break;
        case 'volgograd' : { $v_regione =  'в Волгограде' ; } break;
        case 'voronezh' : { $v_regione =  'в Воронеже' ; } break;
        case 'ekaterinburg' : { $v_regione =  'в Екатеринбурге' ; } break;
        case 'irkutsk' : { $v_regione =  'в Иркутске' ; } break;
        case 'kazan' : { $v_regione =  'в Казани' ; } break;
        case 'kemerovo' : { $v_regione =  'в Кемерово' ; } break;
        case 'krasnodar' : { $v_regione =  'в Краснодаре' ; } break;
        case 'krasnoyarsk' : { $v_regione =  'в Красноярске' ; } break;
        case 'kursk' : { $v_regione =  'в Курске' ; } break;
        case 'lipeck' : { $v_regione =  'в Липецке' ; } break;
        case 'magnitogorsk' : { $v_regione =  'в Магнитогорске' ; } break;
        case 'naberezhnie-chelni' : { $v_regione =  'в Набережных Челнах' ; } break;
        case 'nizhnii-novgorod' : { $v_regione =  'в Нижнем Новгороде' ; } break;
        case 'novosibirsk' : { $v_regione =  'в Новосибирске' ; } break;
        case 'orel' : { $v_regione =  'в Орле' ; } break;
        case 'perm' : { $v_regione =  'в Перми' ; } break;
        case 'rostov-na-donu' : { $v_regione =  'в Ростове-на-Дону' ; } break;
        case 'ryazan' : { $v_regione =  'в Рязани' ; } break;
        case 'samara' : { $v_regione =  'в Самаре' ; } break;
        case 'sankt-peterburg' : { $v_regione =  'в Санкт-Петербурге' ; } break;
        case 'sochi' : { $v_regione =  'в Сочи' ; } break;
        case 'stavropol' : { $v_regione =  'в Ставрополе' ; } break;
        case 'surgut' : { $v_regione =  'в Сургуте' ; } break;
        case 'tula' : { $v_regione =  'в Туле' ; } break;
        case 'tyumen' : { $v_regione =  'в Тюмени' ; } break;
        case 'ufa' : { $v_regione =  'в Уфе' ; } break;
        case 'habarovsk' : { $v_regione =  'в Хабаровске' ; } break;
        case 'chelyabinsk' : { $v_regione =  'в Челябинске' ; } break;

        default:{}
    }
    if(stripos($_SERVER['HTTP_USER_AGENT'], 'YandexBot') !== false && $arServer[1] == 'xn--24-6kcazf3bybfa8i'){
        switch ($arServer[0]) {

            case 'xn--80aab6birx' : { $redirect_poddomen =  'barnaul';  } break;
            case 'xn--90aedc4atap' : { $redirect_poddomen =  'belgorod';  } break;
            case 'xn--90asilg6f' : { $redirect_poddomen =  'bryansk';  } break;
            case 'xn--80addag2buct' : { $redirect_poddomen =  'volgograd';  } break;
            case 'xn--b1agd0aean' : { $redirect_poddomen =  'voronezh';  } break;
            case 'xn--80acgfbsl1azdqr' : { $redirect_poddomen =  'ekaterinburg';  } break;
            case 'xn--h1aeawgfg' : { $redirect_poddomen =  'irkutsk';  } break;
            case 'xn--80aauks4g' : { $redirect_poddomen =  'kazan';  } break;
            case 'xn--b1afaslnbn' : { $redirect_poddomen =  'kemerovo';  } break;
            case 'xn--80aalwqglfe' : { $redirect_poddomen =  'krasnodar';  } break;
            case 'xn--80atblfjdfd2l' : { $redirect_poddomen =  'krasnoyarsk';  } break;
            case 'xn--j1aarei' : { $redirect_poddomen =  'kursk';  } break;
            case 'xn--e1afhbv7b' : { $redirect_poddomen =  'lipeck';  } break;
            case 'xn--80agatlhjjbulh' : { $redirect_poddomen =  'magnitogorsk';  } break;
            case 'xn----7sbdqaabf2clfe5a7hpcg' : { $redirect_poddomen =  'naberezhnie-chelni';  } break;
            case 'xn----dtbdeglbi6acdmca3a' : { $redirect_poddomen =  'nizhnii-novgorod';  } break;
            case 'xn--90absbknhbvge' : { $redirect_poddomen =  'novosibirsk';  } break;
            case 'xn--k1afg2e' : { $redirect_poddomen =  'orel';  } break;
            case 'xn--e1aohf5d' : { $redirect_poddomen =  'perm';  } break;
            case 'xn-----7kcgn5cdbagnnnx' : { $redirect_poddomen =  'rostov-na-donu';  } break;
            case 'xn--80antj7do' : { $redirect_poddomen =  'ryazan';  } break;
            case 'xn--80aaa0cvac' : { $redirect_poddomen =  'samara';  } break;
            case 'xn----7sbeiia6axumbcqds' : { $redirect_poddomen =  'sankt-peterburg';  } break;
            case 'xn--h1aliz' : { $redirect_poddomen =  'sochi';  } break;
            case 'xn--80ae1alafffj1i' : { $redirect_poddomen =  'stavropol';  } break;
            case 'xn--c1azcgcc' : { $redirect_poddomen =  'surgut';  } break;
            case 'xn--80avue' : { $redirect_poddomen =  'tula';  } break;
            case 'xn--e1aner7ci' : { $redirect_poddomen =  'tyumen';  } break;
            case 'xn--80a1bd' : { $redirect_poddomen =  'ufa';  } break;
            case 'xn--80aacf4bwnk3a' : { $redirect_poddomen =  'habarovsk';  } break;
            case 'xn--90ahkico2a6b9d' : { $redirect_poddomen =  'chelyabinsk';  } break;
        }
        header('Location: https://'.$redirect_poddomen.'.massagery24.ru');
    }
}

$APPLICATION->SetPageProperty("VREGIONE", $v_regione);

$arResult['vregione'] = $v_regione;
