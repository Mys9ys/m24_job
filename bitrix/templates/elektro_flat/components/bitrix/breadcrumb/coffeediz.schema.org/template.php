<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$curPage = $GLOBALS['APPLICATION']->GetCurPage($get_index_page=false);

GLOBAL $catalogElement, $catalogSection;
if($curPage != SITE_DIR) {
        $bcUri = explode('/', $_SERVER["REQUEST_URI"]);
        // Условия для конкретных разделов на сайте
        // Страницы обзоров в разделе "Обзоры"
        if(count($bcUri) == 4 && $bcUri[1] == 'stati' && !empty($bcUri[2]))
        {
            $el = CIBlockElement::GetList(
                array(),
                array(
                    'IBLOCK_ID' => 43,
                    'CODE' => addslashes($bcUri[2])
                ),
                false,
                false,
                array('NAME')
            );
            if($elName = $el->Fetch()['NAME'])
            {
                $arResult[1] = array('TITLE' => $elName, 'LINK' => $curPage);
            }
        }

        // Название для разделов каталога (разделы и подразделы, 2 уровня)
        if($bcUri[1] == 'catalog' && isset($bcUri[3]))
        {
            if(!empty($catalogSection))
            {
                $arResult[count($arResult)-1]['TITLE'] = $catalogSection['NAME'];
                $sec = CIBlockSection::GetList(
                    Array(),
                    Array(
                        'IBLOCK_ID' => 39,
                        'CODE' => addslashes($bcUri[2])
                    ),
                    false,
                    false,
                    Array('ID', 'IBLOCK_ID', 'CODE', 'NAME', 'IBLOCK_SECTION_ID')
                );
                $sec = CIBlockSection::GetByID(intval($sec->Fetch()['IBLOCK_SECTION_ID']));
                if($section = $sec->Fetch())
                {
                    $arResult[count($arResult)-2]['TITLE'] = $section['NAME'];
                    unset($sec, $section);
                }
                if(!empty($catalogElement))
                {
                    $arResult[] = array('TITLE' => $catalogElement['NAME'], 'LINK' => $curPage);
                }
            }
        }


    if($bcUri[1] == 'vendors' && !empty($bcUri[2])){
        $res = CIBlockElement::GetList(
            array("SORT" => 'ASC'),
            Array("IBLOCK_ID" => 37, "ACTIVE" => "Y"),
            false,
            false,
            array());
        while ($ob = $res->GetNextElement()) {
            $Elem = $ob->GetFields();
            $arVend[$Elem['CODE']] = $Elem['NAME'];
        }
        $arResult[] = array('TITLE' => $arVend[$bcUri[2]], 'LINK' => $bcUri[2]);
    }

    if($bcUri[1] == 'response'){
        $arResult[] = array('TITLE' => 'Все отзывы покупателей', 'LINK' => '/response/');
        if(!empty($bcUri[2])){
            $responses = arResponses()['tags'];

            $title_resp = $responses[$bcUri[3]]['name'];
            $arResult[] = array('TITLE' => $title_resp, 'LINK' => $bcUri[2]);
        }
    }


        /*if(empty($arResult) || $curPage != $arResult[count($arResult)-1]['LINK'])
        {
                if(!empty($catalogElement['NAME'])) $arResult[] = array('TITLE' => $catalogElement['NAME'], 'LINK' => $curPage);
                else $arResult[] = array('TITLE' =>  htmlspecialcharsback($GLOBALS['APPLICATION']->GetTitle(false, true)), 'LINK' => $curPage);
        }*/
}

//delayed function must return a string
if(empty($arResult))
	return "";

// '.SITE_DIR.'
$strReturn = '<ul itemscope itemtype="http://schema.org/BreadcrumbList">';
            // убрана главная из крошек
//$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="http://'.$_SERVER['HTTP_HOST'].' ">
//<span itemprop="name">Главная</span></a><meta itemprop="position" content="1" /></li>';

$num_items = count($arResult);
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

        if($index < $num_items-1) $link = ' href="'.$arResult[$index]["LINK"].'"';
        else $link = '';
        if($index == 0) {
            $strReturn .= '';
        } else {
            $strReturn .= '<li class="separator"><span> — </span></li>';
        }

        $strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"';
        $strReturn .= '>';
                $strReturn .= '<a'.$link.' title="'.$title.'" itemprop="item">';
                        $strReturn .= '<span itemprop="name">'.$title.'</span>';
                        $strReturn .= '<meta itemprop="position" content="'.($index+1).'" />';
                $strReturn .= '</a>';
        $strReturn .= '</li>';
}

$strReturn .= '</ul>';

return $strReturn;
//тест?>