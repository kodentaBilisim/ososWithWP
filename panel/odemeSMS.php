<?php

session_start();
require_once '/var/www/html/panel/env.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Istanbul');


// Bugünün gün numarası (1-31)
$yarin = date('j', strtotime('+1 day'));

// 2- Talimat tablosundan bugünün gün numarası ile eşleşen satırları al
$query = $db->prepare("SELECT * FROM new_talimat WHERE gun = :today AND status = 1");
$query->execute(['today' => $yarin]);
$talimatlar = $query->fetchAll(PDO::FETCH_ASSOC);

// 3- Döngü ile talimatları kontrol et
foreach ($talimatlar as $talimat) {
    $userID = $talimat['user'];

    // Ödemeler tablosunda bu kullanıcının bu ay içinde ödeme yapıp yapmadığını kontrol et
    $query = $db->prepare("SELECT COUNT(*) FROM new_odemeler WHERE user = :userID AND MONTH(date) = MONTH(DATE_ADD(CURDATE(), INTERVAL 1 DAY))");
    $query->execute(['userID' => $userID]);
    $odemeSayisi = $query->fetchColumn();

    // Eğer bu ay ödeme yapılmışsa işlemi durdur
    if ($odemeSayisi > 0) {
        echo "Kullanıcı " . uyeMeta($userID)['name'] . " için bu ay zaten ödeme yapılmış.\n";
        continue;
    }

    $uyeMeta = uyeMeta($userID);

    $uyeTalimatData = json_decode($talimat['data'], true);


    $mesaj = 'Sayın ' . $uyeMeta['name'] . '; ÖĞRETMEN SENDİKASI AİDAT SİSTEMİ üzerinden verdiğiniz talimat kapsamında yarın kayıtlı kredi kartınızdan ' . $uyeTalimatData['amount'] . 'TL tutarında aidat ödemesi yapılacaktır. Bilgilerinize.';

    $response = $netgsm->send($mesaj, ['5050566774',$uyeMeta['telefon']], $talimat['id']);

    echo $uyeMeta['name'].': '.json_encode($response) .'<br>';

}
echo 'İŞLEM TAMAMLANDI - SMS';