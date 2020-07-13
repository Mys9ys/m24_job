$(document).ready(function () {
    // $('.btn_load').val();
    // $('.btn_confirm').on('click', function () {
    //     $('.btn_load').val();
    // });

    // var files;
    // $('.btn_load').on('change', function () {
    //     files = this.files;
    // });
    // $('.btn_confirm').on('click', function () {
    //     event.stopPropagation(); // остановка всех текущих JS событий
    //     event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега
    //
    //     // ничего не делаем если files пустой
    //     if (typeof files == 'undefined') return;
    //
    //     // создадим объект данных формы
    //     data = $('.ajax_form').serialize();
    //
    //     // заполняем объект данных файлами в подходящем для отправки формате
    //     $.each(files, function (key, value) {
    //         console.log('key', key, 'value', value);
    //         data.append(key, value);
    //     });
    //
    //     // добавим переменную для идентификации запроса
    //     data.append('my_file_upload', 1);
    //
    //     console.log('data', data);
    //
    //     // AJAX запрос
    //     $.ajax({
    //         url: '/bitrix/components/admin_panel/amo_catalog/ajax/',
    //         type: 'POST', // важно!
    //         data: data,
    //         cache: false,
    //         dataType: 'json',
    //         // отключаем обработку передаваемых данных, пусть передаются как есть
    //         processData: false,
    //         // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
    //         contentType: false,
    //         // функция успешного ответа сервера
    //         success: function (respond, status, jqXHR) {
    //
    //             // ОК - файлы загружены
    //             if (typeof respond.error === 'undefined') {
    //                 // выведем пути загруженных файлов в блок '.ajax-reply'
    //                 var files_path = respond.files;
    //                 var html = '';
    //                 $.each(files_path, function (key, val) {
    //                     html += val + '<br>';
    //                 });
    //
    //                 $('.ajax-reply').html(html);
    //             }
    //             // ошибка
    //             else {
    //                 console.log('ОШИБКА: ' + respond.error);
    //             }
    //         },
    //         // функция ошибки ответа сервера
    //         error: function (jqXHR, status, errorThrown) {
    //             console.log('ОШИБКА AJAX запроса: ' + status, jqXHR);
    //         }
    //     });
    // });
});