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
        '/actions/set/' => '<span class="footer_yellow">АКЦИИ</span>',
        '/stati/' => 'Обзоры',
        '/content/video_review/' => 'Видеообзоры',
        '/response/' => 'Все отзывы',
//        '/QA_block/' => 'Вопрос-ответ',
        '/vendors/' => 'Бренды',
    );
    return $result;
}

function linkServise(){
    $result = array(
        '/content/pay_and_delivery/' => 'Оплата и доставка',
        '/content/card_buy/' => 'Оплата картой',
        '/content/credit_buy/' => 'Рассрочка',
        '/content/warranty-and-service/' => 'Гарантия и сервис',
        '/personal/order/make/' => 'Корзина',
        '/content/refund/' => 'Возврат',
//        '/personaldata/' => 'Политика в отношении обработки персональных данных',
//        '/personaldata/agree.php' => 'Согласие на обработку персональных данных'
    );
    if(CSite::InGroup( array(1, 8) )){
        $result['/content/admin_panel/'] = '<span class="footer_yellow">Админка</span>';
    }
    return $result;
}