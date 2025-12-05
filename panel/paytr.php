<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<?php

$merchant_id = '417422';
$merchant_key = 'JBL8afznw92p5noq';
$merchant_salt = 'p5BztJpbsaxBZR49';

$merchant_ok_url="https://ogretmensendikasi.org/panel/paytrcallback?ok";
$merchant_fail_url="https://ogretmensendikasi.org/panel/paytrcallback?fail";

$user_basket = htmlentities(json_encode(array(
    array("Altis Renkli Deniz Yatağı - Mavi", "18.00", 1),
    array("Pharmasol Güneş Kremi 50+ Yetişkin & Bepanthol Cilt Bakım Kremi", "33,25", 2),
    array("Bestway Çocuklar İçin Plaj Seti Beach Set ÇANTADA DENİZ TOPU-BOT-KOLLUK", "45,42", 1)
)));

srand(time());
$merchant_oid = rand();

$test_mode="1";

//3d'siz işlem
$non_3d="1";

//Ödeme süreci dil seçeneği tr veya en
$client_lang = "tr";

//non3d işlemde, başarısız işlemi test etmek için 1 gönderilir (test_mode ve non_3d değerleri 1 ise dikkate alınır!)
$non3d_test_failed="0";

if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}

$user_ip = $ip;

$email = "testnon3d@paytr.com";

// 100.99 TL ödeme
$payment_amount = "100.99";
$currency="TL";
//
$payment_type = "card";
$post_url = "https://www.paytr.com/odeme";
$installment_count = "0";

$hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $payment_type . $installment_count. $currency. $test_mode. $non_3d;
$token = base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));

## CAPI LIST servisinden dönen require_cvv, utoken ve ctoken değerlerinin kullanımı ##
## Ödeme işlemini yapan kullanıcının kayıtlı kart listesi alınarak kullanıcının önüne listelenlir. ##
## Kullanıcı listelenen kartlar arasından ödeme yapacağı kartı seçer ##
## Kullanıcının seçtiği karta ait require_cvv parametresi kontrol edilip eğer 1 ise CVV gireceği alan gösterilir ##
## Kullanıcının seçtiği kartın ctoken bilgisi ve kullanıcının utoken bilgisi ödeme isteğinde gönderilir. ##


$require_cvv = "0";

$utoken = "b6844699093cea5b6ce9d73f1c8f29476e8a09fd2f081f785468f82d253251c5";
$ctoken = "868e3d5e2c820ad5b5f953d3fe3e5a13e8262aa731833ddf4e2bf165d75054e9";

?>

<body>
<form action="<?php echo $post_url;?>" method="post">
    <!-- CVV gereklilik kontrolü yapılıyor -->
    <?php if($require_cvv == 1) { ?>
        Kart Güvenlik Kodu: <input type="text" name="cvv" value=""><br>
    <?php } ?>
    <input type="hidden" name="merchant_id" value="<?php echo $merchant_id;?>">
    <input type="hidden" name="user_ip" value="<?php echo $user_ip;?>">
    <input type="hidden" name="merchant_oid" value="<?php echo $merchant_oid;?>">
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <input type="hidden" name="payment_type" value="<?php echo $payment_type;?>">
    <input type="hidden" name="payment_amount" value="<?php echo $payment_amount;?>">
    <input type="hidden" name="installment_count" value="1">
    <input type="hidden" name="currency" value="<?php echo $currency;?>">
    <input type="hidden" name="test_mode" value="<?php echo $test_mode;?>">
    <input type="hidden" name="non_3d" value="<?php echo $non_3d;?>">
    <input type="hidden" name="merchant_ok_url" value="<?php echo $merchant_ok_url;?>">
    <input type="hidden" name="merchant_fail_url" value="<?php echo $merchant_fail_url;?>">
    <input type="hidden" name="user_name" value="Paytr Test">
    <input type="hidden" name="user_address" value="test test test">
    <input type="hidden" name="user_phone" value="05555555555">
    <input type="hidden" name="user_basket" value="<?php echo $user_basket; ?>">
    <input type="hidden" name="debug_on" value="1">
    <input type="hidden" name="paytr_token" value="<?php echo $token; ?>">
    <input type="hidden" name="non3d_test_failed" value="<?php echo $non3d_test_failed; ?>">
    <input type="hidden" name="installment_count" value="<?php echo $installment_count; ?>">
    <input type="hidden" name="card_type" value="<?php echo $card_type; ?>">
    <input type="hidden" name="utoken" value="<?php echo $utoken; ?>">
    <input type="hidden" name="ctoken" value="<?php echo $ctoken; ?>">
    <br />
    <input type="submit" value="Submit">
</form>
</body>
</html>