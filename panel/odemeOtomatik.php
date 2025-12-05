<?php


session_start();
require_once '/var/www/html/panel/env.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Istanbul');

$merchant_id = $scriptConfig['merchant_id'];
$merchant_key = $scriptConfig['merchant_key'];
$merchant_salt = $scriptConfig['merchant_salt'];


//date('d',time() + 86400)
$Yarin = $db->from('talimat')
    ->where('status', 1)
    ->where('gun', 7)
    ->all();


foreach ($Yarin as $user) {

    if (date('m', strtotime($user['lastPayment'])) != date('m') or $user['lastPayment'] == NULL) {
        $uyeTalimatData = json_decode($user['data'], true);

        $uyeMeta = uyeMeta($user['user']);

        $result = paytr_capi_list($merchant_id, $merchant_key, $merchant_salt, $uyeMeta['utoken']);

        $cardInfo = $result[count($result) - 1];

        $ctoken = $cardInfo['ctoken'];

        $response = paytr_payment($user['user'], $uyeTalimatData, $ctoken, $uyeMeta['utoken']);
        print_r($response);




    }


}