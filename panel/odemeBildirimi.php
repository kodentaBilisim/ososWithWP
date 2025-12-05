<?php


session_start();
require_once '/var/www/html/panel/env.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Istanbul');

//date('d',time() + 86400)
$Yarin = $db->from('talimat')
    ->where('status', 1)
    ->where('gun', 1)
    ->all();


foreach ($Yarin as $user) {

    if (date('m', strtotime($user['lastPayment'])) != date('m') or $user['lastPayment'] == NULL) {
        $uyeTalimatData = json_decode($user['data'], true);

        $uyeMeta = uyeMeta($user['user']);
        $mesaj = 'Sayın ' . $uyeMeta['name'] . '; ÖĞRETMEN SENDİKASI AİDAT SİSTEMİ üzerinden verdiğiniz talimat üzerine yarın kayıtlı kredi kartınızdan ' . $uyeTalimatData['amount'] . 'TL tutarında aidat çekimi yapılacaktır.';

        $response = $netgsm->send($mesaj, $uyeMeta['telefon'], '');

    }


}