<?php
function uyeMeta($uyeID)
{

    global $db;

    $User = $db->from('kisiler')->where('id', $uyeID)->first();

    $UserMeta = $db->from('kisiMeta')->where('kisi', $uyeID)->all();

    foreach ($UserMeta as $meta) {
        if (isset($User[$meta['meta']]) and !is_array($User[$meta['meta']])) {
            $gecici = $User[$meta['meta']];
            $User[$meta['meta']] = array();
            $User[$meta['meta']][] = $gecici;
            $User[$meta['meta']][] = $meta['value'];
        } elseif (isset($User[$meta['meta']])) {
            if (is_array($User[$meta['meta']])) {
                $User[$meta['meta']][] = $meta['value'];
            }
        } else {
            $User[$meta['meta']] = $meta['value'];
        }
    }
    return $User;

}


function uyeToplamOdeme($uyeID)
{
    global $db;

    $odemeler = $db->from('odemeler')->where('user', $uyeID)->all();

    $total = 0;

    foreach ($odemeler as $item) {
        $total += $item['tutar'];
    }

    return $total;
}

function uyeToplamOdemeBekleyen($uyeID){
    global $db;

    uyeMeta($uyeID);

    $dateTime = uyeMeta($uyeID)['uyelikTarihi'];

    $odemeler = $db->from('aidat')->where('date', $dateTime, '>')->all();

    $total = 0;
    foreach ($odemeler as $item) {
        $total += $item['tutar'];
    }

    $fark = $total - uyeToplamOdeme($uyeID);

    if ($fark < 0) {
        return "0";
    } else {
        return $fark;

    }


}

function uyeToplamOdemeDonem($uyeID)
{
    global $db;

    $dateTime = uyeMeta($uyeID)['uyelikTarihi'];

    return $db->from('aidat')->where('date', $dateTime, '>')->all();


}

function uyeTalimat($uyeID)
{


    global $db;

    return $db->from('talimat')->where('user', $uyeID)->first();

}

function ilTotalAidat($il, $date = null)
{
    global $db;

    if ($date == null) {
        $date = date('Y-m-d');
    }

    $IlUsers = $db->from('kisiler')
        ->where('il', $il)
        ->all();
    $total = 0;
    foreach ($IlUsers as $IlUser) {


        $userOdemeler = $db->from('odemeler')
            ->where('user', $IlUser['id'])
            ->where('user', $IlUser['id'])
            ->all();


        foreach ($userOdemeler as $userOdeme) {


            if ($userOdemeler['type'] == 1 or $userOdemeler == 3) {

                $odemeData = json_decode($userOdeme['data'], true);

                if ($odemeData['status'] == 'failed') {
                    continue;
                }


                $total = $total + $userOdeme['tutar'];


            }else{
                $total = $total + $userOdeme['tutar'];
            }

        }


    }

    return $total;

}

function paytr_capi_list($merchant_id, $merchant_key, $merchant_salt, $utoken)
{
    # Token ve hash işlemi
    $hash_str = $utoken . $merchant_salt;
    $paytr_token = base64_encode(hash_hmac('sha256', $hash_str, $merchant_key, true));

    # POST verileri
    $post_vals = array(
        'merchant_id' => $merchant_id,
        'utoken' => $utoken,
        'paytr_token' => $paytr_token
    );

    # cURL isteği
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/capi/list");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    // SSL sertifika doğrulama problemi varsa aşağıdaki satır açılabilir:
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $result = @curl_exec($ch);

    if (curl_errno($ch)) {
        die("PAYTR CAPI List connection error. err:" . curl_error($ch));
    }

    curl_close($ch);

    $result = json_decode($result, 1);

    if ($result['status'] == 'error') {
        die("PAYTR CAPI list failed. Error:" . $result['err_msg']);
    } else {
        return $result;
    }
}


function paytr_payment($userID, $talimatData, $ctoken, $utoken)
{

    global $scriptConfig;
    global $db;

    // Ayar değişkenleri
    $merchant_id = $scriptConfig['merchant_id'];
    $merchant_key = $scriptConfig['merchant_key'];
    $merchant_salt = $scriptConfig['merchant_salt'];

    $merchant_ok_url = 'https://ogretmensendikasi.org/panel/?page=step-by-step&step=paytr-response';
    $merchant_fail_url = 'https://ogretmensendikasi.org/panel/?page=step-by-step&step=paytr-response';

    // Kullanıcı bilgilerini al
    $user = uyeMeta($userID);


    $cartID = rand();

    $sepet = [
        ['Öğretmen Sendikası Aidat (Talimatlı Çekim)', $talimatData['amount'], 1]
    ];


    $user_basket = htmlentities(json_encode($sepet));

    $db->insert('cart')
        ->set([
            'user' => $userID,
            'data' => json_encode([
                "sepet" => $sepet,
                'type' => 3
            ]),
            'date' => date('Y-m-d H:i:s'),
            'tutar' => $talimatData['amount'],
            'referans' => $cartID,
            'response' => json_encode([]),
        ]);

    // Sepet bilgileri

    srand(time());
    $merchant_oid = $cartID;
    $test_mode = "0";
    $non_3d = "1";
    $non3d_test_failed = "0";

    // Kullanıcının IP adresini al
    if (isset($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }

    if (empty($ip) and !isset($ip)) {
        $ip = '65.109.87.222';
    }

    $user_ip = $ip;

    // Kullanıcı bilgileri
    $email = $user['ePosta'];
    $payment_amount = $talimatData['amount'];
    $currency = "TL";
    $payment_type = "card";
    $installment_count = 0;

    // Ödeme işlemi için hash oluşturma
    $hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $payment_type . $installment_count . $currency . $test_mode . $non_3d;
    $token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));

    // cURL oturumu başlat
    $ch = curl_init();

    // POST verileri
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
        'user_name' => $user['name'],
        'user_address' => $user['adres'],
        'user_phone' => $user['adres'],
        'user_basket' => $user_basket,
        'debug_on' => 1,
        'paytr_token' => $token,
        'non3d_test_failed' => $non3d_test_failed,
        'utoken' => $utoken,
        'ctoken' => $ctoken
    ];

    // cURL ayarları
    curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));

    // cURL isteğini gönder
    $response = curl_exec($ch);
    // cURL oturumunu kapat


    // Hata kontrolü
    if (curl_errno($ch)) {
        curl_close($ch);
        echo 'cURL Error: ' . curl_error($ch);
    } else {
        curl_close($ch);
        // Başarılı yanıtı işleyin
        $response_data = json_decode($response, true);
        return $response_data;
    }

    return false;

}
