<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!function_exists('getDoublePicturesForItem')) {
    function getDoublePicturesForItem(&$item, $propertyCode)
    {
        $result = array(
            'PICT' => false,
            'SECOND_PICT' => false
        );

        if (!empty($item) && is_array($item)) {
            if (!empty($item['PREVIEW_PICTURE'])) {
                if (!is_array($item['PREVIEW_PICTURE']))
                    $item['PREVIEW_PICTURE'] = CFile::GetFileArray($item['PREVIEW_PICTURE']);
                if (isset($item['PREVIEW_PICTURE']['ID'])) {
                    $result['PICT'] = array(
                        'ID' => intval($item['PREVIEW_PICTURE']['ID']),
                        'SRC' => $item['PREVIEW_PICTURE']['SRC'],
                        'WIDTH' => intval($item['PREVIEW_PICTURE']['WIDTH']),
                        'HEIGHT' => intval($item['PREVIEW_PICTURE']['HEIGHT'])
                    );
                }
            }
            if (!empty($item['DETAIL_PICTURE'])) {
                $keyPict = (empty($result['PICT']) ? 'PICT' : 'SECOND_PICT');
                if (!is_array($item['DETAIL_PICTURE']))
                    $item['DETAIL_PICTURE'] = CFile::GetFileArray($item['DETAIL_PICTURE']);
                if (isset($item['DETAIL_PICTURE']['ID'])) {
                    $result[$keyPict] = array(
                        'ID' => intval($item['DETAIL_PICTURE']['ID']),
                        'SRC' => $item['DETAIL_PICTURE']['SRC'],
                        'WIDTH' => intval($item['DETAIL_PICTURE']['WIDTH']),
                        'HEIGHT' => intval($item['DETAIL_PICTURE']['HEIGHT'])
                    );
                }
            }
            if (empty($result['SECOND_PICT'])) {
                if (
                    '' != $propertyCode &&
                    isset($item['PROPERTIES'][$propertyCode]) &&
                    'F' == $item['PROPERTIES'][$propertyCode]['PROPERTY_TYPE']
                ) {
                    if (
                        isset($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']) &&
                        !empty($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE'])
                    ) {
                        $fileValues = (
                        isset($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']['ID']) ?
                            array(0 => $item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']) :
                            $item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']
                        );
                        foreach ($fileValues as &$oneFileValue) {
                            $keyPict = (empty($result['PICT']) ? 'PICT' : 'SECOND_PICT');
                            $result[$keyPict] = array(
                                'ID' => intval($oneFileValue['ID']),
                                'SRC' => $oneFileValue['SRC'],
                                'WIDTH' => intval($oneFileValue['WIDTH']),
                                'HEIGHT' => intval($oneFileValue['HEIGHT'])
                            );
                            if ('SECOND_PICT' == $keyPict)
                                break;
                        }
                        if (isset($oneFileValue))
                            unset($oneFileValue);
                    } else {
                        $propValues = $item['PROPERTIES'][$propertyCode]['VALUE'];
                        if (!is_array($propValues))
                            $propValues = array($propValues);
                        foreach ($propValues as &$oneValue) {
                            $oneFileValue = CFile::GetFileArray($oneValue);
                            if (isset($oneFileValue['ID'])) {
                                $keyPict = (empty($result['PICT']) ? 'PICT' : 'SECOND_PICT');
                                $result[$keyPict] = array(
                                    'ID' => intval($oneFileValue['ID']),
                                    'SRC' => $oneFileValue['SRC'],
                                    'WIDTH' => intval($oneFileValue['WIDTH']),
                                    'HEIGHT' => intval($oneFileValue['HEIGHT'])
                                );
                                if ('SECOND_PICT' == $keyPict)
                                    break;
                            }
                        }
                        if (isset($oneValue))
                            unset($oneValue);
                    }
                }
            }
        }
        return $result;
    }
}
?>


<? // баннеры в каталогах
if (!function_exists('getCatalogBanners')) {
    function getCatalogBanners($section, $countItem)
    {
        $iblock = 62;
        if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
            $iblock = 67;
        }
        $res = CIBlockElement::GetList(
            Array(),
            Array("IBLOCK_ID" => $iblock, "SORT" => $countItem + 1, "ACTIVE" => "Y", "PROPERTY_sections" => $section),
            false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $Banner = $ob->GetFields();
        }
        return $Banner;
    }
}

// случайный баннер на главной
if (!function_exists('getMainPageRandomBanner')) {
    function getMainPageRandomBanner() {
        $iblock = 62;
        if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
            $iblock = 67;
        }
        $res = CIBlockElement::GetList(
            Array(),
            Array("IBLOCK_ID" => $iblock, "ACTIVE" => "Y"),
            false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $Banner = $ob->GetFields();
            $banners[] = $Banner;
        }
        if (count($banners)>0){
            $item = rand(0, count($banners)-1);
            return $banners[$item];
        }
         return false;
    }
}

if (!function_exists('getCatalogVideos')) {
    function getCatalogVideos($section, $countItem)
    {
//        if($countItem%2 == 0) {} else {$countItem--;}
        $iblock = 63;
        if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
            $iblock = 68;
        }
        $res = CIBlockElement::GetList(
            Array(),
            Array("IBLOCK_ID" => $iblock, "SORT" => $countItem, "ACTIVE" => "Y", "PROPERTY_sections" => $section),
            false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $video = $ob->GetFields();
        }
        return $video;
    }
}

// случайный баннер на главной
if (!function_exists('getMainPageRandomVideos')) {
    function getMainPageRandomVideos() {
        $iblock = 63;
        if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
            $iblock = 68;
        }
        $res = CIBlockElement::GetList(
            Array(),
            Array("IBLOCK_ID" => $iblock, "ACTIVE" => "Y"),
            false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $video = $ob->GetFields();
            $videos[] = $video;
        }
        if (count($videos)>0){
            $item = rand(0, count($videos)-1);
            return $videos[$item];
        }
        return false;
    }
}

// выбираем аналоги
if (!function_exists('getAnalog')) {
    function getAnalog($id) {
        $res = CIBlockElement::GetList(
            array("SORT"=> 'ASC'),
            Array("IBLOCK_ID" => 39, "ACTIVE"=>"Y", "ID"=>$id),
            false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $Elem = $ob->GetFields();
            $Elem["PROPERTIES"] = $ob->GetProperties();
            $arDiscount = CCatalogDiscount::GetDiscountByProduct($Elem['ID']);
            $prc = intval($Elem['PROPERTIES']['MINIMUM_PRICE']['VALUE']);
            $Elem['PRICE'] = $prc;
            foreach($arDiscount as $discount)
            {
                if($discount['VALUE_TYPE'] == 'S') {
                    $prc = intval($discount['VALUE']);
                } elseif($discount['VALUE_TYPE'] == 'F') {
                    $prc -= intval($discount['VALUE']);
                } elseif($discount['VALUE_TYPE'] == 'P') {
                    $prc *= ((100 - intval($discount['VALUE']))/100);
                }
            }
            $Elem['PRICE_DISCOUNT'] = $prc;
            $Elem['DETAIL_IMG'] = imageFormat($Elem['DETAIL_PICTURE']);
            $Elem['DETAIL_PICTURE'] = $Elem['DETAIL_IMG'];
            $Elem['DETAIL_PICTURE']['ID'] =  $Elem['~DETAIL_PICTURE'];

            $Elem['PREVIEW_IMG'] = imageFormat($Elem['PREVIEW_PICTURE']);
            $Elem['PREVIEW_PICTURE'] = $Elem['PREVIEW_IMG'];
            $Elem['PREVIEW_PICTURE']['ID'] =  $Elem['~PREVIEW_PICTURE'];

            $Elem['HOVER_IMG'] = imageFormat($Elem["PROPERTIES"]['image_hover']['VALUE']);
            $arResult[] = $Elem;
        }
        return $arResult;
    }
}

// форматирование изображения
if (!function_exists('imageFormat')) {
    function imageFormat($id) {
        $arFileTmp = CFile::ResizeImageGet(
            $id,
            array("width" => 300, "height" => 300),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );

        $arResult = array(
            "SRC" => $arFileTmp["src"],
            'WIDTH' => $arFileTmp["width"],
            'HEIGHT' => $arFileTmp["height"],
        );
        return $arResult;
    }
}

