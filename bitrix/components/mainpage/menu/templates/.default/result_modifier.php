<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

// header картинки
$arResult['header_img'] = array(
    'pic1' => 'Бесплатная доставка по РФ',
    'pic2' => 'Гарантия лучшей цены',
    'pic3' => 'Проверенные поставщики',
    'pic4' => 'Компетентные специалисты',
);

// header ссылки
$arResult['header_link'] = array(
    '/actions/set/' => 'Акции',
    '/vendors/' => 'Бренды',
    '/stati/' => 'Обзоры',
    '/content/video_review/' => 'Видеообзоры',
    '/content/pay_and_delivery/' => 'Оплата и доставка',
    '/content/about/' => 'О магазине',
    '/content/contacts/' => 'Где купить?',
);

// массив с кнопками
$arResult['menu_main_btn'] = array(
    'massazhnye_kresla' => 'Массажные кресла',
    'massazhnye_nakidki' => 'Массажные накидки',
    'massazhnye_podushki' => 'Массажные подушки',
    'massazhery' => 'Массажеры',
    'massazhery_dlya_nog' => 'Массажеры для ног',
    'massazhnye_stoly' => 'Массажные столы',
    'massazhnye_kovriki_i_maty' => 'Массажные коврики и маты',
    'massazhnye_krovati' => 'Массажные кровати',
    'fitnes_pribory' => 'Фитнес',
    'dlya_doma_i_semi' => 'Для дома и семьи',
    'aksessuary_dlya_massazherov' => 'Аксессуары',
);

// кресла 1
$arResult['all']['massazhnye_kresla'] = array(
    '1' => array('/catalog/massazhnye_kresla/' => 'Все кресла'),
    '2' => array('1' => 'По цене',
        '/catalog/nedorogie_massajnye_kresla/' => 'Недорогие',
        '/catalog/elitnye_massazhnye_kresla/' => 'Элитные',
    ),
    '3' => array('1' => 'Место установки',
        '/catalog/massazhnye_kresla_dlya_doma/' => 'Для дома',
        '/catalog/massazhnye_kresla_dlya_ofisa/' => 'Для офиса',
        '/catalog/massazhnye_kresla/vending/' => 'Вендинговые',
        '/catalog/vse_massazhnye_kresla/vending/' => 'С купюроприемником',
    ),
    '4' => array('1' => 'Производитель',
        '/catalog/nemetskie_massazhnye_kresla/' => 'Немецкие',
        '/catalog/yaponskie_massazhnye_kresla/' => 'Японские',
        '/catalog/kitayskie_massazhnye_kresla/' => 'Китайские',
    ),
    '5' => array('1' => 'Особенности',
        '/catalog/ortopedichesike_kresla/' => 'Ортопедические',
        '/catalog/3d_massazhnye_kresla/' => '3D-кресла',
        '/catalog/massazhnye_kresla/tuchnye/' => 'Для больших людей',
        '/catalog/massazhnye_kresla/braintronics/' => 'Braintronics',
        '/catalog/kreslo_kachalka/' => 'Массажное кресло-качалка',
    ),
    'brands' => array(
        '1' => 'Популярные марки',
        'Casada.png' => '/catalog/vse_massazhnye_kresla/casada/',
        'ogawa.png' => '/catalog/vse_massazhnye_kresla/ogawa/',
        'sensa.jpg' => '/catalog/vse_massazhnye_kresla/sensa/',
    ),
);

// накидки 2
$arResult['all']['massazhnye_nakidki'] = array(
    '1' => array('/catalog/massazhnye_nakidki/' => 'Все накидки',),
    '2' => array('1' => 'Место установки',
        '/catalog/massazhnye_nakidki/home_type/' => 'для дома',
        '/catalog/massazhnye_nakidki_dlya_avtomobilya/' => 'для автомобиля',
        '/catalog/massazhnyie-nakidki-na-kreslo/' => 'на кресло',
    ),
    '3' => array('1' => 'Область массажа',
        '/catalog/massazhnyie_nakidki_spiny_i_shei/' => 'для спины и шеи',
        '/catalog/massazhnye_nakidki/back_area/' => 'для спины',
        '/catalog/massazhnye_nakidki/neck_and_shoulders_type/' => 'для шеи и плеч',
    ),
    '4' => array('1' => 'Тип массажа',
        '/catalog/massazhnye_nakidki/shiatsu_massage_type/' => 'шиацу',
        '/catalog/massazhnye_nakidki/rollers_massage_type/' => 'роликовые',
        '/catalog/massazhnye_nakidki/heating_type/' => 'с подогревом',
    ),
    'brands' => array(
        '1' => 'Популярные марки',
        'medisana.jpg' => '/catalog/massazhnye_nakidki/medisana/',
        'Casada.png' => '/catalog/massazhnye_nakidki/casada/',
    ),
);

// подушка 3
$arResult['all']['massazhnye_podushki'] = array(
    '1' => array('/catalog/massazhnye_podushki/' => 'Все подушки',),
    '2' => array('1' => 'Место установки',
        '/catalog/massazhnye_podushki/home_type/' => 'для дома',
        '/catalog/massazhnye_podushki/auto_type/' => 'для автомобиля',
        '/catalog/besprovodnaya/' => 'беспроводные',
    ),
    '3' => array('1' => 'Область массажа',
        '/catalog/massazhnye_podushki/back_area/' => 'для спины',
        '/catalog/massazhnye_podushki/loin_area/' => 'для поясницы',
        '/catalog/massazhnye_podushki/neck_and_shoulders_type/' => 'для шеи и плеч',
        '/catalog/massazhnye_podushki/neck_type/' => 'для шеи',
        '/catalog/massazhnye_podushki/shoulders_area/' => 'для плеч',
        '/catalog/massazhnye_podushki/hips_type/' => 'для бедер',
        '/catalog/massazhnye_podushki/calves_type/' => 'для икр ног',
        '/catalog/massazhnye_podushki/shin_type/' => 'для голени',
    ),
    '4' => array('1' => 'Тип массажа',
        '/catalog/massazhnye_podushki/shiatsu_back_massage/' => 'шиацу',
        '/catalog/massazhnye_podushki/rollers_massage_type/' => 'роликовые',
        '/catalog/massazhnye_podushki/heating_type/' => 'с подогревом',
        '/catalog/massazhnye_podushki/jade_rollers/' => 'с нефритом',
    ),
    'brands' => array(
        '1' => 'Популярные марки',
        'oto.png' => '/catalog/massazhnye_podushki/oto/',
        'gess.jpg' => '/catalog/massazhnye_podushki/gess/',
        'Casada.png' => '/catalog/massazhnye_podushki/casada/',
    ),
);
// массажеры 4
$arResult['all']['massazhery'] = array(
    '1' => array('/catalog/massazhery/' => 'Все массажеры',),
    '2' => array('1' => 'Область массажа',
        '/catalog/masazhery_dlya_litsa/' => 'для лица',
        '/catalog/massazhery_dlya_tela/' => 'для тела',
        '/catalog/massazhery_dlya_shei_i_plech/' => 'для шеи и плеч',
        '/catalog/massazhery_dlya_golovy/' => 'для головы',
        '/catalog/massazhery_dlya_glaz/' => 'для глаз',
        '/catalog/massazhery_dlya_zhivota/' => 'для живота',
    ),

    '3' => array('1' => 'Тип массажа',
        '/catalog/massazhery/vibration_massage_type/' => 'Вибромассажеры',
        '/catalog/massazhery/rollers_type/' => 'Роликовые',
        '/catalog/massazhery/mekhanicheskie/' => 'Механические',
        '/catalog/massazhnye_poyasa/' => 'Массажные пояса',
    ),
    'brands' => array(
        '1' => 'Популярные марки',
        'Casada.png' => '/catalog/massazhery/casada/',
        'medisana.jpg' => '/catalog/massazhery/medisana/',
        'gess.jpg' => '/catalog/massazhery/gess/',
    ),
);
// для ног 5
$arResult['all']['massazhery_dlya_nog'] = array(
    '1' => array(
        '/catalog/massazhery_dlya_nog/' => 'Все массажеры для ног',
    ),

    '2' => array('1' => 'Область массажа',
        '/catalog/massazhery-dlya-stop/' => 'для стоп',
        '/catalog/massazhery_dlya_nog/calves_area/' => 'для икр',
        '/catalog/massazhery_dlya_nog/shin_area/' => 'для голеней',
        '/catalog/massazhery_dlya_nog/hips_type/' => 'для бедер',
    ),
    '3' => array('1' => 'Энергопотребление',
        '/catalog/massazhery_dlya_nog/elektricheskie/' => 'Электрические',
        '/catalog/massazhery_dlya_nog/mekhanicheskie/' => 'Механические',
    ),
    '4' => array('1' => 'Тип массажа',
        '/catalog/kompressionnye-massazhery-dlya-nog/' => 'Компрессионные',
        '/catalog/vibratsionnye/' => 'Вибрационные',
        '/catalog/rolikovye/' => 'Роликовые',
        '/catalog/sving_mashiny/' => 'Свинг-машины',
        '/catalog/massazhery_dlya_nog/heating_type/' => 'с подогревом',
    ),
    '5' => array('1' => 'Популярные категории',
        '/catalog/massazhery-dlya-stop/' => 'Массажеры для стоп',
        '/catalog/elektromassazhery-dlya-nog/' => 'Электромассажеры для ног',
        '/catalog/yaponskie-massazhery-dlya-nog/' => 'Японские массажеры для ног',
        '/catalog/massazhery-dlya-ikr-nog/' => 'Массажеры для икр ног',
    ),
    'brands' => array(
        '1' => 'Популярные марки',
        'oto.png' => '/catalog/massazhery_dlya_nog/oto/',
        'Casada.png' => '/catalog/massazhery_dlya_nog/casada/',
        'takasima.jpg' => '/catalog/massazhery_dlya_nog/takasima/',
    ),
);
// стол 6
$arResult['all']['massazhnye_stoly'] = array(
    '1' => array('/catalog/massazhnye_stoly/' => 'Все массажные столы',),
    '2' => array('1' => 'Мобильность',
        '/catalog/massazhnye_stoly/tables_type/' => 'Складные - переносные',
        '/catalog/massazhnye_stoly/stacionarnye/' => 'Стационарные',
    ),
    '3' => array('1' => 'Количество секций',
        '/catalog/massazhnye_stoly/dvuhsekcionnye/' => 'Двухсекционные',
        '/catalog/massazhnye_stoly/trekhsekcionnye/' => 'Трехсекционные',
    ),
    '4' => array('1' => 'Энергопотребление',
        '/catalog/massazhnye_stoly/elektroprivod/' => 'с электроприводом',
    ),
    '5' => array('1' => 'Цена',
        '/catalog/nedorogie_massazhnye_stoly/' => 'недорогие',
        '/catalog/massazhnye_stoly/?set_filter=y&arrFilter_P1_MIN=20000' => 'дороже 20 000',
    ),
    'brands' => array(
        '1' => 'Популярные марки',
        'restart.png' => '/catalog/massazhnye_stoly/restart/',

    ),
);
// коврики и маты 7
$arResult['all']['massazhnye_kovriki_i_maty'] = array(
    '1' => array('/catalog/massazhnye_kovriki_i_maty/' => 'Все массажные коврики и маты',),
    '2' => array('1' => 'Категория',
        '/catalog/massazhnye_kovriki/' => 'Массажные коврики',
        '/catalog/massazhnye_maty/' => 'Массажные маты',
        '/catalog/termicheskie_maty/' => 'Термические маты',
    ),
    '5' => array('1' => 'Область массажа',
        '/catalog/massazhnye_kovriki/feet_type/' => 'для ног',
        '/catalog/massazhnye_kovriki_i_maty/back_area/' => 'для спины',
    ),
    '6' => array('1' => 'Тип массажа',
//                            '2' => 'ортопедический',
        '/catalog/massazhnye_kovriki/nefrit/' => 'Нефритовые коврики с подогревом',
    ),
);
// кровати 8
$arResult['all']['massazhnye_krovati'] = array(
    '1' => array('/catalog/massazhnye_krovati/' => 'Все массажные кровати',),
);
// Фитнес 9
$arResult['all']['fitnes_pribory'] = array(
    '1' => array('/catalog/fitnes_pribory/' => 'Все фитнес приборы',),
    '2' => array('/catalog/vibroplatformy/' => 'Виброплатформы',),
    '3' => array('/catalog/sving_mashiny2/' => 'Свинг-машины',),
    '4' => array( '1' => 'Тренажеры',
        '/catalog/trenazhery/' => 'Тренажеры',
        '/catalog/velotrenazhery/' => 'Велотренажеры',
        '/catalog/silovye_trenazhery/' => 'Силовые тренажеры',
//        '/catalog/ellipticheskie_trenazhery/' => 'Эллиптические<br> тренажеры',
    ),
    '5' => array('/catalog/begovye_dorozhki/' => 'Беговые дорожки',),
    '6' => array('/catalog/dlya_khodby/' => 'Палки для<br> скандинавской<br> ходьбы',),
//    'brands' => array(
//        '1' => 'Популярные марки',
//        'matrix.jpg' => '/catalog/fitnes_pribory/matrix/',
//        'horizon.jpg' => '/catalog/fitnes_pribory/horizon/',
//        'vision.jpg' => '/catalog/fitnes_pribory/vision/',
//        'oxygen.png' => '/catalog/fitnes_pribory/oxygen/',
//    ),
);
// Для дома и семьи 10
$arResult['all']['dlya_doma_i_semi'] = array(
    '1' => array('/catalog/dlya_doma_i_semi/' => 'Все товары для дома'),
    '2' => array('/catalog/ortopedicheskie_podushki_i_matrasy/' => 'Ортопедические подушки '),
    '3' => array('/catalog/izdeliya_iz_shersti/' => 'Изделия из шерсти'),
    '4' => array('/catalog/oborudovanie_dlya_pressoterapii/' => 'Прессотерапия'),
);
//$arResult['all']['aksessuary_dlya_massazherov'] = array();

$arResult['menu_banners'] = array(
    'massazhnye_kresla' => array('img' => 'banner_chairs.png', 'link' => '/catalog/nemetskie_massazhnye_kresla/casada_hilton_2_grafit_khilton_2_grafit/'),
    'massazhnye_nakidki' => array('img' => 'banner_nakidki.jpg', 'link' => '/catalog/massazhnye_nakidki/'),
    'massazhnye_podushki' => array('img' => 'banner_pillows.png', 'link' => '/catalog/massazhnye_podushki/auto_type/'),
    'massazhery' => array('img' => 'banner_tappymed3.png', 'link' => '/catalog/massazhery/massazher_dlya_tela_casada_tappymed_3/',),
    'massazhery_dlya_nog' => array('img' => 'banner_dlya_nog.png', 'link' => '/catalog/massazhery_dlya_nog/germaniya/'),
    'massazhnye_stoly' => array('img' => 'banner_tables.png', 'link' => '/catalog/massazhnye_stoly/?set_filter=y&arrFilter_P1_MAX=20000'),
    'massazhnye_kovriki_i_maty' => array('img' => 'banner_kovriki.png', 'link' => '/catalog/massazhnye_kovriki/casada/',),
    'massazhnye_krovati' => array('img' => 'banner_krovati.jpg', 'link' => '/catalog/massazhnye_kovriki/massazhnaya_krovat_slayder_3d_premium_health_care_/',),
    'fitnes_pribory' => array('img' => 'banner_trenazher.jpg', 'link' => '/catalog/fitnes_pribory/ellipticheskiy_trenazher_horizon_andes_5_viewfit/',),
    'dlya_doma_i_semi' => array('img' => 'banner_ortopedicheskie_podushki.png', 'link' => '/catalog/ortopedicheskie_podushki_i_matrasy/'),
);
