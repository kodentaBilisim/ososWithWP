<?php

$cart = $db->from('cart')
    ->where('referans', $_GET['cartid'])
    ->first();

$cartData = json_decode($cart['data'], true);


$userMeta = uyeMeta($cart['user']);


$sepet = [
    ['Öğretmen Sendikası Aidat', $cart['tutar'], 1]
];

?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">OTOMATİK AİDAT TALİMATI</h4></div>
            </div>

        </div>
        <div class="row">

            <div class="col-12">


                <div class="card">

                    <div class="card-body">
                        <div class="mb-3 text-center paymentlogo">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Visa.svg/1200px-Visa.svg.png"
                                 alt="Visa"/>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1200px-Mastercard-logo.svg.png"
                                 alt="MasterCard"/>
                        </div>

                        <?php

                        $merchant_id = $scriptConfig['merchant_id'];
                        $merchant_key = $scriptConfig['merchant_key'];
                        $merchant_salt = $scriptConfig['merchant_salt'];

                        $merchant_ok_url = 'https://ogretmensendikasi.org/panel/?page=step-by-step&step=paytr-response';
                        $merchant_fail_url = 'https://ogretmensendikasi.org/panel/?page=step-by-step&step=paytr-response';


                        $user_basket = htmlentities(json_encode($sepet));
                        $merchant_oid = $_GET['cartid'];
                        $non_3d = "0";
                        $test_mode = $scriptConfig['paytrTestMode'];
                        $client_lang = "tr";
                        $non3d_test_failed = $scriptConfig['non3d_test_failed'];

                        $user_ip = userIP();

                        $email = $userMeta['ePosta'];

                        $payment_amount = $cart['tutar'];

                        $payment_type = $scriptConfig['payment_type'];
                        $post_url = $scriptConfig['post_url'];
                        $installment_count = $scriptConfig['installment_count'];

                        $currency = $scriptConfig['currency'];
                        $hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $payment_type . $installment_count . $currency . $test_mode . $non_3d;
                        $token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));


                        if (isset($userMeta['utoken'])) {
                            $utokens = stringToArray($userMeta['utoken']);
                            $utoken = $utokens[count($utokens) - 1];
                        } else {
                            $utoken = "";
                        }


                        echo createForm(
                            [
                                'id' => 'paytrCardForm',
                                'buttonText' => 'Ödeme Yap (' . $payment_amount . 'TL)',
                                'btnclass' => 'btn-primary',
                                'action' => $post_url,
                                'method' => 'post',
                                'elements' => [
                                    ['name' => 'cc_owner', 'placeholder' => 'Kart Sahibi', 'label' => 'Kart Sahibi', 'type' => 'text', 'colinput' => 12],
                                    ['name' => 'card_number', 'placeholder' => 'XXXXXXXXXXXXXXXX', 'label' => 'Kart Numarası', 'type' => 'text', 'colinput' => 12],
                                    ['name' => 'expiry_month', 'label' => 'Son Kullanma Tarihi (AY)', 'type' => 'select', 'option' => ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']],
                                    ['name' => 'expiry_year', 'label' => 'Son Kullanma Tarihi (YIL)', 'type' => 'select', 'option' => ['24', '25', '26', '27', '28', '29', '30', '31', '32','33','34','35','36']],
                                    ['name' => 'cvv', 'placeholder' => 'XXX', 'label' => 'CVV Kodu', 'type' => 'text'],
                                    ['name' => 'merchant_id', 'value' => $merchant_id, 'type' => 'hidden'],
                                    ['name' => 'merchant_oid', 'value' => $merchant_oid, 'type' => 'hidden'],
                                    ['name' => 'user_ip', 'value' => $user_ip, 'type' => 'hidden'],
                                    ['name' => 'email', 'value' => $email, 'type' => 'hidden'],
                                    ['name' => 'payment_type', 'value' => $payment_type, 'type' => 'hidden'],
                                    ['name' => 'payment_amount', 'value' => $payment_amount, 'type' => 'hidden'],
                                    ['name' => 'installment_count', 'value' => 1, 'type' => 'hidden'],
                                    ['name' => 'currency', 'value' => $currency, 'type' => 'hidden'],
                                    ['name' => 'test_mode', 'value' => $test_mode, 'type' => 'hidden'],
                                    ['name' => 'non_3d', 'value' => $non_3d, 'type' => 'hidden'],
                                    ['name' => 'merchant_ok_url', 'value' => $merchant_ok_url, 'type' => 'hidden'],
                                    ['name' => 'merchant_fail_url', 'value' => $merchant_fail_url, 'type' => 'hidden'],
                                    ['name' => 'user_name', 'value' => $userMeta['name'], 'type' => 'hidden'],
                                    ['name' => 'user_address', 'value' => $userMeta['adresEx'], 'type' => 'hidden'],
                                    ['name' => 'user_phone', 'value' => $userMeta['telefon'], 'type' => 'hidden'],
                                    ['name' => 'user_basket', 'value' => $user_basket, 'type' => 'hidden'],
                                    ['name' => 'debug_on', 'value' => 0, 'type' => 'hidden'],
                                    ['name' => 'paytr_token', 'value' => $token, 'type' => 'hidden'],
                                    ['name' => 'non3d_test_failed', 'value' => $non3d_test_failed, 'type' => 'hidden'],
                                    ['name' => 'installment_count', 'value' => $installment_count, 'type' => 'hidden'],
                                    ['name' => 'card_type', 'value' => $card_type, 'type' => 'hidden'],
                                    ['name' => 'utoken', 'value' => $utoken, 'type' => 'hidden'],
                                    ['name' => 'store_card', 'value' => 1, 'type' => 'hidden'],

                                ]
                            ]
                        );


                        ?>
                    </div>
                </div>
                <style>
                    .paymentlogo img {
                        width: 50px;
                        margin: 5px;
                    }
                </style>


            </div>
        </div>
    </div>
</div>

