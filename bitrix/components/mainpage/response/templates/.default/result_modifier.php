<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResponses */


$Iblock_response = 41;
if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $Iblock_response = 41;
}

$arrUrl = explode('/', trim($_SERVER['REQUEST_URI'], "/"));
dd($arrUrl);
//exit;
//
//switch ($arrUrl[1]) {
//    case 'product' : {
//
//        break;
//    }
//    case 'section' : {
//
//        break;
//    }
//    case 'brand' : {
//
//        break;
//    }
//}

dd($Iblock_response);

// общий вывод всех отзывов
$res = CIBlockElement::GetList(
    Array('CREATED ' => 'DESC'),
    Array("IBLOCK_ID" => $Iblock_response,
        "ACTIVE" => "Y",
    ),
    false,
    false,
    array());
$arResult = [];
$arResponses = [];
while ($ob = $res->GetNextElement()) {
    $flag_select = false;
    $response = $ob->GetFields();
    $response["PROPERTIES"] = $ob->GetProperties();
    $response["product"] = product_response($response["PROPERTIES"]["OBJECT_ID"]["VALUE"]);

    //** Теги start **//
    // выбираем категории
    $category = $response["product"]['section'];

    if (empty($arResponses[$category]['count'])) {
        $item['count'] = 1;
    } else {
        $item['count'] = $arResponses[$category]['count'] + 1;
    }
    $item['link'] = 'section/' . $category . '/';
    $item['name'] = $response["PROPERTIES"]['category']['VALUE'];
    $arResponses[$category] = $item;

    $response["product"]['item_tags'][] = $item;
    if ($category == $arrUrl[1]) {
        $flag_select = true;
    }
    $response["product"]['category_translit'] = $category;

    // выбираем бренды
    $brand = $response["product"]['brand'];

    if (empty($arResponses[$brand]['count'])) {
        $item['count'] = 1;
    } else {
        $item['count'] = $arResponses[$brand]['count'] + 1;
    }
    $item['link'] = 'brand/' . $brand . '/';
    $item['name'] = $response["PROPERTIES"]['brand']['VALUE'];
    $arResponses[$brand] = $item;
    $response["product"]['item_tags'][] = $item;
    $response["product"]['brand_translit'] = $brand;
    if ($brand == $arrUrl[1]) {
        $flag_select = true;
    }

    // выбираем товары
    $product = $response["product"]['code'];
//        dd($arResponses[$product]['count']);
    if (empty($arResponses[$product]['count'])) {
        $item['count'] = 1;
    } else {
        $item['count'] = $arResponses[$product]['count'] + 1;
    }
    $item['link'] = 'product/' . $product . '/';
    $item['name'] = $response["PROPERTIES"]['product']['VALUE'];
    $arResponses[$product] = $item;
    $response["product"]['item_tags'][] = $item;
    $response["product"]['product_translit'] = $product;
    if ($product == $arrUrl[1]) {
        $flag_select = true;
    }
    //** Теги END **//

    //если есть селектор - выбираем требуемые
    if ($flag_select == true) {
        $arResult['select_items'][] = $response;
    } else {
        $arResult['items'][] = $response;
    }

}

// сортировка массива по убыванию
foreach ($arResponses as $key => $row) {
    $volume[$key] = $row['count'];
}
array_multisort($volume, SORT_DESC, $arResponses);

$arResult['tags'] = $arResponses;

// функция подтягивает название и картинку продукта
function product_response($id)
{

//    global $arTranslitCategory;
    $Iblock_product = 39;
    $res = CIBlockElement::GetList(
        Array(),
        Array("IBLOCK_ID" => $Iblock_product,
            "ACTIVE" => "Y",
            'ID' => $id
        ),
        false,
        false,
        array());
    while ($ob = $res->GetNextElement()) {
        $product = $ob->GetFields();

        $product["PROPERTIES"] = $ob->GetProperties();

        if (!empty($product["PROPERTIES"]["short_name"]["VALUE"])) {
            $result['name'] = $product["PROPERTIES"]["short_name"]["VALUE"];
        } else {
            $result['name'] = $product['NAME'];
        }

        if (!empty($product['PREVIEW_PICTURE'])) {
            $result['img'] = $product['PREVIEW_PICTURE'];
        } else {
            $result['img'] = $product['DETAIL_PICTURE'];
        }
        $result['link'] = $product["DETAIL_PAGE_URL"];
        $result['code'] = $product["CODE"];
        $result['section'] = getResponseSectionCode(39, $product['IBLOCK_SECTION_ID'], true);
        $result['brand'] = getResponseSectionCode(37, $product['PROPERTIES']['MANUFACTURER']['VALUE']);
    }
    return $result;
}

// обработка времени
function time_counting($date)
{
    $date = time() - $date;
    if ($date < 60) {
        $result = persuade_words($date, 'секунд', 'секунду', 'секунды', 'секунд');
    } else if ($date < 3600 && $date > 59) {
        $result = persuade_words(floor($date / 60), 'минут', 'минуту', 'минуты', 'минут');
    } else if ($date < 86400 && $date > 3599) {
        $result = persuade_words(floor($date / 3600), 'час', 'час', 'часа', 'часов');
    } else if ($date < 604800 && $date > 86399) {
        $result = persuade_words(floor($date / 86400), 'дней', 'день', 'дня', 'дней');
    } else if ($date < 2629743 && $date > 604799) {
        $result = persuade_words(floor($date / 604800), 'недель', 'неделю', 'недели', 'недель');
    } else if ($date < 31556926 && $date > 2629742) {
        $result = persuade_words(floor($date / 2629743), 'месяцев', 'месяц', 'месяца', 'месяцев');
    } else {
        $result = persuade_words(floor($date / 31556926), 'лет', 'год', 'года', 'лет');
    }
    return $result . ' назад';
}

// Склоняем слова
function persuade_words($count, $ending0, $ending1, $ending2_4, $ending5_9)
{
    if ($count < 1) {
        $count = $ending0;
    } else if ($count > 4 && $count < 21) {
        $count = $count . ' ' . $ending5_9;
    } else if ($count % 10 == 1) {
        $count = $count . ' ' . $ending1;
    } else if ($count % 10 > 1 && $count % 10 < 5) {
        $count = $count . ' ' . $ending2_4;
    } else {
        $count = $count . ' ' . $ending5_9;
    }
    return $count;
}

// транслит
function translit($s)
{
    $s = (string)$s; // преобразуем в строковое значение
    $s = strip_tags($s); // убираем HTML-теги
    $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = trim($s); // убираем пробелы в начале и конце строки
    $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
    $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
    $s = str_replace(" ", "_", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
}



function getResponseSectionCode($BlockId, $id, $section = false){
    if ($section === false) {
        $res = CIBlockElement::GetList(
            array("SORT" => 'ASC'),
            Array("IBLOCK_ID" => $BlockId, "ID" => $id),
            false,
            false,
            array('ID', 'CODE'));
    } else {
        $res = CIBlockSection::GetList(
            array("SORT" => 'ASC'),
            Array("IBLOCK_ID" => $BlockId, "ID" => $id),
            false,
            false,
            array('ID', 'CODE'));
    }
    while ($ob = $res->GetNextElement()) {
        $Elem = $ob->GetFields();

        return $Elem["CODE"];
    }
}
