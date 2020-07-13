<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


$Iblock_videoreview = 64;
if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
    $Iblock_videoreview = 69;
}

// для карточки товара
if (!empty($arParams['ID'])) {
    $filterProduct = array(
        "IBLOCK_ID" => $Iblock_videoreview,
        "ACTIVE" => "Y",
        "=PROPERTY_productID" => $arParams['ID']
    );
    $arResult['product'] = getVideoArray(Array("SORT" => 'ASC'), $filterProduct, false);
    return;
}

// для каталога
if (!empty($arParams['category'])) {
    $filterProduct = array(
        "IBLOCK_ID" => $Iblock_videoreview,
        "ACTIVE" => "Y",
        "%SEARCHABLE_CONTENT" => $arParams['category']
    );

    if (!empty($arParams['count'])) {
        $arNavStartParams = array(
            'nTopCount' => false,
            'nPageSize' => $arParams['count'],
            'iNumPage' => 1,
            'checkOutOfRange' => true
        );
    } else {
        $arNavStartParams = false;
    }


    $arResult['items'] = getVideoArray(Array("RAND" => "ASC"), $filterProduct, $arNavStartParams);
    // если нет ни чего выводим видосы про массажные кресла
    if (empty($arResult['items'])) {
        $filterProduct['%SEARCHABLE_CONTENT'] = 'массажное кресло';
        $arResult['items'] = getVideoArray(Array("RAND" => "ASC"), $filterProduct, $arNavStartParams);
    }
    return;
}

// для главной
if ($APPLICATION->GetCurPage() == '/') {
    $arNavStartParams = array(
        'nTopCount' => false,
        'nPageSize' => 6,
        'iNumPage' => 1,
        'checkOutOfRange' => true
    );
    $filter = Array("IBLOCK_ID" => $Iblock_videoreview,
        "ACTIVE" => "Y");
    $arResult['items'] = getVideoArray(Array("CREATED" => 'DESC'), $filter, $arNavStartParams);
    // видео блок
} else {
    $arNavStartParams = array(
        'nTopCount' => false,
        'nPageSize' => 20,
        'iNumPage' => 1,
        'checkOutOfRange' => true
    );
    if (!empty($_REQUEST['tag'])) {
        $filter = Array("IBLOCK_ID" => $Iblock_videoreview,
            "ACTIVE" => "Y",
            "%SEARCHABLE_CONTENT" => $_REQUEST['tag']);
        $arResult['items'] = getVideoArray(Array("CREATED" => 'DESC'), $filter);
    } else {
        $arNavStartParams['nPageSize'] = 9;
        if (!empty($arParams['count'])) {
            $arNavStartParams = array(
                'nTopCount' => $arParams['count'],
            );
        }
        $filter = Array("IBLOCK_ID" => $Iblock_videoreview,
            "ACTIVE" => "Y",
            "!PROPERTY_Vblog_VALUE" => "Y",
        );
        // остальные
        $arResult['items'] = getVideoArray(Array("CREATED" => 'DESC'), $filter, $arNavStartParams);
        // Блогеры
        $filterBlogs = Array("IBLOCK_ID" => $Iblock_videoreview,
            "ACTIVE" => "Y",
            "PROPERTY_Vblog_VALUE" => "Y",
        );


        $arResult['Vblog'] = getVideoArray(Array("CREATED" => 'DESC'), $filterBlogs, $arNavStartParams);
        //новинки
        $arResult['new'] = getVideoArray(Array("CREATED" => 'DESC'), $filter, array('nTopCount' => 2));

        // самые популярные
        $arResult['popular'] = getVideoArray(Array("SORT" => 'ASC'), $filter, array('nTopCount' => 2));

        $arResult['pagenMaxAll'] = ceil(count(getVideoArray(array(), $filter)) / $arNavStartParams['nPageSize']);
        $arResult['pagenMaxBlogs'] = ceil(count(getVideoArray(array(), $filterBlogs)) / $arNavStartParams['nPageSize']);
    }
    $arResult['allTags'] = tagsCache();
}?>


<?

function getVideoArray($order = array(), $filter, $arNavStartParams = false){

    $res = CIBlockElement::GetList(
        $order,
        $filter,
        false,
        $arNavStartParams,
        array());
    while ($ob = $res->GetNextElement()) {
        $item = array();
        $response = $ob->GetFields();
        $response['PROPERTIES'] = $ob->GetProperties();
        $pic['max_img'] = imageFormatVideo($response['PREVIEW_PICTURE'], 478, 269);
        $pic['midi_img'] = imageFormatVideo($response['PREVIEW_PICTURE'], 320, 180);
        $pic['midi_phone_img'] = imageFormatVideo($response['PREVIEW_PICTURE'], 360, 203);
        $pic['min_img'] = imageFormatVideo($response['PREVIEW_PICTURE'], 190, 107);
        $item['pic'] = $pic;
        $item['vidID'] = $response['PROPERTIES']['vidID']['VALUE'];
        $item['timeStart'] = $response['PROPERTIES']['timeStart']['VALUE'];
        $item['NAME'] = $response['NAME'];

        $arTags = explode(";", $response['PREVIEW_TEXT']);
        $Tags = '';
        foreach ($arTags as $key => $tag) {
            $tag = trim($tag);
            if (!empty($tag)) {
                $Tags[$key] = $tag;
            }
        }
        $item['tags'] = $Tags;
        $item['products'] = productInfoVideoReview($response["PROPERTIES"]["productID"]["VALUE"]);

        $result[] = $item;
    }
    return $result;
}

function tagsCache()
{
    $allTags = array();
    $Iblock_videoreview = 64;
    if ($_SERVER['SERVER_NAME'] == 'massagery2018' || $_SERVER['SERVER_NAME'] == 'massagery2019') {
        $Iblock_videoreview = 69;
    }


    $res = CIBlockElement::GetList(
        Array(),
        Array("IBLOCK_ID" => $Iblock_videoreview,
            "ACTIVE" => "Y",
        ),
        false,
        false,
        array());
    while ($ob = $res->GetNext()) {
        $arTags = explode(";", $ob['PREVIEW_TEXT']);
        $Tags = '';
        foreach ($arTags as $key => $tag) {
            $tag = trim($tag);
            if (!empty($tag)) {
                $Tags[$key] = $tag;
                if ($allTags[$tag]) {
                    $allTags[$tag] = $allTags[$tag] + 1;
                } else {
                    $allTags[$tag] = 1;
                }
            }
        }
    }

    foreach ($allTags as $key => $row) {
        $volume[$key] = $row;
    }
    array_multisort($volume, SORT_DESC, $allTags);


    return $allTags;
}

function productInfoVideoReview($arIds)
{
    $Iblock_product = 39;
    $arProd = array();
    $res = CIBlockElement::GetList(
        Array(),
        Array("IBLOCK_ID" => $Iblock_product,
            'ID' => $arIds
        ),
        false,
        false,
        array(
            'ID',
            'NAME',
            'PROPERTY_short_name',
            'DETAIL_PICTURE',
            'PREVIEW_PICTURE',
            'DETAIL_PAGE_URL',
        ));
    while ($Elem = $res->GetNext()) {

        if (!empty($Elem['PROPERTY_SHORT_NAME_VALUE'])) {
            $item["short_name"] = $Elem['PROPERTY_SHORT_NAME_VALUE'];
        } else {
            $item["short_name"] = $Elem['NAME'];
        }
        if (!empty($Elem['PREVIEW_PICTURE'])) {
            $result['img'] = imageFormatVideo($Elem['PREVIEW_PICTURE'], 80, 66);
        } else {
            $result['img'] = imageFormatVideo($Elem['DETAIL_PICTURE'], 80, 66);
        }
        $result['link'] = $Elem["DETAIL_PAGE_URL"];
        $arProd[] = $result;
    }

    return $arProd;
}

// форматирование изображения

function imageFormatVideo($id, $width, $height)
{
    $arFileTmp = CFile::ResizeImageGet(
        $id,
        array("width" => $width, "height" => $height),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true,
        array(
            "name" => "sharpen",
            "precision" => 15
        ),
        true,
        80
    );
    return $arFileTmp["src"];
}
