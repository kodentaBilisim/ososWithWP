<?php

$talimat = $db->from('talimat')
    ->where('user', $_SESSION['UserID'])
    ->first();

$talimatData = json_decode($talimat['data'],true);
$cartID = rand();

$sepet = [
    ['Öğretmen Sendikası Aidat', $talimatData['amount'], 1]
];

$db->insert('cart')
    ->set([
        'user' => $_SESSION['UserID'],
        'data' => json_encode([
            "sepet" => $sepet
        ]),
        'date' => date('Y-m-d H:i:s'),
        'tutar' => $talimatData['amount'],
        'referans' => $cartID
    ]);


$userMeta = uyeMeta($_SESSION['UserID']);


?>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">OTOMATİK ÖDEME SAYFASI</h4>


                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        <?php

                        $merchant_id = $scriptConfig['merchant_id'];
                        $merchant_key = $scriptConfig['merchant_key'];
                        $merchant_salt = $scriptConfig['merchant_salt'];

                        $merchant_ok_url = $scriptConfig['merchant_ok_url'];
                        $merchant_fail_url = $scriptConfig['merchant_fail_url'];


                        $user_basket = htmlentities(json_encode($sepet));
                        $merchant_oid = $cartID;
                        $non_3d = "0";
                        $test_mode = $scriptConfig['paytrTestMode'];
                        $client_lang = "tr";
                        $non3d_test_failed = $scriptConfig['non3d_test_failed'];

                        $user_ip = userIP();

                        $email = $userMeta['email'];

                        $payment_amount = $talimatData['amount'];

                        $payment_type = $scriptConfig['payment_type'];
                        $post_url = $scriptConfig['post_url'];
                        $installment_count = $scriptConfig['installment_count'];

                        $currency = $scriptConfig['currency'];
                        $hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount . $payment_type . $installment_count . $currency . $test_mode . $non_3d;
                        $token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));


                        if(isset($userMeta['utoken'])){
                            $utoken = $userMeta['utoken'];
                        }else{
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
                                    ['name' => 'cc_owner', 'value' => 'TEST KARTI', 'label' => 'Kart Sahibi', 'type' => 'text'],
                                    ['name' => 'card_number', 'value' => '9792030394440796', 'label' => 'Kart Numarası', 'type' => 'text'],
                                    ['name' => 'expiry_month', 'value' => '12', 'label' => 'Son Kullanma Tarihi (AY)', 'type' => 'text'],
                                    ['name' => 'expiry_year', 'value' => '99', 'label' => 'Son Kullanma Tarihi (YIL)', 'type' => 'text'],
                                    ['name' => 'cvv', 'value' => '000', 'label' => 'CVV Kodu', 'type' => 'text'],
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
                                    ['name' => 'debug_on', 'value' => 1, 'type' => 'hidden'],
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
            </div>

        </div>
        <!-- end page title -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
