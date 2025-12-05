<?php

require_once '/var/www/html/panel/env.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Istanbul');



## Kullanıcının ödeme yaparken kayıtlı kartını kullanması için örnek kodlar ##

$merchant_id = $scriptConfig['merchant_id'];
$merchant_key = $scriptConfig['merchant_key'];
$merchant_salt = $scriptConfig['merchant_salt'];

$merchant_ok_url = 'https://ogretmensendikasi.org/panel/?page=step-by-step&step=paytr-response';
$merchant_fail_url = 'https://ogretmensendikasi.org/panel/?page=step-by-step&step=paytr-response';

$user = uyeMeta($userID);
$talimat = $db->from('talimat')
    ->where('user', $userID)
    ->first();

$talimatData = json_decode($talimat['data'],true);

$cartID = rand();

$user_basket = htmlentities(json_encode(array(
    array("ÖĞRETMEN SENDİKASI AİDAT", "1", 1)
)));

srand(time());
$merchant_oid = rand();

$test_mode = "0";

//3d'siz işlem
$non_3d = "1";

//non3d işlemde, başarısız işlemi test etmek için 1 gönderilir (test_mode ve non_3d değerleri 1 ise dikkate alınır!)
$non3d_test_failed = "0";

if (isset($_SERVER["HTTP_CLIENT_IP"])) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}

$user_ip = $ip;

$email = $user['ePosta'];

// 100.99 TL ödeme
$payment_amount = $talimatData['amount'];
$currency = "TL";
//
$payment_type = "card";


//		$card_type = "bonus";       // Alabileceği değerler; advantage, axess, bonus, cardfinans, maximum, paraf, world
//		$installment_count = "5";

$post_url = "https://www.paytr.com/odeme";
$installment_count = 0;
$hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $payment_type . $installment_count . $currency . $test_mode . $non_3d;
$token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));

## CAPI LIST servisinden dönen require_cvv, utoken ve ctoken değerlerinin kullanımı ##
## Ödeme işlemini yapan kullanıcının kayıtlı kart listesi alınarak kullanıcının önüne listelenlir. ##
## Kullanıcı listelenen kartlar arasından ödeme yapacağı kartı seçer ##
## Kullanıcının seçtiği karta ait require_cvv parametresi kontrol edilip eğer 1 ise CVV gireceği alan gösterilir ##
## Kullanıcının seçtiği kartın ctoken bilgisi ve kullanıcının utoken bilgisi ödeme isteğinde gönderilir. ##
$utoken = "cfee5b5873ca811642cd41303a850cb58dc57fda3bce35ab76980ce822178e36";
$ctoken = "f22863b750c1564014ba8bcc1ce71e1c89048a99f76f5a2d6d719e57184db475";
$require_cvv = "0";


// cURL oturumu başlat
$ch = curl_init();

// cURL ayarlarını yap
curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme"); // Ödeme geçidi URL'si
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

// POST verilerini ayarla
$post_fields = [
    'merchant_id' => $merchant_id,
    'user_ip' => $user_ip,
    'merchant_oid' => $merchant_oid,
    'email' => $email,
    'payment_type' => $payment_type,
    'payment_amount' => $payment_amount,
    'installment_count' => $installment_count,
    'currency' => $currency,
    'test_mode' => $test_mode,
    'non_3d' => $non_3d,
    'merchant_ok_url' => $merchant_ok_url,
    'merchant_fail_url' => $merchant_fail_url,
    'user_name' => 'OZAN CIRIK',
    'user_address' => 'Cumhuriyet Mah. İzzetpaşa Sok. No:9/9 Şişli İstanbul',
    'user_phone' => '05050566774',
    'user_basket' => $user_basket,
    'debug_on' => 1,
    'paytr_token' => $token,
    'non3d_test_failed' => $non3d_test_failed,
    'card_type' => $card_type,
    'utoken' => $utoken,
    'ctoken' => $ctoken
];



curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));

// cURL isteğini gönder
$response = curl_exec($ch);
var_dump($response);
// Hata kontrolü
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Başarılı yanıtı işleyin

    echo $response;

    $response_data = json_decode($response, true);
    print_r($response_data);
}

// cURL oturumunu kapat
curl_close($ch);


?>
