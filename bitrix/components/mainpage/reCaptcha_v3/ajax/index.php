<?php

error_reporting(0);

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if(isset($_POST['token'])) {

    // Build POST request
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Ldar6YZAAAAAADPeezOwOluD2C43r_UWmy6AdOV';
    $recaptcha_response = $_POST['token'];

    // Make and decode POST request
    $recaptcha = json_decode(file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response),true);


    // Take action based on the score returned
    if ($recaptcha['score'] >= 0.5) {
        echo true;
    } else {
        echo false;
    }
}