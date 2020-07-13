$(document).ready(function () {
    // убираем перенос строки
    var $h1 = $('.h1_bread_cont').find('h1').text();
    $h1 = $h1.replace(/\r|\n/g, '');
    $('.h1_bread_cont').find('h1').text($h1);

    var $title = $('title').text();
    $title = $title.replace(/\r|\n/g, '');
    $('title').text($title);

    var $description = $('meta[name="description"]').attr('content');
    $description = $description.replace(/\r|\n/g, '');
    $('meta[name="description"]').attr('content', $description);
});