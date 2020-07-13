<?php
function linkCatalog(){
    $result = array(
        '/catalog/massazhnye_kresla/' => '<span>Массажные</span> кресла',
        '/catalog/massazhnye_nakidki/' => '<span>Массажные</span> накидки',
        '/catalog/massazhnye_podushki/' => '<span>Массажные</span> подушки',
        '/catalog/massazhery/' => '<div class="one_row"><span></span>Массажеры</div>',
        '/catalog/massazhery_dlya_nog/' => '<span>Массажеры</span> для ног',
        '/catalog/massazhnye_stoly/' => '<span>Массажные</span> столы',
        '/catalog/massazhnye_kovriki_i_maty/' => '<span>Массажные</span> коврики и маты',
        '/catalog/massazhnye_krovati/' => '<span>Массажные</span> кровати',
        '/catalog/fitnes_pribory/' => '<div class="one_row"><span></span>Фитнес</div>',
        '/catalog/dlya_doma_i_semi/' => '<span>Для дома</span> и семьи',
        '/catalog/aksessuary_dlya_massazherov/' => '<div class="one_row"><span></span>Аксессуары</div>',
    );
    return $result;
}

function linkCompany(){
    $result = array(
        '/content/about/' => 'О магазине',
        '/content/contacts/' => 'Где купить?',
        '/stati/' => 'Обзоры',
        '/vendors/' => 'Бренды',
    );
    return $result;
}

function linkServise(){
    $result = array(
        '/content/howto/' => 'Оплата',
        '/content/delivery/' => 'Доставка',
        '/content/warranty-and-service/' => 'Гарантия и сервис',
        '/personal/cart/' => 'Корзина'
    );
    return $result;
}