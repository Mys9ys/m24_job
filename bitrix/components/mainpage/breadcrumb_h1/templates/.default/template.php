<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $APPLICATION->SetAdditionalCSS('/bitrix/components/mainpage/breadcrumb_h1/style.min.css'); ?>
<? $APPLICATION->AddHeadScript("/bitrix/components/mainpage/breadcrumb_h1/script.min.js"); ?>


<h1><?=$arResult['h1']?> <?=$APPLICATION->GetPageProperty("VREGIONE");?></h1>