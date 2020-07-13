<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$sections = array(
    325 => array ("name"=>"Массажные кресла","link"=>"massazhnye_kresla"),
    334 => array ("name"=>"Массажные подушки", "link"=>"massazhnye_podushki"),
    335 => array ("name"=>"Массажеры для ног", "link"=>"massazhery_dlya_nog"),
    341 => array ("name"=>"Массажные столы", "link"=>"massazhnye_stoly"),
    337 => array ("name"=>"Массажеры", "link"=>"massazhery"),
    343 => array ("name"=>"Фитнес приборы", "link"=>"fitnes_pribory"),
    333 => array ("name"=>"Массажные накидки", "link"=>"massazhnye_nakidki"),
);

foreach ($sections as $id=> $section){
    $arResult[$id] = $section;
    $arResult[$id]["count"] = CIBlockSection::GetSectionElementsCount($id);
}

