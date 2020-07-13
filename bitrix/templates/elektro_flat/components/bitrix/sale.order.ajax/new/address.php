<?global $LOCATION_CITY_NAME?>
<div class="order-info basket_delivery_address" >
    <div class="block_basket_title">Адрес доставки</div>
    <div class="delivery_city_select_box">Ваш город: <div class="delivery_city_select"><?if(!empty($_COOKIE['basket_city'])) {echo $_COOKIE['basket_city'];} else { echo 'г.'.$LOCATION_CITY_NAME;}?></div>
        <div class="delivery_block_city">
            <div class="search-box">
                <input class="delivery_search_string" type="search" placeholder="Выбрать город...">
                <i class="fa fa-times-circle-o close-btn" aria-hidden="true"></i>
                <div class="search-content">
                    <div class="search-item"><?if(!empty($_COOKIE['basket_city'])) {echo $_COOKIE['basket_city'];} else { echo 'г.'.$LOCATION_CITY_NAME;}?></div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" autocomplete="off" name="ORDER_PROP_21" class="delivery_city_input validate_basket" data-name="city" value="<?if(!empty($_COOKIE['basket_city'])) {echo $_COOKIE['basket_city'];} else { echo 'г.'.$LOCATION_CITY_NAME;}?>" id="ORDER_PROP_21" placeholder="Город">
    <input type="hidden" autocomplete="off" name="ORDER_PROP_6" value="129" class="dropdown-field" id="ORDER_PROP_6">
    <div class="address_hidden">
        <div class="address_left">
            <input type="text" class="delivery_street address_delivery_slot validate_basket validate_check input_basket pickup_check" data-name="street" value="<?=$_COOKIE['basket_street']?>" placeholder="Улица*">
            <div class="address_double_box">
                <input type="text" class="delivery_home address_delivery_slot validate_basket validate_check input_basket" data-name="home" value="<?=$_COOKIE['basket_home']?>" placeholder="Дом*">
                <input type="text" class="delivery_building address_delivery_slot input_basket" data-name="building" value="<?=$_COOKIE['basket_building']?>" placeholder="Корпус">
                <input type="text" class="delivery_apartment address_delivery_slot input_basket" data-name="apartment" value="<?=$_COOKIE['basket_apartment']?>" placeholder="Квартира">
                <input type="hidden" name="ORDER_PROP_7" id="ORDER_PROP_7" data-name="all_address" value="<?=$_COOKIE['basket_all_address']?>">
            </div>
        </div>
        <div class="address_right">
            <textarea class="delivery_description_comment input_basket" name="ORDER_PROP_22" id="ORDER_PROP_22" data-name="comment" placeholder="Подъезд, домофон, прочее"><?=$_COOKIE['basket_comment']?></textarea>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.close-btn').click(function () {
            $('.search-box').hide();
        });
        $('.delivery_city_select').click(function () {
            $('.search-box').show();
        });
        $('.delivery_search_string').keyup(function () {
            var $this = $(this);
            var search = $.trim($this.val()).toLowerCase();

            $('.search-content').parent().show();
            if (search.length > 2) {
                var data = {query: search};
                $.post(
                    '/ajax/getCityName.php',
                    data,
                    function (result) {
                        if (result != 'null') {
                            $('.search-content').children().remove();
                            $.each(JSON.parse(result), function (index, value) {
                                if (value) {
                                    var content = '<div class="search-item">' + value + '</div>';
                                    $('.search-content').append(content);
                                } else {
                                    search_not_found();
                                }
                            });
                        } else {
                            search_not_found();
                        }
                    });
            } else {
                search_not_found();
            }
        });
        // ставим значение выбраной метности в блок
        $('.search-box').on('click', '.search-item', function () {
            var city = $(this).text();
            $('.delivery_city_select').text(city);
            $('.delivery_city_input').val(city);
            $('.search-box').hide();
            $.cookie('basket_city', city, {
                expires: 1,
                path: '/',
            });
        });
        // заполняем полный адресс
        $('.address_delivery_slot').on('keyup', function () {
            var address_text ='';
            $('.address_delivery_slot').each(function (i,elem) {
                // console.log('elem',elem);
                // console.log('mi',$(elem).val());
                // console.log('mi',$(elem).attr('placeholder'));
                if($(elem).val()!='') {
                    address_text = address_text + $(elem).attr('placeholder').replace('*', '') + ': ' + $(elem).val() + ', ';
                }
            });
            // console.log('address_text',address_text);
            $('#ORDER_PROP_7').val(address_text);
            $.cookie('basket_all_address', address_text, {
                expires: 1,
                path: '/',
            });
        });
    });

    function search_not_found() {
        $('.search-content').children().remove();
        content = 'По вашему запросу ни чего не найдено';
        $('.search-content').append('<p>' + content + '</p>');
    }

    // Первую букву запроса делаем заглавной и наклоняем для выделения
    function CapitalReplace(str, item) {
        if (str.indexOf(item.charAt(0).toUpperCase()) > -1) {
            item = item.charAt(0).toUpperCase() + item.substr(1);
        }
        return str.replace(item, '<i style="color: rgb(156, 194, 24)">' + item + '</i>');
    }
</script>
