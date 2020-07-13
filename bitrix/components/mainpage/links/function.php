<?php

// создаем массив с данными о категории
function arLinks(){
    $sections = array(
        325 => array ("Массажные кресла","massazhnye_kresla"),
        334 => array ("Массажные подушки", "massazhnye_podushki"),
        335 => array ("Массажеры для ног", "massazhery_dlya_nog"),
        341 => array ("Массажные столы", "massazhnye_stoly"),
        337 => array ("Массажеры", "massazhery"),
        343 => array ("Фитнес приборы", "fitnes_pribory"),
        333 => array ("Массажные накидки", "massazhnye_nakidki"),
    );

    foreach ($sections as $id=> $section){
        $result[$id] = $section;
        $result[$id][] = CIBlockSection::GetSectionElementsCount($id);
    }
    return $result;
}

