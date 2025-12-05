<?php

require_once '/var/www/html/panel/env.php';
require_once 'functions.php';
date_default_timezone_set('Europe/Istanbul');

$db->insert('pos')
    ->set([
        'data' => json_encode(['date' => date('Y-m-d H:i:s'), 'crontab'=>true])
    ]);

die();

## Kullanıcının ödeme yaparken kayıtlı kartını kullanması için örnek kodlar ##

$merchant_id = '417422';
$merchant_key = 'JBL8afznw92p5noq';
$merchant_salt = 'p5BztJpbsaxBZR49';

$merchant_ok_url = "https://ogretmensendikasi.org/panel/?page=paytrcallback&ok";
$merchant_fail_url = "https://ogretmensendikasi.org/panel/?page=paytrcallback&fail";

$user_basket = htmlentities(json_encode(array(
    array("Altis Renkli Deniz Yatağı - Mavi", "18.00", 1)
)));

srand(time());
$merchant_oid = rand();

$test_mode = "1";

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

$email = "testnon3d@paytr.com";

// 100.99 TL ödeme
$payment_amount = "100.99";
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
$utoken = "fb966047aaf019212bdb6dab1a93500a966f77ee2da4ebdfc5e2697ea43a28df";
$ctoken = "bb769cecc8c4089cc5ae9e1e5ba83dd33dca0c61c6befdecd273d3b191d414ad";
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
    'user_name' => 'Paytr Test',
    'user_address' => 'test test test',
    'user_phone' => '05555555555',
    'user_basket' => $user_basket,
    'debug_on' => 1,
    'paytr_token' => $token,
    'non3d_test_failed' => $non3d_test_failed,
    'card_type' => $card_type,
    'utoken' => $utoken,
    'ctoken' => $ctoken,
];

var_dump($post_fields);


curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));

// cURL isteğini gönder
$response = curl_exec($ch);

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
