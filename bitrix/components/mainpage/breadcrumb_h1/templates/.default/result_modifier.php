<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */


if (!empty($arParams['h1_text'])) {
    $arResult['h1'] = $arParams['h1_text'];
} else {
    $arrUrl = explode('/', trim($_SERVER['REQUEST_URI'], "/"));
    $arrCount = count($arrUrl);
    switch ($arrUrl[0]) {
        case 'actions' : // h1 для раздела Акции
            {
                $arResult['h1'] = 'Выгодное предложение!';
                break;
            }


        case 'stati' : // h1 для раздела Обзоры
            {
                if ($arrCount > 1) {// Страницы из битрикса для данного блока
                    $arResult['h1'] = getMetaH1TitleName(43, $arrUrl[1]);
                } else {// Основная страница
                    $arResult['h1'] = 'Обзоры и советы';
                }
                break;
            }


        case 'vendors' :
            {
                if ($arrCount > 1) {
                    $arResult['h1'] = getMetaH1TitleName(37, $arrUrl[1]);
                } else {// Основная страница
                    $arResult['h1'] = 'Производители массажного оборудования';
                }
                break;
            }

        case 'response' :
            {
                if ($arrCount == 3) {
                    switch ($arrUrl[1]) {
                        case 'product' :
                            {
                                $arResult['h1'] = getMetaH1TitleName(39, $arrUrl[2]) . " - отзывы";
                                break;
                            }
                        case 'category' :
                            {
                                $arResult['h1'] = getMetaH1TitleName(39, $arrUrl[2], true) . " - отзывы";
                                break;
                            }
                        case 'brand' :
                            {
                                $arResult['h1'] = getMetaH1TitleName(37, $arrUrl[2]) . " - отзывы";
                                break;
                            }
                    }
                }
                if ($arrCount == 1) {// Основная страница
                    $arResult['h1'] = 'Все отзывы покупателей';
                }
                break;
            }

        case 'catalog' :
            {
                if ($arrCount == 2) {
                    $arResult['h1'] = getMetaH1TitleName(39, $arrUrl[1], true);
                }
                if ($arrCount == 3) {
                    $arResult['h1'] = getMetaH1TitleName(39, $arrUrl[2]);
                }
                break;
            }

        case 'content':
            {
                switch ($arrUrl[1]) {
                    case 'video_review' :
                        {
                            if ($arrCount > 2) {
                                $arResult['h1'] = 'Видео по запросу "' . $_REQUEST['tag'] . '"';
                            } else {// Основная страница
                                $arResult['h1'] = 'Видеообзоры';
                            }
                            break;
                        }
                    case 'pay_and_delivery' :
                        {
                            $arResult['h1'] = 'Оплата покупок на массажеры24.рф и условия доставки';
                            break;
                        }
                    case 'about' :
                        {
                            $arResult['h1'] = 'О магазине Массажеры24';
                            break;
                        }
                    case 'contacts' :
                        {
                            $arResult['h1'] = 'Где купить';
                            break;
                        }
                    case 'refund' :
                        {
                            $arResult['h1'] = 'Условия возврата товаров';
                            break;
                        }
                    case 'warranty-and-service' :
                        {
                            $arResult['h1'] = 'Гарантия и сервис';
                            break;
                        }
                    case 'credit_buy' :
                        {
                            $arResult['h1'] = 'Оформить рассрочку на сайте';
                            break;
                        }
                    case 'card_buy' :
                        {
                            $arResult['h1'] = 'Безналичные расчёты';
                            break;
                        }
                    case 'covid' :
                        {
                            $arResult['h1'] = 'Безопасная доставка от массажеры24.рф';
                            break;
                        }
                    default:
                        break;
                }
            }

        default:
            break;

    }
}

function getMetaH1TitleName($BlockId, $code, $section = false)
{
    if ($section === false) {
        $res = CIBlockElement::GetList(
            array("SORT" => 'ASC'),
            Array("IBLOCK_ID" => $BlockId, "CODE" => $code),
            false,
            false,
            array('ID', 'NAME'));
    } else {
        $res = CIBlockSection::GetList(
            array("SORT" => 'ASC'),
            Array("IBLOCK_ID" => $BlockId, "CODE" => $code),
            false,
            false,
            array('ID', 'NAME'));
    }

    while ($ob = $res->GetNextElement()) {
        $Elem = $ob->GetFields();
        $statiIpropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($BlockId, $Elem['ID']);
        $statiMetaProp = $statiIpropValues->getValues();

        if (!empty($statiMetaProp['ELEMENT_PAGE_TITLE'])) {
            return $statiMetaProp['ELEMENT_PAGE_TITLE'];
        } else {
            return $Elem["NAME"];
        }
    }
}