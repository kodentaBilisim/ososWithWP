<?php

session_start();
require_once '/var/www/html/panel/env.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Istanbul');

$merchant_id = $scriptConfig['merchant_id'];
$merchant_key = $scriptConfig['merchant_key'];
$merchant_salt = $scriptConfig['merchant_salt'];


// Bugünün gün numarası (1-31)
$today = date('j'); // j: 1-31 arasında gün numarasını döner


if ($_GET['gun']) {
    $today = $_GET['gun'];
}

// 2- Talimat tablosundan bugünün gün numarası ile eşleşen satırları al
$query = $db->prepare("SELECT * FROM new_talimat WHERE gun = :today AND status = 1");
$query->execute(['today' => $today]);
$talimatlar = $query->fetchAll(PDO::FETCH_ASSOC);

// 3- Döngü ile talimatları kontrol et
foreach ($talimatlar as $talimat) {
    $userID = $talimat['user'];

    // Ödemeler tablosunda bu kullanıcının bu ay içinde ödeme yapıp yapmadığını kontrol et
    $query = $db->prepare("SELECT COUNT(*)
FROM new_odemeler
WHERE user = :userID
  AND MONTH(date) = MONTH(CURDATE())
  AND JSON_EXTRACT(data, '$.status') = 'success';");
    $query->execute(['userID' => $userID]);
    $odemeSayisi = $query->fetchColumn();
    $uyeMeta = uyeMeta($talimat['user']);



    // Eğer bu ay ödeme yapılmışsa işlemi durdur
    if ($odemeSayisi > 0) {
        echo "Kullanıcı {$uyeMeta['name']} için bu ay zaten ödeme yapılmış.\n<br>";
        continue;
    }

    $uyeTalimatData = json_decode($talimat['data'], true);


    $result = paytr_capi_list($merchant_id, $merchant_key, $merchant_salt, $uyeMeta['utoken']);

    $cardInfo = $result[count($result) - 1];

    $ctoken = $cardInfo['ctoken'];

    echo $ctoken;

    $mesaj = 'Sayın ' . $uyeMeta['name'] . '; ' . $uyeTalimatData['amount'] . '<br>';
    echo $mesaj;

    $response = paytr_payment($talimat['user'], $uyeTalimatData, $ctoken, $uyeMeta['utoken']);
    print_r($response);
}

echo 'İŞLEM TAMAMLANDI - ÖDEME';